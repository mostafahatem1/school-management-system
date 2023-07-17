@extends('layouts.master')
@section('css')

    @section('title')
        {{__('library_trans.library')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{__('library_trans.library')}}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="tab nav-border">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#Files-02"
                                   role="tab" aria-controls="home-02"
                                   aria-selected="true">{{__('library_trans.Files')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#Online_classes-02"
                                   role="tab" aria-controls="profile-02"
                                   aria-selected="false">{{__('online_trans.Online_classes')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#quizzes-02"
                                   role="tab" aria-controls="profile-02"
                                   aria-selected="false"> {{__('quiz_trans.Quizzes')}}</a>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <!-------------               Files                ----------------------------->
                            <div class="tab-pane fade active show" id="Files-02" role="tabpanel"
                                 aria-labelledby="Files-02-tab">

                                @foreach($library as $files)

                                    <div class="alert alert-dark" role="alert">
                                        <a class="d-inline-block ">{{$files->title}}</a>
                                        <a href="{{ route('subject.student.attachment', $files->file_name) }}" title="تحميل الكتاب" class="btn btn-warning btn-sm float-right" role="button" aria-pressed="true"><i class="fas fa-download"></i></a>
                                    </div>

                                @endforeach

                            </div>


                            <!-------------               Online_classes                ----------------------------->
                            <div class="tab-pane fade" id="Online_classes-02" role="tabpanel"
                                 aria-labelledby="Online_classes-02-tab">

                                @foreach($online_classes as $online_classe)
                                    <div  style="margin-bottom: 40px; border: 1px solid black; padding: 8px">
                                        <table class="col-12" data-page-length="50">
                                            <tbody>
                                            <tr>
                                                <th>#</th>
                                                <td>{{ $loop->iteration }}</td>
                                            </tr>

                                            <tr>
                                                <th>{{__('online_trans.Topic')}}</th>
                                                <td>{{$online_classe->topic}}</td>
                                            </tr>

                                            <tr>
                                                <th>{{__('online_trans.start_at')}}</th>
                                                <td>{{$online_classe->start_at}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{__('online_trans.class_duration')}}</th>
                                                <td>{{$online_classe->duration}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{__('online_trans.Link_class')}}</th>
                                                <td class="btn btn-outline-danger"><a href="{{$online_classe->start_url}}"
                                                                           target="_blank">{{__('online_trans.Join_now')}}</a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                @endforeach
                            </div>

                            <!-------------               quizzes                ----------------------------->
                            <div class="tab-pane fade" id="quizzes-02" role="tabpanel"
                                 aria-labelledby="quizzes-02-tab">
                                @foreach($quizzes as $quiz)
                                    <div  style="margin-bottom: 40px; border: 1px solid black; padding: 8px">
                                        <table class="col-12" data-page-length="50">
                                            <tbody>
                                            <tr>
                                                <th>#</th>
                                                <td>{{ $loop->iteration }}</td>
                                            </tr>

                                            <tr>
                                                <th>{{__('quiz_trans.Quiz_name')}}</th>
                                                <td>{{$quiz->name}}</td>
                                            </tr>

                                            <tr>
                                                <th>{{__('quiz_trans.start_quiz')}}</th>
                                                <td>
                                                    @if(isset($quiz->degree()->where('student_id',auth()->user()->id)->first()->score))
                                                        {{__('quiz_trans.Degree')}} ( {{\App\Models\Question::where('quiz_id',$quiz->id)->pluck('score')->sum()}} \ <span style="color: #0000cc;"> {{$quiz->degree()->where('student_id',auth()->user()->id)->first()->score}}</span>)
                                                    @else
                                                        <a href="{{route('student_quizzes.show',$quiz->id)}}"
                                                           class="btn btn-outline-success btn-sm" role="button"
                                                           aria-pressed="true" onclick="alertAbuse()">
                                                            <i class="fas fa-person-booth"></i></a>
                                                    @endif

                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                @endforeach
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

@endsection
