@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@if(isset($dataTypeContent->id))
    @section('page_title','Edit '.$dataType->display_name_singular)
@else
    @section('page_title','Add '.$dataType->display_name_singular)
@endif

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> @if(isset($dataTypeContent->id)){{ '修改' }}@else{{ '新增' }}@endif {{ $dataType->display_name_singular }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">

                    <div class="panel-heading">
                        <h3 class="panel-title">@if(isset($dataTypeContent->id)){{ 'Edit' }}@else{{ '新增' }}@endif {{ $dataType->display_name_singular }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form"
                          class="form-edit-add"
                          action="@if(isset($dataTypeContent->id)){{ route('voyager.'.$dataType->slug.'.update', $dataTypeContent->id) }}@else{{ route('voyager.'.$dataType->slug.'.store') }}@endif"
                          method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->
                    @if(isset($dataTypeContent->id))
                        {{ method_field("PUT") }}
                    @endif

                    <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-body">
                        <!-- If we are editing -->
                            @if(isset($dataTypeContent->id))
                                <?php $dataTypeRows = $dataType->editRows; ?>
                            @else
                                <?php $dataTypeRows = $dataType->addRows; ?>
                            @endif

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="name">标题</label>
                                <input type="text" class="form-control" name="title"
                                       placeholder="标题  " id="title"
                                       value="@if(isset($dataTypeContent->title)){{ old('title', $dataTypeContent->title) }}@else{{old('title')}}@endif">
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                <label for="role">类型</label>
                                <select name="type" id="type" class="form-control">
                                    <?php $type_lise = \App\NewsList::TYPE_LIST; ?>
                                    @foreach($type_lise as $key=>$value)
                                        <option value="{{$key}}"
                                                @if(isset($dataTypeContent) && $dataTypeContent->type == $key) selected @endif>{{$value}}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                <!-- 加载编辑器的容器 -->
                                <script id="container" name="content" type="text/plain"
                                        style="width:1200px;height:600px;">
                                    @if(isset($dataTypeContent->content)){!! old('content', $dataTypeContent->content) !!}@else{!!old('content')!!}@endif
                                </script>
                            </div>
                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary save">确认</button>
                        </div>
                    </form>

                    <iframe id="form_target" name="form_target" style="display:none"></iframe>
                    <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post"
                          enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
                        <input name="image" id="upload_file" type="file"
                               onchange="$('#my_form').submit();this.value='';">
                        <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
                        {{ csrf_field() }}
                    </form>

                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();
        });
    </script>
    <script src="{{ voyager_asset('lib/js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ voyager_asset('js/voyager_tinymce.js') }}"></script>
    <!-- 配置文件 -->
    <script type="text/javascript" src="{{asset('ueditor/ueditor.config.js')}}"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="{{asset('ueditor/ueditor.all.js')}}"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container');
    </script>
@stop
