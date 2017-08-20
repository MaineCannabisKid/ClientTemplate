@extends('main')

@section('title', $tag . ' Posts')

@section('content')
	
	<div class="row">
		<div class="col-md-8">
			<h1>
				{{ $tag->name }} Tag <small>Total Posts: {{ $tag->posts()->count() }}</small>
			</h1>
		</div>

		<div class="col-md-2">
			<a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-primary btn-block" style="margin-top: 20px;">
				Edit Tag
			</a>
		</div>

		<div class="col-md-2">
			{!! Form::open(['route' => ['tags.destroy', $tag->id], 'method' => 'DELETE']) !!}
				{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block', 'style' => 'margin-top: 20px;']) !!}
			{!! Form::close() !!}
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<table class="table table-condensed">
				<thead>
					<tr>
						<th>ID</th>
						<th>Title</th>
						<th>Body</th>
						<th class="text-right">Tags</th>
						<th></th>
					</tr>
				</thead>

				<tbody>

					@foreach($tag->posts as $post)
						<tr>
							<td>{{ $post->id }}</td>
							<td><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></td>
							<td>{{ substr($post->body, 0, 75) }}{{ strlen($post->body) > 75 ? "..." : ""}}</td>
							<td class="text-right">
								@foreach($post->tags as $tag)
									<label class="label label-default">{{ $tag->name }}</label>
								@endforeach
							</td>
						</tr>
					@endforeach

				</tbody>
			</table>
		</div>
	</div>


@endsection