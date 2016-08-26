@extends('_layouts/default')

@section('content')

<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="form-group">
			<label for="playlist-id"><h3>Playlist ID</h3></label>
			<input class="form-control input-lg" placeholder="Playlist ID" type"text" name="playlist-id" id="playlist-id-input">
		</div>
		<div class="form-group">
			<button type="get-tracks" id="get-playlist-tracks" class="btn btn-primary">Get Tracks</button>
		</div>
	</div><!-- /.column -->
</div><!-- /.row -->

<div class="row">
	<div class="col-lg-12 col-md-12">
		<table class="table" id="playlist-output-table">
			<thead>
				<th>Artist</th>
				<th>Track</th>
				<th>Album</th>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div><!-- /.row -->

@endsection

@section('scripts')

<script>

$('#get-playlist-tracks').click(function() {
	window.location.href = '/test';
});

$('#get-playlist-tracks').click(function() {
	var userId = 'smerfmurph';
	var playlistId = $('#playlist-id-input').val();
	var apiToken = 'BQDYN3MO1CK-byRIkDlwgLu_nkxgF_VbUSGBW_vu11OJismI1chLp0DqA7bXtQtK3PTLU1UwDsn4r9UvCYid9Q';

	var url = 'https://api.spotify.com/v1/users/' + userId;
	url += '/playlists/' + playlistId + '/tracks';

	$.ajax({
		url: url,
		type: 'GET',
		headers: {
			'Authorization': 'Bearer ' + apiToken
		}
	}).done(function(data) {
		var tracks = data.items;
		for(var i in tracks) {
			var artist = tracks[i].track.artists[0].name;
			var track = tracks[i].track.name;
			var album = tracks[i].track.album.name;
			var html = '<tr>';
			html += '<td>' + artist + '</td>';
			html += '<td>' + track + '</td>';
			html += '<td>' + album + '</td>';
			html += '</tr>';
			$('#playlist-output-table tbody').append(html);
		}
	});
});

</script>

@endsection