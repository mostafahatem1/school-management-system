@extends('layouts.master')
@section('css')
    @livewireStyles
    @section('title')
        {{trans('quiz_trans.take_quiz')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('quiz_trans.take_quiz')}}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')

    @livewire('show-question', ['quizze_id' => $quizze_id, 'student_id' => $student_id])

@endsection
@section('js')
    @livewireScripts
@endsection
