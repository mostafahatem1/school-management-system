@extends('layouts.master')
@section('css')

    @section('title')
        {{__('attendance_trans.attendance_absence')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{__('attendance_trans.attendance_absence')}}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-danger">
            <ul>
                <li>{{ session('status') }}</li>
            </ul>
        </div>
    @endif



    <h5 style="font-family: 'Cairo', sans-serif;color: red">{{__('attendance_trans.today_date')}} : {{ date('Y-m-d') }}</h5>
    <form method="post" action="{{ route('attendance') }}">

        @csrf
        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
               style="text-align: center">
            <thead>
            <tr>
                <th class="alert-success">#</th>
                <th>{{ trans('admin_trans.ROLL_NO') }}</th>
                <th class="alert-success">{{ trans('Students_trans.name') }}</th>
                <th class="alert-success">{{ trans('Students_trans.email') }}</th>
                <th class="alert-success">{{ trans('Students_trans.education_level') }}</th>
                <th class="alert-success">{{ trans('Students_trans.grade') }}</th>
                <th class="alert-success">{{ trans('Students_trans.classroom') }}</th>
                <th class="alert-success">{{ trans('Students_trans.classroom') }}</th>
                <th class="alert-success">{{ trans('Students_trans.Processes') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($students as $student)
                <tr>
                    <td><img src="{{ asset('attachments/students/'.$student->image) }}" alt="Image"width="25" style="border-radius: 50%;"></td>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->gender}}</td>
                    <td>{{ $student->grade->Name }}</td>
                    <td>{{ $student->classroom->Name_Class }}</td>
                    <td>{{ $student->section->Name_Section }}</td>
                    <td>

                            <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                <input name="attendences[{{ $student->id }}]" class="leading-tight"
                                       @foreach( $student->attendances()->where('attendence_date',date('Y-m-d'))->get() as $attendance)
                                           {{ $attendance->attendence_status == 1 ? 'checked' : '' }}
                                       @endforeach
                                       type="radio" value="presence">
                                <span class="text-success">{{__('attendance_trans.attendance')}}</span>
                            </label>

                            <label class="ml-4 block text-gray-500 font-semibold">
                                <input name="attendences[{{ $student->id }}]" class="leading-tight" type="radio"
                                       @foreach( $student->attendances()->where('attendence_date',date('Y-m-d'))->get() as $attendance)
                                           {{ $attendance->attendence_status == 0 ? 'checked' : '' }}
                                       @endforeach
                                       value="absent">
                                <span class="text-danger">{{__('attendance_trans.absence')}}</span>
                            </label>

                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <P>

            <button class="btn btn-success" type="submit">{{ trans('Students_trans.submit') }}</button>
        </P>
    </form><br>
    <!-- row closed -->
@endsection
@section('js')

@endsection
