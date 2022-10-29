
@extends('layouts.master')
@section('css')

    @section('title')
        {{trans('quiz_trans.Quizzes')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('quiz_trans.Quizzes')}}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{__('quiz_trans.Subject')}}</th>
                                            <th>{{__('quiz_trans.Quiz_name')}}</th>
                                            <th class="text-danger">{{__('quiz_trans.start_quiz')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($quizzes as $quizze)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{$quizze->subject->name}}</td>
                                                <td>{{$quizze->name}}</td>
                                                <td>
                                                    @if(isset($quizze->degree()->where('student_id',auth()->user()->id)->first()->score))
                                                        {{__('quiz_trans.Degree')}} ( {{\App\Models\Question::where('quiz_id',$quizze->id)->pluck('score')->sum()}} \ <span style="color: #0000cc;"> {{$quizze->degree()->where('student_id',auth()->user()->id)->first()->score}}</span>)
                                                    @else
                                                            <a href="{{route('student_quizzes.show',$quizze->id)}}"
                                                               class="btn btn-outline-success btn-sm" role="button"
                                                               aria-pressed="true" onclick="alertAbuse()">
                                                                <i class="fas fa-person-booth"></i></a>
                                                    @endif



                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')


        <script>
            function alertAbuse() {
                alert(" {{trans('quiz_trans.quiz_canceled_automatically')}}");
            }
        </script>

@endsection
