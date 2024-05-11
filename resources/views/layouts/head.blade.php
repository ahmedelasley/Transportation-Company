<!-- Title -->
<title>
  @hasSection('sub-title')
    {{ SettingHelper::setting('name') }} | @yield('sub-title') 
  @else
  {{ config(['app.name' => SettingHelper::setting('name')]) }}
  @endif
</title>
<!-- Favicon -->
<link rel="icon" href="{{URL::asset('assets/img/brand/favicon.png')}}" type="image/x-icon"/>
<!-- Icons css -->
<link href="{{URL::asset('assets/css/icons.css')}}" rel="stylesheet">
<!--  Custom Scroll bar-->
<link href="{{URL::asset('assets/plugins/mscrollbar/jquery.mCustomScrollbar.css')}}" rel="stylesheet"/>
<!--  Sidebar css -->
<link href="{{URL::asset('assets/plugins/sidebar/sidebar.css')}}" rel="stylesheet">
<!-- Sidemenu css -->
<link rel="stylesheet" href="{{URL::asset('assets/css'. (App::getLocale() == 'ar' ? '-rtl' : '').'/sidemenu.css')}}">
<!-- Bootstrap-icons css -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@yield('css')
<!--- Style css -->
<link href="{{URL::asset('assets/css'. (App::getLocale() == 'ar' ? '-rtl' : '').'/style.css')}}" rel="stylesheet">
<!--- Dark-mode css -->
<link href="{{URL::asset('assets/css'. (App::getLocale() == 'ar' ? '-rtl' : '').'/style-dark.css')}}" rel="stylesheet">
<!---Skinmodes css-->
<link href="{{URL::asset('assets/css'. (App::getLocale() == 'ar' ? '-rtl' : '').'/skin-modes.css')}}" rel="stylesheet">

<style>
html, body {
  height: 100%;
  margin: 0;
}

</style>