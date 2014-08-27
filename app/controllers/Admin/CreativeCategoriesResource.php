<?php

class Admin_CreativeCategoriesResource extends BaseResource
{
    /**
     * Resource view directory
     * @var string
     */
    protected $resourceView = 'admin.creative_categories';

    /**
     * Model name of the resource, after initialization to a model instance
     * @var string|Illuminate\Database\Eloquent\Model
     */
    protected $model = 'CreativeCategories';

    /**
     * Resource identification
     * @var string
     */
    protected $resource = 'creative_categories';

    /**
     * Resource database tables
     * @var string
     */
    protected $resourceTable = 'creative_categories';

    /**
     * Resource name (Chinese)
     * @var string
     */
    protected $resourceName = '创意汇分类';

    /**
     * Custom validation message
     * @var array
     */
    protected $validatorMessages = array(
        'name.required'       => '请填写分类名称。',
        'name.unique'         => '已有同名分类。',
        'sort_order.required' => '请填写分类排序。',
        'sort_order.integer'  => '请填写一个整数。',
    );

    /**
     * Resource list view
     * GET         /resource
     * @return Response
     */
    public function index()
    {
        $datas = $this->model->where('cat_status', 'open')->orderBy('sort_order')->paginate(15);
        return View::make($this->resourceView.'.index')->with(compact('datas'));
    }

    /**
     * Resource create view
     * GET         /resource/create
     * @return Response
     */
    public function create()
    {
        $exist = $this->model->where('cat_status', 'close')->first();
        if($exist)
        {
            return Redirect::route($this->resource.'.newCat', $exist->id);
        } else {
            $model             = $this->model;
            $model->name       = '';
            $model->sort_order = '';
            $model->save();
            return Redirect::route($this->resource.'.newCat', $model->id);
        }
    }

    /**
     * Resource create view
     * GET         /resource/create
     * @return Response
     */
    public function newCat($id)
    {
        $data = $this->model->find($id);
        return View::make($this->resourceView.'.create')->with('data', $data);
    }

    /**
     * Resource create action
     * POST        /resource
     * @return Response
     */
    public function store($id)
    {
        // Get all form data.
        $data   = Input::all();
        // Create validation rules
        $unique = $this->unique();
        $rules  = array(
            'name'       => 'required|'.$unique,
            'sort_order' => 'required|integer',
        );
        // Custom validation message
        $messages  = $this->validatorMessages;
        // Begin verification
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes()) {
            // Verification success
            // Add resource
            $model             = $this->model->find($id);
            $model->name       = e($data['name']);
            $model->sort_order = e($data['sort_order']);
            $model->cat_status = 'open';
            if ($model->save()) {
                // Add success
                return Redirect::route($this->resource.'.edit', $model->id)
                    ->with('success', '<strong>'.$this->resourceName.'添加成功：</strong>您可以继续编辑'.$this->resourceName.'，或返回'.$this->resourceName.'列表。');
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
        $rules = array(
            'name'       => 'required|'.$this->unique('name', $id),
            'sort_order' => 'required|integer',
        );
        // Custom validation message
        $messages  = $this->validatorMessages;
        // Begin verification
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes()) {
            // Verification success
            // Update resource
            $model             = $this->model->find($id);
            $model->name       = e($data['name']);
            $model->sort_order = e($data['sort_order']);
            if ($model->save()) {
                // Update success
                return Redirect::back()
                    ->with('success', '<strong>'.$this->resourceName.'更新成功：</strong>您可以继续编辑'.$this->resourceName.'，或返回'.$this->resourceName.'列表。');
            } else {
                // Update fail
                return Redirect::back()
                    ->withInput()
                    ->with('error', '<strong>'.$this->resourceName.'更新失败。</strong>');
            }
        } else {
            // Verification fail
            return Redirect::back()->withInput()->withErrors($validator);
        }
    }


}
