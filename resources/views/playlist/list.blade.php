@extends('_layouts/default')

@section('content')

<h3>{{ session('ActiveUser') }} Playlists</h3>

<div class="row">
	<div class="col-lg-12 col-md-12">
		<table class="table">
			<thead>
				<th>Playlist No.</th>
				<th>Playlist</th>
				<th>Track Count</th>
				<th>On Spotify</th>
			</thead>
			<tbody>
				<?php $i = 1 ?>
				@foreach($playlists as $pl)
				<tr>

				<td><?php echo $i ?></td>
				<td data-pl-url="{{ urlencode($pl->href) }}">
					<a href="/playlist/view/{{ $pl->id }}">
						{{ $pl->name }}
					</a>
				</td>
				<td>{{ $pl->tracks->total }}</td>
				<td>
					<a href="{{ $pl->external_urls->spotify }}" target="_blank">View Now</a>
				</td>

				</tr>
				<?php $i++ ?>
				@endforeach
			</tbody>
		</table>
	</div>
</div><!-- /.row -->

@endsection

@section('scripts')



@endsection