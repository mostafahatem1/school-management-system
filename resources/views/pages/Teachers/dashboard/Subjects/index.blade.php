@extends('layouts.master')
@section('css')

    @section('title')
        {{__('subjects_trans.List_Subjects')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{__('subjects_trans.List_Subjects')}}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row container" >

        <section style="background-color: #eee;">
            <div class="container py-5">
                <div class="row justify-content-center">
                    @foreach($subjects as $subject)
                        <div class="card text-black m-5">
                            <a href="{{ URL::asset('attachments/subjects/'.$subject->file_name) }}"
                               target="_blank">View PDF</a><br><br>
                            <embed
                                src="{{ URL::asset('attachments/subjects/'.$subject->file_name) }}"
                                type="application/pdf" height="400px" width="400px">
                            <br><br>
                            <div class="card-body">
                                <div class="text-center">
                                    <h5 style="font-family: 'Cairo', sans-serif"
                                        class="card-title">{{$subject->name}}</h5>
                                </div>
                                <div>
                                    <div class="d-flex justify-content-between">
                                        <span>{{ trans('Students_trans.education_level') }}</span>
                                          :<span style="color: red;">{{$subject->grade->Name}}</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span>{{ trans('Students_trans.grade') }}</span>
                                        :<span style="color: red;">{{$subject->classroom->Name_Class}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>
        </section>
    </div>
    <!-- row closed -->
@endsection
@section('js')

@endsection
