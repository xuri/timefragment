@include('layout.account-header')
@yield('content')
{{ script('ckeditor') }}
 <script src="http://malsup.github.com/jquery.form.js"></script>
<body class="bg-gray-light">
    @include('layout.admin-navigation')
    @yield('content')

    @include('layout.admin-sidebar')
    @yield('content')
    <div class="preloader">
        <div class="timer"></div>
    </div>
    <div id="container" class="main-content p-30 tp-t-60 tp-lr-10">

        <button class="menu-btn btn btn-bordered text-gray-alt text-bold top-left-corner">&#9776; 菜单</button>
        <div class="row">
            <div class="col-sm-12">
                <div class="bg-white p-tb-30">

                    <div class="btn-group">
                        <div class="iconmelon m-r-10 m-l-30">
                            <svg viewBox="0 0 32 32">
                                <g filter="">
                                    <use xlink:href="#speech-talk-user"></use>
                                </g>
                            </svg>
                        </div>

                        <span class="text-gray-dark text-large align-with-button m-r-30">
                            编辑{{ $resourceName }}
                        </span>
                    </div>

                    <div class="pull-right m-r-30 mail-nav">
                        <a href="{{ route($resource.'.index') }}" class="btn btn-bordered text-gray-alt">
                            &laquo; 返回{{ $resourceName }}列表
                        </a>
                    </div>

                    <div class="p-lr-30 p-tb-10 pm-lr-10">
                        @include('layout.notification')
                    </div>

                    <div class="p-lr-30 p-tb-10 pm-lr-10">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab-general" data-toggle="tab">
                                    <div class="text-small">Main Content</div>
                                    <span class="text-uppercase">主要内容</span>
                                </a>
                            </li>
                            <li>
                                <a href="#tab-meta-data" data-toggle="tab">
                                    <div class="text-small">SEO</div>
                                    <span class="text-uppercase">搜索引擎优化</span>
                                </a>
                            </li>
                            <li>
                                <a href="#tab-album-picture" data-toggle="tab">
                                    <div class="text-small">Images Management</div>
                                    <span class="text-uppercase">图片管理</span>
                                </a>
                            </li>
                            <li>
                                <a href="#tab-info" data-toggle="tab">
                                    <div class="text-small">Article Information</div>
                                    <span class="text-uppercase">文章信息</span>
                                </a>
                            </li>
                        </ul>

                        <form class="form-horizontal" method="POST" action="{{ route($resource.'.update', $data->id) }}" autocomplete="off" style="padding:1em;border:1px solid #ddd;border-top:0;" accept-charset="UTF-8" enctype="multipart/form-data">
                            {{-- CSRF Token --}}
                            <input name="_method" type="hidden" value="PUT" />
                            <input name="_token" type="hidden" value="{{ csrf_token() }}" />


                            {{-- Tabs Content --}}
                            <div class="tab-content">

                                {{-- General tab --}}
                                <div class="tab-pane active fade p-30 in" id="tab-general" style="margin:0 1em;">

                                    <div class="form-group">
                                        <label for="category">分类</label>
                                        {{ $errors->first('category', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                        {{ Form::select('category', $categoryLists, $data->category->id, array('class' => 'form-control input-sm selectpicker input-light brad')) }}
                                    </div>

                                    <div class="form-group">
                                        <label for="title">标题</label>
                                        {{ $errors->first('title', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                        <input class="form-control" type="text" name="title" id="title" value="{{ Input::old('title', $data->title) }}" />
                                    </div>

                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        {{ $errors->first('slug', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                        <div class="input-group">
                                            <span class="input-group-addon" >
                                                {{ str_finish(URL::to('/'), '/') }}
                                            </span>
                                            <input class="form-control" type="text" name="slug" id="slug" value="{{ Input::old('slug', $data->slug) }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="article_icon">首页图标</label>
                                        {{ $errors->first('article_icon', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                        <input class="form-control" type="text" name="article_icon" id="article_icon" value="{{ Input::old('article_icon', $data->article_icon) }}" />
                                    </div>

                                    <div class="form-group">
                                        <label for="content">内容</label>
                                        {{ $errors->first('content', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                        <textarea rows="10" id="editor1" class="ckeditor form-control" name="content" rows="10">{{ Input::old('content', $data->content) }}
                                        </textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="excerpt">摘要</label>
                                        {{ $errors->first('excerpt', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                        <textarea id="excerpt" class="form-control"
                                            name="excerpt" rows="5" placeholder="请在这里输入文章摘要……">{{ Input::old('excerpt', $data->excerpt) }}</textarea>
                                    </div>
                                </div>

                                {{-- Meta Data tab --}}
                                <div class="tab-pane fade p-30" id="tab-meta-data" style="margin:0 1em;">

                                    <div class="form-group">
                                        <label for="meta_title">Meta Title</label>
                                        <input class="form-control" type="text" name="meta_title" id="meta_title" value="{{ Input::old('meta_title', $data->meta_title) }}" />
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_description">Meta Description</label>
                                        <input class="form-control" type="text" name="meta_description" id="meta_description" value="{{ Input::old('meta_description', $data->meta_description) }}" />
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_keywords">Meta Keywords</label>
                                        <input class="form-control" type="text" name="meta_keywords" id="meta_keywords" value="{{ Input::old('meta_keywords', $data->meta_keywords) }}" />
                                    </div>

                                </div>

                                {{-- Album Picture tab --}}
                                <div class="tab-pane fade p-30" id="tab-album-picture" style="margin:0 1em;">

                                    <div class="table-responsive form-group">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>图片</th>
                                                    <th>文件名</th>
                                                    <th style="width:5em;text-align:center;">操作</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($article->pictures as $picture)
                                                <tr>
                                                    <td>
                                                        <img width="100" height="100" src="{{ route('home') }}/uploads/articles/{{ $picture->filename }}">
                                                    </td>
                                                    <td>
                                                        {{ $picture->filename }}
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0)" class="btn btn-xs btn-danger"
                                                        onclick="modal('{{ route($resource.'.deleteArticlePicture', $picture->id) }}')">删除图片</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                {{-- Info tab --}}
                                <div class="tab-pane fade p-30" id="tab-info" style="margin:0 1em;">

                                    <div class="form-group">
                                        <label>作者</label>
                                        <p class="form-control-static">{{ $data->user ? $data->user->email : '作者信息丢失' }}</p>
                                    </div>

                                    <div class="form-group">
                                        <label>创建时间</label>
                                        <p class="form-control-static">{{ $data->created_at }}（{{ $data->friendly_created_at }}）</p>
                                    </div>

                                    <div class="form-group">
                                        <label>最后修改时间</label>
                                        <p class="form-control-static">{{ $data->updated_at }}（{{ $data->friendly_updated_at }}）</p>
                                    </div>

                                </div>

                            </div>

                            {{-- Form actions --}}
                            <div class="control-group p-l-30 p-b-30">
                                <div class="controls">
                                    <button type="reset" class="btn btn-bordered text-gray-alt">清 空</button>
                                    <button type="submit" class="btn btn-success">提 交</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="p-lr-30 p-tb-10 pm-lr-10">
                        <form action="{{ route($resource.'.postUpload', $data->id) }}" class="dropzone" id="upload">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- /main content --}}

    <?php
    $modalData['modal'] = array(
        'id'      => 'myModal',
        'title'   => '系统提示',
        'message' => '确认删除此图片？',
        'footer'  =>
            Form::open(array('id' => 'real-delete', 'method' => 'delete')).'
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">取消</button>
                <button type="submit" class="btn btn-sm btn-danger">确认删除</button>'.
            Form::close(),
    );
    ?>
    @include('layout.modal', $modalData)
    <script>
        function modal(href)
        {
            $('#real-delete').attr('action', href);
            $('#myModal').modal();
        }
    </script>
</body>
</html>
