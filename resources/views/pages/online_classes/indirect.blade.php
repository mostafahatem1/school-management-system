@extends('layouts.master')
@section('css')

    @section('title')
        {{__('online_trans.Add_new_classes_indirect')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{__('online_trans.Add_new_classes_indirect')}}
    @stop
    <!-- breadcrumb -->
@endsection
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

                    <form method="post" action="{{ route('indirect.store') }}" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Grade_id">{{__('Quiz_trans.Educational_level')}} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="Grade_id">
                                        <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach ($Grades as $Grade)
                                            <option value="{{ $Grade->id }}">{{ $Grade->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Classroom_id">{{ trans('Students_trans.classrooms') }} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="Classroom_id">

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="section_id">{{ trans('Students_trans.section') }} : </label>
                                    <select class="custom-select mr-sm-2" name="section_id">

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="Grade_id">{{__('subjects_trans.Name_subject')}} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="subject_id">
                                        <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach ($subjects as $subjects)
                                            <option value="{{ $subjects->id }}">{{ $subjects->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="row">

                            <div class="col">
                                <div class="form-group">
                                    <label> {{__('online_trans.Meeting_ID')}} : <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" name="meeting_id" type="number">
                                </div>
                            </div>


                            <div class="col">
                                <div class="form-group">
                                    <label>{{__('online_trans.Topic')}} : <span class="text-danger">*</span></label>
                                    <input class="form-control" name="topic" type="text">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label>{{__('online_trans.date_time')}} : <span class="text-danger">*</span></label>
                                    <input class="form-control" type="datetime-local" name="start_time">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>{{__('online_trans.duration_minutes')}} : <span class="text-danger">*</span></label>
                                    <input class="form-control" name="duration" type="number">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label>{{__('online_trans.Passcode')}} : <span class="text-danger">*</span></label>
                                    <input class="form-control" name="password" type="text">
                                </div>
                            </div>


                        </div>

                        <div class="row">

                            <div class="col">
                                <div class="form-group">
                                    <label> {{__('online_trans.link_start')}}: <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" name="start_url" type="text">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label>{{__('online_trans.Link_enter_students')}} : <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" name="join_url" type="text">
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                                type="submit">{{ trans('Students_trans.submit') }}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')


@endsection
