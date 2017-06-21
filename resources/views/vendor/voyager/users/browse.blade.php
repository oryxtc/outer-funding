@extends('voyager::master')

@section('page_title',$dataType->display_name_plural)

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> {{ $dataType->display_name_plural }}
        @if (Voyager::can('add_'.$dataType->name))
            <a href="{{ route('voyager.'.$dataType->slug.'.create') }}" class="btn btn-success">
                <i class="voyager-plus"></i> 新增
            </a>
        @endif
    </h1>
@stop

@section('content')
    {{--提示框--}}
    <div class="alert alert-success" role="alert" hidden>审核成功!</div>
    <div class="alert alert-danger" role="alert" hidden>审核失败!</div>
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                            <tr>
                                <th>手机号</th>
                                <th>真实姓名</th>
                                <th>身份证号</th>
                                <th>认证状态</th>
                                <th>创建时间</th>
                                <th class="actions">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dataTypeContent as $data)
                                <tr>
                                    <td>{{$data->phone}}</td>
                                    <td>{{$data->actual_name}}</td>
                                    <td>{{$data->id_card}}</td>
                                    <td>
                                        @if($data->status===10)
                                            已认证
                                        @else
                                            未认证
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($data->created_at)->format('Y-m-d H:i:s') }}</td>
                                    <td class="no-sort no-click">
                                        @if (Voyager::can('delete_'.$dataType->name))
                                            <div class="btn-sm btn-danger pull-right delete" data-id="{{ $data->id }}"
                                                 id="delete-{{ $data->id }}">
                                                <i class="voyager-trash"></i> 删除
                                            </div>
                                        @endif
                                        @if (Voyager::can('edit_'.$dataType->name))
                                            <a href="{{ route('voyager.'.$dataType->slug.'.edit', $data->id) }}"
                                               class="btn-sm btn-primary pull-right edit">
                                                <i class="voyager-edit"></i> 修改
                                            </a>
                                        @endif
                                        @if (Voyager::can('read_'.$dataType->name))
                                            <a href="{{ route('voyager.'.$dataType->slug.'.show', $data->id) }}"
                                               class="btn-sm btn-warning pull-right">
                                                <i class="voyager-eye"></i> 详情
                                            </a>
                                        @endif
                                        @if($data->status!==10)
                                            <a id="verifiedUser" class="btn-sm btn-warning pull-right"
                                               data-value="{{$data->id}}" data-toggle="modal" data-target="#myModal">
                                                <i class="voyager-eye"></i> 认证
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <input type="hidden" value="" id="userId">
                        <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span
                                                    aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel">审核实名认证</h4>
                                    </div>
                                    <div class="modal-body">
                                        <span>确认实名审核通过?</span>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default"
                                                data-dismiss="modal">
                                            关闭
                                        </button>
                                        <button type="button" class="btn btn-primary" id="verifie">确认
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (isset($dataType->server_side) && $dataType->server_side)
                            <div class="pull-left">
                                <div role="status" class="show-res" aria-live="polite">
                                    Showing {{ $dataTypeContent->firstItem() }} to {{ $dataTypeContent->lastItem() }}
                                    of {{ $dataTypeContent->total() }} entries
                                </div>
                            </div>
                            <div class="pull-right">
                                {{ $dataTypeContent->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> Are you sure you want to delete
                        this {{ $dataType->display_name_singular }}?</h4>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('voyager.'.$dataType->slug.'.index') }}" id="delete_form" method="POST">
                        {{ method_field("DELETE") }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm"
                               value="确认删除 {{ $dataType->display_name_singular }}">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancel</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop

@section('javascript')
    <!-- DataTables -->
    <script>
        @if (!$dataType->server_side)
            $(document).ready(function () {
            $('#dataTable').DataTable({"order": []});
        });
        @endif

        $('td').on('click', '.delete', function (e) {
            var form = $('#delete_form')[0];
            form.action = parseActionUrl(form.action, $(this).data('id'));
            $('#delete_modal').modal('show');
        });

        //密码模态框
        $('#myModal').on('shown.bs.modal', function (e) {
            $("#userId").val(e.relatedTarget.getAttribute('data-value'))
            $('#myInput').focus()
        })
        //提交重置密码
        $('#verifie').click(function (e) {
            $.post("users/verified", {"userId": $("#userId").val()}, function (data) {
                $('#myModal').modal('hide')
                if (data.status === 'success') {
                    $(".alert-success").show().delay(3000).hide(0)
                    location.reload();
                } else {
                    $(".alert-danger").text(data.message).show().delay(3000).hide(0)
                }
            })
        })

        function parseActionUrl(action, id) {
            return action.match(/\/[0-9]+$/)
                    ? action.replace(/([0-9]+$)/, id)
                    : action + '/' + id;
        }
    </script>
@stop
