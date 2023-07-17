@extends('layouts.master')
@section('css')

    @section('title')
        {{__('library_trans.Edit_Files')}} ({{$book->title}})
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{__('library_trans.Edit_Files')}} ({{$book->title}})
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
                            <form action="{{route('library.update','test')}}" method="post" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-row">

                                    <div class="col">
                                        <label for="title">{{__('library_trans.Files_name')}}</label>
                                        <input type="text" name="title" value="{{$book->title}}" class="form-control">
                                        <input type="hidden" name="id" value="{{$book->id}}" class="form-control">
                                    </div>

                                    <div class="col-6">
                                        <label for="description">{{__('library_trans.description')}}</label>
                                        <textarea name="description" value="{{$book->description}}"  class="form-control"></textarea>
                                    </div>

                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="Grade_id">{{__('Students_trans.education_level')}}: <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="Grade_id">
                                                <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                                @foreach($grades as $grade)
                                                    <option  value="{{ $grade->id }}" {{$book->Grade_id == $grade->id ?'selected':''}}>{{ $grade->Name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="Classroom_id">{{trans('Students_trans.grade')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="Classroom_id">
                                                <option value="{{$book->Classroom_id}}">{{$book->classroom->Name_Class}}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="section_id">{{trans('Students_trans.classroom')}} : </label>
                                            <select class="custom-select mr-sm-2" name="section_id">
                                                <option value="{{$book->section_id}}">{{$book->section->Name_Section}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div><br>

                                <div class="form-row">
                                    <div class="col">
                                        <a href="{{ URL::asset('attachments/library/'.$book->file_name) }}"
                                           target="_blank">View PDF</a><br><br>
                                        <embed src="{{ URL::asset('attachments/library/'.$book->file_name) }}" type="application/pdf"   height="150px" width="100px"><br><br>

                                        <div class="form-group">
                                            <label for="academic_year">{{__('library_trans.attachments')}} : <span class="text-danger">*</span></label>
                                            <input type="file" accept="application/pdf"  name="file_name">
                                        </div>

                                    </div>
                                </div>

                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('Students_trans.submit')}}</button>
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
