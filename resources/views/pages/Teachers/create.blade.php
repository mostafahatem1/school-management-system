@extends('layouts.master')
@section('css')

    @section('title')
        {{ trans('Teacher_trans.Add_Teacher') }}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{ trans('Teacher_trans.Add_Teacher') }}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">


                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{route('teachers.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{trans('Teacher_trans.Email')}}</label>
                                        <input type="email" name="Email" class="form-control">
                                        @error('Email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="title">{{trans('Teacher_trans.Password')}}</label>
                                        <input type="password" name="Password" class="form-control">
                                        @error('Password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>


                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{trans('Teacher_trans.Name_ar')}}</label>
                                        <input type="text" name="name_en" class="form-control">
                                        @error('Name_ar')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="title">{{trans('Teacher_trans.Name_en')}}</label>
                                        <input type="text" name="name_ar" class="form-control">
                                        @error('Name_en')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="inputCity">{{trans('Teacher_trans.specialization')}}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="specialization">
                                            <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                            @foreach($specializations as $specialization)
                                                <option
                                                    value="{{$specialization->Name}}">{{$specialization->Name}}</option>
                                            @endforeach
                                        </select>
                                        @error('Specialization_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col">
                                        <label for="inputState">{{trans('Teacher_trans.Gender')}}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="gender">
                                            <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                            @foreach($genders as $gender)
                                                <option value="{{$gender->Name}}">{{$gender->Name}}</option>
                                            @endforeach
                                        </select>
                                        @error('Gender_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{trans('Teacher_trans.Joining_Date')}}</label>
                                        <div class='input-group date'>
                                            <input class="form-control" type="text" id="datepicker-action"
                                                   name="Joining_Date" data-date-format="yyyy-mm-dd" required>
                                        </div>
                                        @error('Joining_Date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">{{trans('Teacher_trans.Address')}}</label>
                                    <textarea class="form-control" name="address"
                                              id="exampleFormControlTextarea1" rows="4"></textarea>
                                    @error('Address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="academic_year"> {{trans('Students_trans.personal_photo')}} : <span class="text-danger">*</span></label>
                                    <input type="file" accept="image/*" name="image">
                                </div>

                                <br>


                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                                        type="submit">{{trans('Teacher_trans.Save')}}</button>
                                <a href="{{route('teachers.index')}}"
                                   class="btn btn-danger btn-sm nextBtn btn-lg pull-right">{{trans('Teacher_trans.Back')}}</a>
                            </form>
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
