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
    <div class="row container col-12">
        @foreach($subjects as $subject)
            <a type="button" href="{{route('subject_student.show',$subject->id)}}" class="btn btn-outline-info col-12 m-1 text-left">{{  $subject->name }}</a>
        @endforeach
    </div>
    <!-- row closed -->
@endsection
@section('js')

@endsection
