@extends('layouts.master')
@section('css')

    @section('title')
        {{__('Teacher_trans.Attendance_absence_report')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{__('Teacher_trans.Attendance_absence_report')}}
    @stop
    <!-- breadcrumb -->

    @section('content')
        <!-- row -->
        <div class="row">
            <div class="col-md-12 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="post"  action="{{ route('attendance.search') }}" autocomplete="off">
                            @csrf
                            <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{__('Teacher_trans.information_search')}}</h6><br>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="student">{{__('Teacher_trans.Students')}}</label>
                                        <select class="custom-select mr-sm-2" name="student_id">
                                            <option value="0">{{__('Teacher_trans.all_students')}}</option>
                                            @foreach($students as $student)
                                                <option value="{{ $student->id }}">{{ $student->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="card-body datepicker-form">
                                    <div class="input-group" data-date-format="yyyy-mm-dd">
                                        <span class="input-group-addon">{{__('Teacher_trans.from')}}</span>
                                        <input type="text"  class="form-control range-from date-picker-default" placeholder="{{__('Teacher_trans.Start_Date')}}" required name="from">
                                        <span class="input-group-addon">{{__('Teacher_trans.to')}}</span>
                                        <input class="form-control range-to date-picker-default" placeholder="{{__('Teacher_trans.End_date')}}" type="text" required name="to">

                                    </div>
                                </div>

                            </div>
                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('Students_trans.submit')}}</button>
                        </form>
                        @isset($StudentsAttendance)
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                       style="text-align: center">
                                    <thead>
                                    <tr>
                                        <th class="alert-success">#</th>
                                        <th class="alert-success">{{trans('Students_trans.name')}}</th>
                                        <th class="alert-success">{{ trans('Students_trans.education_level') }}</th>
                                        <th class="alert-success"> {{ trans('Students_trans.classroom') }}</th>
                                        <th class="alert-success">{{__('Teacher_trans.Date')}}</th>
                                        <th class="alert-warning">{{__('Teacher_trans.Status')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($StudentsAttendance as $attendance)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{$attendance->students()->first()->name}}</td>
                                            <td>{{$attendance->students()->first()->grade->Name}}</td>
                                            <td>{{$attendance->students()->first()->section->Name_Section}}</td>
                                            <td>{{$attendance->attendence_date}}</td>
                                            <td>

                                                @if($student->attendence_status == 0)
                                                    <span class="text-danger">{{__('attendance_trans.absence')}}</span>
                                                @else
                                                    <span class="text-success">{{__('attendance_trans.attendance')}}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @include('pages.Students.Delete')
                                    @endforeach
                                </table>
                            </div>
                        @endisset

                    </div>
                </div>
            </div>
        </div>
        <!-- row closed -->
    @endsection
    @section('js')

    @endsection
