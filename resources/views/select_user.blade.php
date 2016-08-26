@extends('_layouts/default')

@section('content')

<div class="row">
	<div class="col-lg-12 col-md-12">
		<h3>Available Users</h3>
	</div>
</div><!-- /.row -->

<div class="row">
	<div class="col-lg-8 col-md-8">
		<div class="list-group">

			@foreach($users as $user)
					<a href="/change_user_state?user={{ $user->username }}&active=1" class="list-group-item">{{ $user->username }}</a>
			@endforeach
		
		</div><!-- /.list-group -->
	</div>
</div><!-- /.row -->

@endsection

@section('scripts')

@endsection