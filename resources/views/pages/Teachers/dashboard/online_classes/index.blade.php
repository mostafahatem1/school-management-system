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
                                <a href="{{route('online_zoom_classes.create')}}" class="btn btn-success" role="button"
                                   aria-pressed="true">{{__('online_trans.Add_new_classes_direct')}}</a>
                                <a class="btn btn-warning"
                                   href="{{route('indirect.teacher.create')}}">{{__('online_trans.Add_new_classes_indirect')}}</a>
                                <br><br>
                                @foreach($online_classes as $online_classe)
                                    <div  style="margin-bottom: 40px; border: 1px solid black; padding: 8px">
                                        <table class="col-12" data-page-length="50">
                                            <tbody>
                                            <tr>
                                                <th>#</th>
                                                <td>{{ $loop->iteration }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ trans('Students_trans.education_level') }}<</th>
                                                <td>{{$online_classe->grade->Name}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ trans('Students_trans.grade') }}</th>
                                                <td>{{ $online_classe->classroom->Name_Class }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ trans('Students_trans.classroom') }}</th>
                                                <td>{{$online_classe->section->Name_Section}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{__('subjects_trans.Name_subject')}}</th>
                                                <td>{{$online_classe->subject->name}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{__('online_trans.Topic')}}</th>
                                                <td>{{$online_classe->topic}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{__('Quiz_trans.E_mail')}}</th>
                                                <td>{{$online_classe->created_by}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{__('online_trans.start_at')}}</th>
                                                <td>{{$online_classe->start_at}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{__('online_trans.class_duration')}}</th>
                                                <td>{{$online_classe->duration}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{__('online_trans.Link_class')}}</th>
                                                <td class="text-danger"><a href="{{$online_classe->join_url}}"
                                                                           target="_blank">{{__('online_trans.Join_now')}}</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>{{__('grades_trans.Processes')}}</th>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#Delete_receipt{{$online_classe->meeting_id}}">
                                                        <i class="fa fa-trash"></i></button>
                                                </td>

                                            </tr>
                                            </tbody>
                                            @include('pages.Teachers.dashboard.online_classes.delete')

                                        </table>
                                    </div>
                                @endforeach
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
