<?php

class JobController extends BaseResource
{
    /**
     * Resource view directory
     * @var string
     */
    protected $resourceView = 'account.job';

    /**
     * Model name of the resource, after initialization to a model instance
     * @var string|Illuminate\Database\Eloquent\Model
     */
    protected $model = 'Job';

    /**
     * Resource identification
     * @var string
     */
    protected $resource = 'myjob';

    /**
     * Resource database tables
     * @var string
     */
    protected $resourceTable = 'jobs';

    /**
     * Resource name (Chinese)
     * @var string
     */
    protected $resourceName = '招聘信息';

    /**
     * Custom validation message
     * @var array
     */
    protected $validatorMessages = array(
        'title.required'        => '请填写标题。',
        'title.unique'          => '已有同名标题。',
        'location.required'     => '请选择所在省份',
        'slug.unique'           => '已有同名 sulg。',
        'content.required'      => '请填写内容。',
        'category.exists'       => '请填选择正确的标题。',
    );

    /**
     * Resource list view
     * GET         /resource
     * @return Response
     */
    public function index()
    {
        // Get sort conditions
        $orderColumn = Input::get('sort_up', Input::get('sort_down', 'created_at'));
        $direction   = Input::get('sort_up') ? 'asc' : 'desc' ;
        // Get search conditions
        switch (Input::get('target')) {
            case 'title':
                $title = Input::get('like');
                break;
        }
        // Construct query statement
        $query = $this->model->orderBy($orderColumn, $direction)->where('user_id', Auth::user()->id)->paginate(15);
        isset($title) AND $query->where('title', 'like', "%{$title}%");
        $datas = $query;
        return View::make($this->resourceView.'.index')->with(compact('datas'));
    }

    /**
     * Resource create view
     * GET         /resource/create
     * @return Response
     */
    public function create()
    {
        $categoryLists = JobCategories::lists('name', 'id');
        return View::make($this->resourceView.'.create')->with(compact('categoryLists'));
    }

    /**
     * Resource create action
     * POST        /resource
     * @return Response
     */
    public function store()
    {
        // Get all form data.
        $data   = Input::all();
        // Create validation rules
        $unique = $this->unique();
        $rules  = array(
            'title'        => 'required|'.$unique,
            'content'      => 'required',
            'category'     => 'exists:job_categories,id',
            'location'     => 'required',
        );
        $slug      = Input::input('title');
        $hashslug  = date('H.i.s').'-'.md5($slug).'.html';
        // Custom validation message
        $messages  = $this->validatorMessages;
        // Begin verification
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes()) {
            // Verification success
            // Add resource
            $model                   = $this->model;
            $model->user_id          = Auth::user()->id;
            $model->category_id      = $data['category'];
            $model->title            = e($data['title']);
            $model->location         = e($data['location']);
            $model->slug             = $hashslug;
            $model->content          = e($data['content']);
            $model->meta_title       = e($data['title']);
            $model->meta_description = e($data['title']);
            $model->meta_keywords    = e($data['title']);
            $model->save();

            $timeline                = new Timeline;
            $timeline->slug          = $hashslug;
            $timeline->model         = 'Job';
            $timeline->user_id       = Auth::user()->id;

            if ($timeline->save()) {
                // Add success
                return Redirect::back()
                    ->with('success', '<strong>'.$this->resourceName.'添加成功：</strong>您可以继续添加新'.$this->resourceName.'，或返回'.$this->resourceName.'列表。');
            } else {
                // Add fail
                return Redirect::back()
                    ->withInput()
                    ->with('error', '<strong>'.$this->resourceName.'添加失败。</strong>');
            }
        } else {
            // Verification fail
            return Redirect::back()->withInput()->withErrors($validator);
        }
    }

    /**
     * Resource edit view
     * GET         /resource/{id}/edit
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $data          = $this->model->find($id);
        $categoryLists = JobCategories::lists('name', 'id');
        $job           = Job::where('slug', $data->slug)->first();
        return View::make($this->resourceView.'.edit')->with(compact('data', 'categoryLists', 'job'));
    }

    /**
     * Resource edit action
     * PUT/PATCH   /resource/{id}
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        // Get all form data.
        $data = Input::all();
        // Create validation rules
        $rules  = array(
            'title'        => 'required',
            'content'      => 'required',
            'category'     => 'exists:job_categories,id',
            'location'     => 'required',
        );
        // Custom validation message
        $messages = $this->validatorMessages;
        // Begin verification
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes()) {

            // Verification success
            // Update resource
            $model = $this->model->find($id);
            $model->user_id          = Auth::user()->id;
            $model->category_id      = $data['category'];
            $model->location         = e($data['location']);
            $model->title            = e($data['title']);
            $model->content          = e($data['content']);
            $model->meta_title       = e($data['title']);
            $model->meta_description = e($data['title']);
            $model->meta_keywords    = e($data['title']);

            if ($model->save()) {
                // Update success
                return Redirect::back()
                    ->with('success', '<strong>'.$this->resourceName.'Update success：</strong>您可以继续编辑'.$this->resourceName.'，或返回'.$this->resourceName.'列表。');
            } else {
                // Update fail
                return Redirect::back()
                    ->withInput()
                    ->with('error', '<strong>'.$this->resourceName.'Update fail。</strong>');
            }
        } else {
            // Verification fail
            return Redirect::back()->withInput()->withErrors($validator);
        }
    }

    /**
     * Resource destory action
     * DELETE      /resource/{id}
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $data = $this->model->find($id);
        if (is_null($data))
            return Redirect::back()->with('error', '没有找到对应的'.$this->resourceName.'。');
        elseif ($data)
        {
            $model      = $this->model->find($id);
            $thumbnails = $model->thumbnails;
            File::delete(public_path('uploads/job_thumbnails/'.$thumbnails));

            $timeline = Timeline::where('slug', $model->slug)->where('user_id', Auth::user()->id)->first();
            $timeline->delete();

            $data->delete();

            return Redirect::back()->with('success', $this->resourceName.'删除成功。');
        }
        else
            return Redirect::back()->with('warning', $this->resourceName.'删除失败。');
    }

    /**
     * Action: Add resource images
     * @return Response
     */
    public function postUpload($id)
    {
        $input = Input::all();
        $rules = array(
            'file' => 'image|max:3000',
        );

        $validation = Validator::make($input, $rules);

        if ($validation->fails())
        {
            return Response::make($validation->errors->first(), 400);
        }

        $file                = Input::file('file');
        $destinationPath     = 'uploads/jobs/';
        $ext                 = $file->guessClientExtension();  // Get real extension according to mime type
        $fullname            = $file->getClientOriginalName(); // Client file name, including the extension of the client
        $hashname            = date('H.i.s').'-'.md5($fullname).'.'.$ext; // Hash processed file name, including the real extension
        $picture             = Image::make($file->getRealPath());
        // Crop the best fitting ratio and resize image
        $picture->fit(1024, 683)->save(public_path($destinationPath.$hashname));
        $picture->fit(585, 432)->save(public_path('uploads/job_thumbnails/'.$hashname));

        $model               = $this->model->find($id);
        $oldThumbnails       = $model->thumbnails;
        $model->thumbnails   = $hashname;
        $model->save();

        File::delete(public_path('uploads/job_thumbnails/'.$oldThumbnails));

        $models              = new JobPictures;
        $models->filename    = $hashname;
        $models->job_id      = $id;
        $models->user_id     = Auth::user()->id;
        $models->save();

        if( $models->save() ) {
           return Response::json('success', 200);
        } else {
           return Response::json('error', 400);
        }
    }

    /**
     * Action: Delete resource images
     * @return Response
     */
    public function deleteUpload($id)
    {
        // Only allows you to share pictures on the cover of the current resource being deleted
        $filename = JobPictures::where('id', $id)->where('user_id', Auth::user()->id)->first();
        $oldImage = $filename->filename;

        if (is_null($filename))
            return Redirect::back()->with('error', '没有找到对应的图片');
        elseif ($filename->delete()) {

        File::delete(
            public_path('uploads/job/'.$oldImage)
        );
            return Redirect::back()->with('success', '图片删除成功。');
        }

        else
            return Redirect::back()->with('warning', '图片删除失败。');
    }

    /**
     * View: My comments
     * @return Response
     */
    public function comments()
    {
        $comments = JobComment::where('user_id', Auth::user()->id)->paginate(15);
        return View::make($this->resourceView.'.comments')->with(compact('comments'));
    }

    /**
     * Action: Delete my comments
     * @return Response
     */
    public function deleteComment($id)
    {
        // Delete operations only allow comments to yourself
        $comment = JobComment::where('id', $id)->where('user_id', Auth::user()->id)->first();
        if (is_null($comment))
            return Redirect::back()->with('error', '没有找到对应的评论');
        elseif ($comment->delete())
            return Redirect::back()->with('success', '评论删除成功。');
        else
            return Redirect::back()->with('warning', '评论删除失败。');
    }

    /**
     * View: Job
     * @return Respanse
     */
    public function getIndex()
    {
        $job        = Job::orderBy('created_at', 'desc')->paginate(12);
        $categories = JobCategories::orderBy('sort_order')->paginate(6);
        return View::make('job.index')->with(compact('job', 'categories', 'data'));
    }

    /**
     * Resource list
     * @return Respanse
     */
    public function category($category_id)
    {
        $job              = Job::where('category_id', $category_id)->orderBy('created_at', 'desc')->paginate(6);
        $categories       = JobCategories::orderBy('sort_order')->get();
        $current_category = JobCategories::where('id', $category_id)->first();
        return View::make('job.category')->with(compact('job', 'categories', 'category_id', 'current_category'));
    }

    /**
     * Resource show view
     * @param  string $slug Slug
     * @return response
     */
    public function show($slug)
    {
        $job        = Job::where('slug', $slug)->first();
        is_null($job) AND App::abort(404);
        $categories = JobCategories::orderBy('sort_order')->get();
        return View::make('job.show')->with(compact('job', 'categories'));
    }

    public function postComment($slug)
    {
        // Get comment
        $content = e(Input::get('content'));
        // Check word
        if (mb_strlen($content)<3)
            return Redirect::back()->withInput()->withErrors($this->messages->add('content', '评论不得少于3个字符。'));
        // Find article
        $job     = Job::where('slug', $slug)->first();
        // Create comment
        $comment = new JobComment;
        $comment->content   = $content;
        $comment->job_id    = $job->id;
        $comment->user_id   = Auth::user()->id;
        if ($comment->save()) {
            // Create success
            // Updated comments
            $job->comments_count = $job->comments->count();
            $job->save();
            // Return success
            return Redirect::back()->with('success', '评论成功。');
        } else {
            // Create fail
            return Redirect::back()->withInput()->with('error', '评论失败。');
        }
    }

}
