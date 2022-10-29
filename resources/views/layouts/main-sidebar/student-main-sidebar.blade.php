
            <div class="scrollbar side-menu-bg" style="overflow: scroll">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                        <a href="{{ url('/student/dashboard') }}">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{trans('main_trans.Dashboard')}}</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('main_trans.Programname')}} </li>



                  <!-- Attendance-->
{{--                    <li>--}}
{{--                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Attendance-icon">--}}
{{--                            <div class="pull-left"><i class="fas fa-calendar-alt"></i><span class="right-nav-text">{{trans('main_trans.Attendance')}}</span></div>--}}
{{--                            <div class="pull-right"><i class="ti-plus"></i></div>--}}
{{--                            <div class="clearfix"></div>--}}
{{--                        </a>--}}
{{--                        <ul id="Attendance-icon" class="collapse" data-parent="#sidebarnav">--}}
{{--                            <li> <a href="{{route('Attendance.index')}}">{{__('attendance_trans.Student_List')}}</a> </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}

                    <!-- Subjects-->
{{--                    <li>--}}
{{--                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Subjects">--}}
{{--                            <div class="pull-left"><i class="fas fa-book-open"></i><span class="right-nav-text">{{trans('main_trans.Subjects')}}</span></div>--}}
{{--                            <div class="pull-right"><i class="ti-plus"></i></div>--}}
{{--                            <div class="clearfix"></div>--}}
{{--                        </a>--}}
{{--                        <ul id="Subjects" class="collapse" data-parent="#sidebarnav">--}}
{{--                            <li> <a href="{{route('subjects.index')}}">{{trans('subjects_trans.List_Subjects')}}</a> </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}


                    <!-- Quizzes-->

                    <li>
                        <a href="{{route('student_quizzes.index')}}"><i class="fal fa-money-check-edit"></i><span
                                class="right-nav-text">{{trans('quiz_trans.Quizzes')}}</span></a>
                    </li>

                    <!-- library-->
{{--                    <li>--}}
{{--                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#library-icon">--}}
{{--                            <div class="pull-left"><i class="fas fa-book"></i><span class="right-nav-text">{{trans('main_trans.library')}}</span></div>--}}
{{--                            <div class="pull-right"><i class="ti-plus"></i></div>--}}
{{--                            <div class="clearfix"></div>--}}
{{--                        </a>--}}
{{--                        <ul id="library-icon" class="collapse" data-parent="#sidebarnav">--}}
{{--                            <li> <a href="{{route('library.index')}}"> {{__('library_trans.Book_List')}}</a> </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}


                    <!-- Onlinec lasses-->
{{--                    <li>--}}
{{--                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Onlineclasses-icon">--}}
{{--                            <div class="pull-left"><i class="fas fa-video"></i><span class="right-nav-text">{{trans('main_trans.Onlineclasses')}}</span></div>--}}
{{--                            <div class="pull-right"><i class="ti-plus"></i></div>--}}
{{--                            <div class="clearfix"></div>--}}
{{--                        </a>--}}
{{--                        <ul id="Onlineclasses-icon" class="collapse" data-parent="#sidebarnav">--}}
{{--                            <li> <a href="{{route('online_classes.index')}}">{{__('online_trans.Online_classes')}}</a> </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}

                    <!-- Profile -->
                    <li>
                        <a href="{{route('profile-student.index')}}"><i class="fas fa-id-card-alt"></i><span
                                class="right-nav-text">{{__('Teacher_trans.Profile')}}</span></a>
                    </li>


                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
