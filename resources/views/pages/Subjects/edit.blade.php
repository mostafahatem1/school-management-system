@extends('layouts.master')
@section('css')

    @section('title')
        {{__('subjects_trans.edit_subject')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{__('subjects_trans.edit_subject')}}
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
                            <form action="{{route('subjects.update','test')}}" method="post" autocomplete="off">
                                {{ method_field('patch') }}
                                @csrf
                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{__('subjects_trans.Name_subject_ar')}}</label>
                                        <input type="text" name="Name_ar"
                                               value="{{ $subject->getTranslation('name', 'ar') }}"
                                               class="form-control">
                                        <input type="hidden" name="id" value="{{$subject->id}}">
                                    </div>
                                    <div class="col">
                                        <label for="title">{{__('subjects_trans.Name_subject_en')}}</label>
                                        <input type="text" name="Name_en"
                                               value="{{ $subject->getTranslation('name', 'en') }}"
                                               class="form-control">
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="inputState">{{__('subjects_trans.Educational_level')}}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="Grade_id">
                                            <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                            @foreach($grades as $grade)
                                                <option
                                                    value="{{$grade->id}}" {{$grade->id == $subject->grade_id ?'selected':''}}>{{$grade->Name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col">
                                        <label for="inputState">{{__('subjects_trans.Classroom')}}</label>
                                        <select name="Classroom_id" class="custom-select">
                                            <option
                                                value="{{ $subject->classroom->id }}">{{ $subject->classroom->Name_Class }}
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group col">
                                        <label for="inputState">{{__('subjects_trans.teacher_name')}}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="teacher_id[]" multiple>
                                            <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>


                                            @foreach($teachers as $teacher)
                                                <option
                                                    value="{{ $teacher->id }}" {{ $subject->teachers->contains($teacher->id) ? 'selected' : '' }}>
                                                    {{ $teacher->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <br> <br> <br>

                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <!-- For other browsers, show a link to the PDF file -->
                                        <a href="{{ URL::asset('attachments/subjects/'.$subject->file_name) }}"
                                           target="_blank">View PDF</a><br><br>
                                        <embed src="{{ URL::asset('attachments/subjects/'.$subject->file_name) }}" type="application/pdf"   height="150px" width="100px"><br><br>

                                        <div class="form-group">
                                            <label for="academic_year">{{__('library_trans.attachments')}} : <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" accept="application/pdf" name="file_name">
                                        </div>

                                    </div>
                                </div>
                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                                        type="submit">{{__('grades_trans.submit')}}
                                </button>
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
