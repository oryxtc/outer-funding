@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title','配资')

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> 详情 {{ ucfirst($dataType->display_name_singular) }}
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form role="form"
                      class="form-edit-add"
                      action="{{ route('voyager.'.$dataType->slug.'.update', $dataTypeContent->id) }}"
                      method="POST" enctype="multipart/form-data">
                {{ method_field("PUT") }}
                <!-- CSRF TOKEN -->
                    {{ csrf_field() }}

                    <div class="panel panel-bordered" style="padding-bottom:5px;">
                        @foreach($dataType->readRows as $row)
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">{{ $row->display_name }}</h3>
                            </div>

                            <div class="panel-body" style="padding-top:0;">
                                @if($row->type == "image")
                                    <img style="max-width:640px"
                                         src="{!! Voyager::image($dataTypeContent->{$row->field}) !!}">
                                @elseif($row->type == 'date')
                                    {{ \Carbon\Carbon::parse($dataTypeContent->{$row->field})->format('F jS, Y h:i A') }}
                                @elseif($row->field== 'remark')
                                    @if(Voyager::isRole('admin'))
                                        {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}
                                    @else
                                        <p>{{ $dataTypeContent->{$row->field} }}</p>
                                    @endif
                                @elseif($row->field== 'user_id')
                                    <p>{{ $dataTypeContent->user->name }}</p>
                                @elseif($row->field== 'administrator_id')
                                    <p>{{ isset($dataTypeContent->administrator->name)?$dataTypeContent->administrator->name:'' }}</p>
                                @elseif($row->field== 'status')
                                    @if($dataTypeContent->status===0)
                                        <div><p>未审核</p><a class="btn btn-primary" href="{{ route('voyager.'.$dataType->slug.'.funding', $dataTypeContent->id) }}" role="button">审核通过</a></div>
                                    @elseif($dataTypeContent->status===1)
                                        <p>已审核</p>
                                    @endif
                                @else
                                    <p>{{ $dataTypeContent->{$row->field} }}</p>
                                @endif
                            </div><!-- panel-body -->
                            @if(!$loop->last)
                                <hr style="margin:0;">
                            @endif
                        @endforeach
                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary">确认</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('javascript')

@stop
