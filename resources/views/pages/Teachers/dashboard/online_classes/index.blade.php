@extends('layouts.master')
@section('css')

    @section('title')
        {{__('online_trans.Online_classes')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{__('online_trans.Online_classes')}}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <a href="{{route('online_zoom_classes.create')}}" class="btn btn-success" role="button" aria-pressed="true">{{__('online_trans.Add_new_classes_direct')}}</a>
                                <a class="btn btn-warning" href="{{route('indirect.teacher.create')}}">{{__('online_trans.Add_new_classes_indirect')}}</a>
                                <br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>{{__('Quiz_trans.Educational_level')}}</th>
                                            <th>{{__('Quiz_trans.Classroom')}}</th>
                                            <th>{{__('Quiz_trans.Section')}}</th>
                                            <th>{{__('Quiz_trans.E_mail')}}</th>
                                            <th>{{__('online_trans.Class_title')}}</th>
                                            <th>{{__('online_trans.start_at')}}</th>
                                            <th>{{__('online_trans.class_duration')}}</th>
                                            <th>{{__('online_trans.Link_class')}}</th>
                                            <th>{{__('grades_trans.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($online_classes as $online_classe)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{$online_classe->grade->Name}}</td>
                                                <td>{{ $online_classe->classroom->Name_Class }}</td>
                                                <td>{{$online_classe->section->Name_Section}}</td>
                                                <td>{{$online_classe->created_by}}</td>
                                                <td>{{$online_classe->topic}}</td>
                                                <td>{{$online_classe->start_at}}</td>
                                                <td>{{$online_classe->duration}}</td>
                                                <td class="text-danger"><a href="{{$online_classe->join_url}}" target="_blank">{{__('online_trans.Join_now')}}</a></td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_receipt{{$online_classe->meeting_id}}" ><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @include('pages.Teachers.dashboard.online_classes.delete')
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')

@endsection
