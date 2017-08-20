@extends('main')

@section('title', $category->name . ' Posts')

@section('content')
	
	<div class="row">
		<div class="col-md-8">
			<h1>
				{{ $category->name }} <small>Total Posts: {{ $category->posts()->count() }}</small>
			</h1>
		</div>

		<div class="col-md-2">
			<a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary btn-block" style="margin-top: 20px;">
				Edit Category
			</a>
		</div>

		<div class="col-md-2">
			{!! Form::open(['route' => ['categories.destroy', $category->id], 'method' => 'DELETE']) !!}
				{!! Form::submit('Delete Category', ['class' => 'btn btn-danger btn-block', 'style' => 'margin-top: 20px;']) !!}
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

					@foreach($category->posts as $post)
						<tr>
							<td><strong>{{ $post->id }}</strong></td>
							<td><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></td>
							<td>{{ substr($post->body, 0, 75) }}{{ strlen($post->body) > 75 ? "..." : ""}}</td>
							<td class="text-right">
														
								@if(!$post->tags->count())
									<label class="label label-danger">No Tags</label>
								@endif

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