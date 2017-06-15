@extends('voyager::master')

@section('page_title','个人信息')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ voyager_asset('css/ga-embed.css') }}">
    <style>
        .user-email {
            font-size: .85rem;
            margin-bottom: 1.5em;
        }
    </style>
@stop

@section('content')
    <div style="background-size:cover; background: url({{ Voyager::image( Voyager::setting('admin_bg_image'), config('voyager.assets_path') . '/images/bg.jpg') }}) center center;position:absolute; top:0; left:0; width:100%; height:300px;"></div>
    <div style="height:160px; display:block; width:100%"></div>
    <div style="position:relative; z-index:9; text-align:center;">
        <img src="{{ Voyager::image( Auth::guard('admin')->user()->avatar ) }}" class="avatar"
             style="border-radius:50%; width:150px; height:150px; border:5px solid #fff;"
             alt="{{ Auth::guard('admin')->user()->name }} avatar">
        <h4>{{ ucwords(Auth::guard('admin')->user()->name) }}</h4>
        <div class="user-email text-muted">{{ ucwords(Auth::guard('admin')->user()->email) }}</div>
        {{--<p>{{ Auth::guard('admin')->user()->bio }}</p>--}}
        {{--        <a href="{{ route('voyager.administrators.edit', Auth::guard('admin')->user()->id) }}" class="btn btn-primary">修改我的信息</a>--}}
    </div>
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <div class="panel-heading">
                        <h3 class="panel-title">@if(isset($dataTypeContent->id)){{ '修改' }}@else{{ '新增' }}@endif     </h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-edit-add" role="form"
                          action="{{ route('voyager.administrators.update', ['id'=>$dataTypeContent->id,'type'=>'profile']) }}"
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
                                    <br>
                                    <small>留空则保持不变</small>
                                @endif
                                {{--提示框--}}

                                <div class="alert alert-success" role="alert" hidden>重置密码成功!</div>
                                <div class="alert alert-danger" role="alert" hidden></div>
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
                                                       placeholder="Password" id="password"
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
                            </div>

                            <div class="form-group">
                                <label for="password">头像</label>

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
                        <input type="hidden" name="type_slug" id="type_slug" value="">
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
            //密码模态框
            $('#myModal').on('shown.bs.modal', function () {
                $('#myInput').focus()
            })
            //提交重置密码
            $('#resetPass').click(function () {
                $.post("resetPass", {password: $('#password').val()}, function (data) {
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
@stop