@extends('main')

@section('title', $post->title)

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>{{ $post->title }}</h1>
			<h5>Published: {{ date('M j, Y', strtotime($post->created_at)) }}</h5>
			<p>{{ $post->body }}</p>
			<hr>
			<p>Posted In: {{ $post->category->name }}</p>
		</div>
	</div>

@endsection