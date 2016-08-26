<!DOCTYPE html>
<html lang="en">

@include('_layouts/header')

<body>
	@yield('styles')
	@if(session()->has('ActiveUser'))
		<p class="pull-right">
			{{ session('ActiveUser') }} | <a href="/change_user_state?user={{ session('ActiveUser') }}&active=0">End session</a>
		</p>
	@endif
	<div class="container">

		@yield('content')

	</div><!-- /.container -->

	@yield('scripts')
</body>

@include('_layouts/footer')

</html>