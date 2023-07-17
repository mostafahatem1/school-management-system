<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>{{\App\Models\About::where('key','school_name')->first()->value}}</title>
    @include('layouts.head')
</head>

<body>


<div class="wrapper">

    <section class="height-100vh d-flex align-items-center page-section-ptb login"
             style="background-image: url('{{ asset('assets/images/sativa.png')}}');">
        <div class="container">

            <div class="row justify-content-center no-gutters vertical-align">
                <div style="border-radius: 15px;" class="col-lg-8 col-md-8 bg-white">
                    <div class="login-fancy pb-40 clearfix">
                        <h3 style="font-family: 'Cairo', sans-serif" class="mb-30">{{__('auth.Select_way')}}</h3>
                        <div class="form-inline">
                            <a class="btn btn-default col-lg-3" title="{{__('auth.student')}}" href="{{route('login.show','student')}}">
                                <img alt="user-img" width="100px;" src="{{URL::asset('assets/images/student.png')}}">
                            </a>
                            <a class="btn btn-default col-lg-3" title="{{__('auth.parent')}}" href="{{route('login.show','parent')}}">
                                <img alt="user-img" width="100px;" src="{{URL::asset('assets/images/parent.png')}}">
                            </a>
                            <a class="btn btn-default col-lg-3" title="{{__('auth.teacher')}}" href="{{route('login.show','teacher')}}">
                                <img alt="user-img" width="100px;" src="{{URL::asset('assets/images/teacher.png')}}">
                            </a>
                            <a class="btn btn-default col-lg-3" title="{{__('auth.admin')}}" href="{{route('login.show','admin')}}">
                                <img alt="user-img" width="100px;" src="{{URL::asset('assets/images/admin.png')}}">
                            </a>
                        </div>

                    </div>
                </div>
            </div>
            <ul class="nav navbar-nav ml-auto">
                <div class="btn-group mb-1">
                    <button type="button" class="btn btn-light btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if (App::getLocale() == 'ar')
                    {{ LaravelLocalization::getCurrentLocaleName() }}
                    <img src="{{ URL::asset('assets/images/flags/EG.png') }}" alt="">
                @elseif(App::getLocale() == 'en')
                    {{ LaravelLocalization::getCurrentLocaleName() }}
                    <img src="{{ URL::asset('assets/images/flags/US.png') }}" alt="">
                @else
                    {{ LaravelLocalization::getCurrentLocaleName() }}
                    <img src="{{ URL::asset('assets/images/flags/DE.png') }}" alt="">
                @endif
                    </button>
                    <div class="dropdown-menu">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['native'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </ul>
        </div>
    </section>

    <!--=================================
login-->

</div>
<!-- jquery -->
<script src="{{ URL::asset('assets/js/jquery-3.3.1.min.js') }}"></script>
<!-- plugins-jquery -->
<script src="{{ URL::asset('assets/js/plugins-jquery.js') }}"></script>
<!-- plugin_path -->
<script>
    var plugin_path = 'js/';

</script>


<!-- toastr -->
@yield('js')
<!-- custom -->
<script src="{{ URL::asset('assets/js/custom.js') }}"></script>

</body>

</html>
