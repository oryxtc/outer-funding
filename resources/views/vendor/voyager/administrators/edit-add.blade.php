@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title','用户')

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> @if(isset($dataTypeContent->id)){{ '修改' }}@else{{ '新增' }}@endif {{ $dataType->display_name_singular }}
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">

                    <div class="panel-heading">
                        <h3 class="panel-title">@if(isset($dataTypeContent->id)){{ '修改' }}@else{{ '新增' }}@endif {{ $dataType->display_name_singular }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-edit-add" role="form"
                          action="@if(isset($dataTypeContent->id)){{ route('voyager.'.$dataType->slug.'.update', $dataTypeContent->id) }}@else{{ route('voyager.'.$dataType->slug.'.store') }}@endif"
                          method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->
                    @if(isset($dataTypeContent->id))
                        {{ method_field("PUT") }}
                    @endif

                    <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-body">
                            <div class="form-group">
                                <label for="name">姓名</label>
                                <input type="text" class="form-control" name="name"
                                       placeholder="Name" id="name"
                                       value="@if(isset($dataTypeContent->name)){{ old('name', $dataTypeContent->name) }}@else{{old('name')}}@endif">
                            </div>

                            <div class="form-group">
                                <label for="username">用户名</label>
                                <input type="text" class="form-control" name="username"
                                       placeholder="Username" id="username"
                                       @if(isset($dataTypeContent->id)) readonly="readonly" @endif
                                       @if(isset($dataTypeContent->username))  @endif
                                       value="@if(isset($dataTypeContent->username)){{ old('username', $dataTypeContent->username) }}@else{{old('username')}}@endif">
                            </div>

                            <div class="form-group">
                                {{--{{ dump(\Auth::guard('admin')->hasRole('admin'))}}--}}
                                <label for="role">用户角色</label>
                                @if(Voyager::isRole('admin'))
                                    <select name="role_id" id="role" class="form-control">
                                        <?php $roles = TCG\Voyager\Models\Role::all(); ?>
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}"
                                                    @if(isset($dataTypeContent) && $dataTypeContent->role_id == $role->id) selected @endif>{{$role->display_name}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <input type="text" class="form-control" name=""
                                           placeholder="" id="" readonly="readonly"
                                           value="@if(isset($dataTypeContent->role)){{ old('role', $dataTypeContent->role->display_name) }}@else{{old('role')}}@endif">
                                @endif

                            </div>

                            <div class="form-group">
                                <label for="email">邮箱</label>
                                <input type="text" class="form-control" name="email"
                                       placeholder="Email" id="email"
                                       value="@if(isset($dataTypeContent->email)){{ old('email', $dataTypeContent->email) }}@else{{old('email')}}@endif">
                            </div>

                            <div class="form-group">
                                <label for="password">密码</label>
                                @if(isset($dataTypeContent->password))
                                    <br/>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal"
                                            data-target="#myModal">
                                        重置密码
                                    </button>
                                    {{--提示框--}}
                                    <div class="alert alert-success" role="alert" hidden>重置密码成功!</div>
                                    <div class="alert alert-danger" role="alert" hidden>重置密码失败!</div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
                                         aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close"><span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h4 class="modal-title" id="myModalLabel">重置密码</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="password" class="form-control" name=""
                                                           placeholder="Password" id="password-reset"
                                                           value="">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        关闭
                                                    </button>
                                                    <button type="button" class="btn btn-primary" id="resetPass">确认
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                {{--<input type="password" class="form-control" name="password"--}}
                                {{--placeholder="Password" id="password"--}}
                                {{--value="">--}}
                            </div>

                            <div class="form-group">
                                <label for="password">头像</label>
                                @if(isset($dataTypeContent->avatar))
                                    <img src="{{ Voyager::image( $dataTypeContent->avatar ) }}"
                                         style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                @endif
                                <input type="file" name="avatar">
                            </div>
                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary">确认</button>
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

            //密码模态框
            $('#myModal').on('shown.bs.modal', function () {
                $('#myInput').focus()
            })
            //提交重置密码
            $('#resetPass').click(function () {
                $.post("resetPass", {password: $('#password-reset').val()}, function (data) {
                    $('#myModal').modal('hide')
                    if (data.status === 'success') {
                        $(".alert-success").show().delay(3000).hide(0)
                    } else {
                        $(".alert-danger").text(data.message).show().delay(3000).hide(0)
                    }
                })
            })
        });
    </script>
    <script src="{{ voyager_asset('lib/js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ voyager_asset('js/voyager_tinymce.js') }}"></script>
@stop
