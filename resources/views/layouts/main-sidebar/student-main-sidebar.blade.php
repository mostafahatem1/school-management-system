
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



                    <!-- Subjects-->
                    <li>
                        <a  href="{{route('subject_student.index')}}"><i class="fas fa-book-open"></i><span
                                class="right-nav-text">{{trans('subjects_trans.List_Subjects')}}</span></a>



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
