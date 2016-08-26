@extends('_layouts/default')

@section('content')

<h3>{{ session('ActiveUser') }} Playlists</h3>

<div class="row">
	<div class="col-lg-12 col-md-12">
		<table class="table">
			<thead>
				<th>Playlist ID</th>
				<th>Playlist</th>
				<th>Track Count</th>
				<th>On Spotify</th>
			</thead>
			<tbody>
				@foreach($playlists as $pl)
				<tr>

				<td>{{ $pl->id }}</td>
				<td data-pl-url="{{ urlencode($pl->href) }}">{{ $pl->name }}</td>
				<td>{{ $pl->tracks->total }}</td>
				<td>
					<a href="{{ $pl->external_urls->spotify }}" target="_blank">View Now</a>
				</td>

				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div><!-- /.row -->

@endsection

@section('scripts')



@endsection