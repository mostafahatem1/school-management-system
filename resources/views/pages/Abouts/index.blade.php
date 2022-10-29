@extends('layouts.master')
@section('css')

    @section('title')
       {{__('about_trans.About')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{__('about_trans.About')}}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')


    @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <form enctype="multipart/form-data" method="post" action="{{route('abouts.update','test')}}">
                        @csrf @method('PUT')
                        <div class="row">
                            <div class="col-md-6 border-right-2 border-right-blue-400">
                                <div class="form-group ">
                                    <label class="col-lg-9 col-form-label font-weight-semibold"> {{__('about_trans.school_logo')}}</label>
                                    <div class="col-lg-9">
                                        <div class="mb-3">
                                            <img style="height: 60px; width: 150px"  height="100px" src="{{ URL::asset('attachments/logo/'.$about['logo']) }}" alt="">
                                        </div>
                                        <input name="logo" accept="image/*" type="file" class="file-input" data-show-caption="false" data-show-upload="false" data-fouc>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label class="col-lg-9 col-form-label font-weight-semibold">{{__('about_trans.School_name')}}<span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="school_name" value="{{ $about['school_name'] }}" required type="text" class="form-control" placeholder="Name of School">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="current_session" class="col-lg-9 col-form-label font-weight-semibold">{{__('about_trans.current_year')}}<span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <select data-placeholder="Choose..." required name="current_session" id="current_session" class="custom-select">
                                            <option value=""></option>
                                            @for($y=date('Y', strtotime('- 3 years')); $y<=date('Y', strtotime('+ 1 years')); $y++)
                                                <option {{ ($about['current_session'] == (($y-=1).'-'.($y+=1))) ? 'selected' : '' }}>{{ ($y-=1).'-'.($y+=1) }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-lg-9 col-form-label font-weight-semibold">{{__('about_trans.name_abbreviation')}}</label>
                                    <div class="col-lg-9">
                                        <input name="school_title" value="{{ $about['school_title'] }}" type="text" class="form-control" placeholder="School Acronym">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-lg-9 col-form-label font-weight-semibold">{{__('about_trans.phone')}}</label>
                                    <div class="col-lg-9">
                                        <input name="phone" value="{{ $about['phone'] }}" type="text" class="form-control" placeholder="Phone">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-lg-9 col-form-label font-weight-semibold">{{__('about_trans.E_mail')}}</label>
                                    <div class="col-lg-9">
                                        <input name="school_email" value="{{ $about['school_email'] }}" type="email" class="form-control" placeholder="School Email">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-lg-9 col-form-label font-weight-semibold">{{__('about_trans.school_address')}}<span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input required name="address" value="{{ $about['address'] }}" type="text" class="form-control" placeholder="School Address">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-lg-9 col-form-label font-weight-semibold">{{__('about_trans.end_first_term')}}</label>
                                    <div class="col-lg-9">
                                        <input name="end_first_term" value="{{ $about['end_first_term'] }}" type="text" class="form-control range-to date-picker-default" placeholder="Date Term Ends">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-lg-9 col-form-label font-weight-semibold">{{__('about_trans.End_second_term')}}</label>
                                    <div class="col-lg-9">
                                        <input name="end_second_term" value="{{ $about['end_second_term'] }}" type="text" class="form-control range-to date-picker-default" placeholder="Date Term Ends">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('Students_trans.submit')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')

@endsection
