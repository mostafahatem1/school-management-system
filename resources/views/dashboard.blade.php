<!DOCTYPE html>
<html lang="en">
@section('title')
    {{trans('main_trans.Main_title')}}
@stop
<head>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="keywords" content="HTML5 Template"/>
        <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template"/>
        <meta name="author" content="potenzaglobalsolutions.com"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        @include('layouts.head')
        @livewireStyles

    </head>

<body>

<div class="wrapper">

    <!--=================================
preloader -->
<div id="pre-loader">
        <img src="{{URL::asset('assets/images/pre-loader/loader-01.svg')}}" alt="">
    </div>
    @include('layouts.main-header')

    @include('layouts.main-sidebar')

    <!--=================================
 Main content -->
    <!-- main-content -->
    <div class="content-wrapper">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="mb-0">{{__('admin_trans.Admin_Dashboard')}}</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                    </ol>
                </div>
            </div>
        </div>
        <!-- widgets -->
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-success">
                                        <i class="fas fa-user-graduate highlight-icon" aria-hidden="true"></i>
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">{{__('admin_trans.number_students')}}</p>
                                <h4>{{\App\Models\Student::count()}}</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">
                            <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a
                                href="{{route('students.index')}}" target="_blank"><span
                                    class="text-danger">{{__('admin_trans.Show_data')}}</span></a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-warning">
                                        <i class="fas fa-chalkboard-teacher highlight-icon" aria-hidden="true"></i>
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">{{__('admin_trans.number_teachers')}}</p>
                                <h4>{{\App\Models\Teacher::count()}}</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">
                            <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a
                                href="{{route('teachers.index')}}" target="_blank"><span
                                    class="text-danger">{{__('admin_trans.Show_data')}}</span></a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-success">
                                        <i class="fas fa-user-tie highlight-icon" aria-hidden="true"></i>
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">{{__('admin_trans.number_parents')}}</p>
                                <h4>{{\App\Models\My_Parent::count()}}</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">
                            <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a href="{{route('add_parent')}}"
                                                                                        target="_blank"><span
                                    class="text-danger">{{__('admin_trans.Show_data')}}</span></a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                    <span class="text-primary">
                                        <i class="fas fa-chalkboard highlight-icon" aria-hidden="true"></i>
                                    </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">{{__('admin_trans.number_classes')}}</p>
                                <h4>{{\App\Models\Section::count()}}</h4>
                            </div>
                        </div>
                        <p class="text-muted pt-3 mb-0 mt-2 border-top">
                            <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a
                                href="{{route('sections.index')}}" target="_blank"><span
                                    class="text-danger">{{__('admin_trans.Show_data')}}</span></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Orders Status widgets-->
        <div class="row">

            <div style="height: 400px;" class="col-xl-12 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="tab nav-border" style="position: relative;">
                            <div class="d-block d-md-flex justify-content-between">
                                <div class="d-block w-100">
                                    <h5 style="font-family: 'Cairo', sans-serif"
                                        class="card-title">{{__('admin_trans.last_operations_system')}}</h5>
                                </div>
                                <div class="d-block d-md-flex nav-tabs-custom">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                                        <li class="nav-item">
                                            <a class="nav-link active show" id="students-tab" data-toggle="tab"
                                               href="#students" role="tab" aria-controls="students"
                                               aria-selected="true">{{__('admin_trans.students')}}</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" id="teachers-tab" data-toggle="tab" href="#teachers"
                                               role="tab" aria-controls="teachers"
                                               aria-selected="false">{{__('admin_trans.teachers')}}
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" id="parents-tab" data-toggle="tab" href="#parents"
                                               role="tab" aria-controls="parents"
                                               aria-selected="false">{{__('admin_trans.parents')}}
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" id="fee_invoices-tab" data-toggle="tab"
                                               href="#fee_invoices"
                                               role="tab" aria-controls="fee_invoices"
                                               aria-selected="false">{{ trans('admin_trans.class_room') }}
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <div class="tab-content" id="myTabContent">

                                {{--students Table--}}
                                <div class="tab-pane fade active show" id="students" role="tabpanel"
                                     aria-labelledby="students-tab">
                                    <div class="table-responsive mt-15">
                                        <table style="text-align: center"
                                               class="table center-aligned-table table-hover mb-0">
                                            <thead>
                                            <tr class="table-info text-danger">
                                                <th>#</th>
                                                <th>{{ trans('admin_trans.ROLL_NO') }}</th>
                                                <th>{{trans('Students_trans.name')}}</th>
                                                <th>{{trans('Students_trans.email')}}</th>
                                                <th>{{trans('Students_trans.gender')}}</th>
                                                <th>{{trans('Students_trans.education_level')}}</th>
                                                <th>{{trans('Students_trans.grade')}}</th>
                                                <th>{{trans('Students_trans.classroom')}}</th>
                                                <th>{{__('admin_trans.created_at')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse(\App\Models\Student::latest()->take(5)->get() as $student)
                                                <tr>
                                                    <td><img src="{{ asset('attachments/students/'.$student->image) }}"
                                                             alt="Image" width="25" style="border-radius: 50%;"></td>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$student->name}}</td>
                                                    <td>{{$student->email}}</td>
                                                    <td>{{$student->gender}}</td>
                                                    <td>{{$student->grade->Name}}</td>
                                                    <td>{{$student->classroom->Name_Class}}</td>
                                                    <td>{{$student->section->Name_Section}}</td>
                                                    <td class="text-success">{{$student->created_at}}</td>
                                                    @empty
                                                        <td class="alert-danger"
                                                            colspan="8">{{__('admin_trans.There_is_no_data')}}</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                {{--teachers Table--}}
                                <div class="tab-pane fade" id="teachers" role="tabpanel" aria-labelledby="teachers-tab">
                                    <div class="table-responsive mt-15">
                                        <table style="text-align: center"
                                               class="table center-aligned-table table-hover mb-0">
                                            <thead>
                                            <tr class="table-info text-danger">
                                                <th>#</th>
                                                <th>{{ trans('admin_trans.ROLL_NO') }}</th>
                                                <th>{{trans('Teacher_trans.Name_Teacher')}}</th>
                                                <th>{{trans('Teacher_trans.Gender')}}</th>
                                                <th>{{trans('Teacher_trans.Joining_Date')}}</th>
                                                <th>{{trans('Teacher_trans.specialization')}}</th>
                                                <th>{{__('admin_trans.created_at')}}</th>
                                            </tr>
                                            </thead>

                                            @forelse(\App\Models\Teacher::latest()->take(5)->get() as $teacher)
                                                <tbody>
                                                <tr>
                                                    <td><img src="{{ asset('attachments/teachers/'.$teacher->image) }}"
                                                             alt="Image" width="25" style="border-radius: 50%;"></td>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$teacher->name}}</td>
                                                    <td>{{$teacher->gender}}</td>
                                                    <td>{{$teacher->Joining_Date}}</td>
                                                    <td>{{$teacher->specialization}}</td>
                                                    <td class="text-success">{{$teacher->created_at}}</td>
                                                    @empty
                                                        <td class="alert-danger"
                                                            colspan="8">{{__('admin_trans.There_is_no_data')}}</td>
                                                </tr>
                                                </tbody>
                                            @endforelse
                                        </table>
                                    </div>
                                </div>

                                {{--parents Table--}}
                                <div class="tab-pane fade" id="parents" role="tabpanel" aria-labelledby="parents-tab">
                                    <div class="table-responsive mt-15">
                                        <table style="text-align: center"
                                               class="table center-aligned-table table-hover mb-0">
                                            <thead>
                                            <tr class="table-info text-danger">
                                                <th>#</th>
                                                <th>{{ trans('Parent_trans.Name_Father') }}</th>
                                                <th>{{ trans('Parent_trans.Email') }}</th>
                                                <th>{{ trans('Parent_trans.National_ID_Father') }}</th>
                                                <th>{{ trans('Parent_trans.Phone_Father') }}</th>
                                                <th>{{__('admin_trans.created_at')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse(\App\Models\My_Parent::latest()->take(5)->get() as $parent)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$parent->Name_Father}}</td>
                                                    <td>{{$parent->email}}</td>
                                                    <td>{{$parent->National_ID_Father}}</td>
                                                    <td>{{$parent->Phone_Father}}</td>
                                                    <td class="text-success">{{$parent->created_at}}</td>
                                                    @empty
                                                        <td class="alert-danger"
                                                            colspan="8">{{__('admin_trans.There_is_no_data')}}</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                {{--sections Table--}}
                                <div class="tab-pane fade" id="fee_invoices" role="tabpanel"
                                     aria-labelledby="fee_invoices-tab">
                                    <div class="card card-statistics h-100">
                                        <div class="card-body">
                                            <div class="accordion gray plus-icon round">
                                                @foreach (\App\Models\Grade::get() as $Grade)
                                                    <div class="acd-group">
                                                        <a href="#" class="acd-heading">{{ $Grade->Name }}</a>
                                                        <div class="acd-des">
                                                            <div class="row">
                                                                <div class="col-xl-12 mb-30">
                                                                    <div class="card card-statistics h-100">
                                                                        <div class="card-body">
                                                                            <div
                                                                                class="d-block d-md-flex justify-content-between">
                                                                                <div class="d-block">
                                                                                </div>
                                                                            </div>
                                                                            <div class="table-responsive mt-15">
                                                                                <table
                                                                                    class="table center-aligned-table mb-0">
                                                                                    <thead>
                                                                                    <tr class="text-dark">
                                                                                        <th>#</th>
                                                                                        <th>{{ trans('Sections_trans.Name_classroom') }}
                                                                                        </th>
                                                                                        <th>{{ trans('Sections_trans.Name_grade') }}</th>
                                                                                        <th>{{ trans('Sections_trans.Status') }}</th>
                                                                                        <th>{{ trans('Sections_trans.Processes') }}</th>
                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    <?php $i = 0; ?>
                                                                                    @forelse ($Grade->Sections as $list_Sections)
                                                                                        <tr>
                                                                                            <?php $i++; ?>
                                                                                            <td>{{ $i }}</td>
                                                                                            <td>{{ $list_Sections->Name_Section }}</td>
                                                                                            <td>{{ $list_Sections->My_class->Name_Class }}
                                                                                            </td>
                                                                                            <td>
                                                                                                @if ($list_Sections->Status === 1)
                                                                                                    <label
                                                                                                        class="badge badge-success">{{ trans('Sections_trans.Status_classroom_AC') }}</label>
                                                                                                @else
                                                                                                    <label
                                                                                                        class="badge badge-danger">{{ trans('Sections_trans.Status_classroom_No') }}</label>
                                                                                                @endif

                                                                                            </td>
                                                                                            <td>{{ $list_Sections->created_at }} </td>

                                                                                            @empty
                                                                                                <td class="alert-danger"
                                                                                                    colspan="8">{{__('admin_trans.There_is_no_data')}}
                                                                                                </td>
                                                                                        </tr>

                                                                                    @endforelse
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <livewire:calendar/>

        <!--=================================
wrapper -->

        <!--=================================
footer -->

        @include('layouts.footer')
    </div><!-- main content wrapper end-->
</div>
</div>
</div>

<!--=================================
footer -->

@include('layouts.footer-scripts')
@livewireScripts
@stack('scripts')

</body>

</html>
