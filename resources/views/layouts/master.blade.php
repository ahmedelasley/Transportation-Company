<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ App::getLocale() == 'ar' ? 'rtl' : 'ltr'}}">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
		<meta name="Author" content="Spruko Technologies Private Limited">
		<meta name="Keywords" content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4"/>
		@include('layouts.head')
		@livewireStyles
	</head>

	<body class="main-body app sidebar-mini">
		<!-- Loader -->
		<div id="global-loader">
			<img src="{{URL::asset('assets/img/loader.svg')}}" class="loader-img" alt="Loader">
		</div>
		<!-- /Loader -->
		@include('layouts.main-sidebar')		
		<!-- main-content -->
		<div class="main-content app-content">
			@include('layouts.main-header')			
			<!-- container -->
			<div class="container-fluid" style="height: 100%;">
				@yield('page-header')
				@yield('content')
				{{-- {{ $slot }} --}}
				@include('layouts.sidebar')
				@include('layouts.models')
            	@include('layouts.footer')
				@include('layouts.footer-scripts')	

				@livewireScripts


				{{-- Solve this problem page has expired --}}
				<script>
					document.addEventListener('livewire:init', () => {
						Livewire.hook('request', ({ fail }) => { 
							fail(({ status, preventDefault }) => {
								if (status === 419) {
									preventDefault()
									confirm('Your session has expired...')
									location.reload();
								}
							})
						})
					})
				</script>


				<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

				<x-livewire-alert::scripts />

				<script>
			
					window.addEventListener('close-modal', event => {
		
						// CRUD Modal
						$('#showModel').modal('hide');
						$('#createModel').modal('hide');
						$('#updateModal').modal('hide');
						$('#deleteModal').modal('hide');

						$('#showPhonesModal').modal('hide');
						$('#phoneModal').modal('hide');
						$('#deletePhoneModal').modal('hide');

						$('#passwordModal').modal('hide');
						$('#assignRoleModal').modal('hide');
						$('#assignPermissionModal').modal('hide');

						// $('#pictureModal').modal('hide');
						// $('#viewPictureModal').modal('hide');
						// $('#archiveModal').modal('hide');
						// $('#softDeleteModal').modal('hide');
						// $('#destroyModal').modal('hide');
					})


				</script>
	</body>
</html>