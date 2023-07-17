
<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ url('/parent/dashboard') }}">
                <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{trans('main_trans.Dashboard')}}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('main_trans.Programname')}} </li>



        <!-- Children -->

        <li>
            <a href="{{route('sons.index')}}"><i class="fa-solid fa-child"></i><span
                    class="right-nav-text">{{trans('Parent_trans.children')}}</span></a>
        </li>

        <!-- attendance -->
        <li>
            <a href="{{route('sons.attendances')}}"><i class="fas fa-chalkboard"></i><span
                    class="right-nav-text">{{__('Teacher_trans.Attendance_absence_report')}}</span></a>
        </li>

        <!-- Financial reports-->
        <!-- <li>
            <a href="{{route('sons.fees')}}"><i class="fa-solid fa-coins"></i><span
                    class="right-nav-text">{{trans('Parent_trans.Financial_reports')}}</span></a>
        </li> -->


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
