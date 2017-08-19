@extends('main')

@section('title', 'All Posts')

@section('content')

	<div class="row">
		<div class="col-md-10">
			<h1>All Posts</h1>
		</div>

		<div class="col-md-2">
			<a href="{{ route('posts.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Create New Post</a>
		</div>

		<div class="col-md-12">
			<hr>
		</div>
	</div><!-- /.row -->

	<div class="row">
		<div class="col-md-12">
			
			<table class="table table-hover table-striped table-condensed">
				<thead>
					<th>#</th>
					<th>Title</th>
					<th>Body</th>
					<th>Created At</th>
					<th></th>
				</thead>
				
				<tbody>
					
					@foreach($posts as $post)
						<tr>
							<td><strong>{{ $post->id }}</strong></td>
							<td>{{ $post->title }}</td>
							<td>{{ substr($post->body, 0, 75) }}{{ strlen($post->body) > 75 ? "..." : ""}}</td>
							<td>{{ date('M j, Y', strtotime($post->created_at)) }}</td>
							<td>
								<a href="{{ route('posts.show', $post->id) }}" class="btn btn-default btn-sm">View</a> 
								<a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary btn-sm">Edit</a> 
							</td>
						</tr>
					@endforeach

				</tbody>

			</table>

			<div class="text-center">
				{!! $posts->links() !!}
			</div>

		</div> <!-- /.col-md-12 -->
	</div> <!-- /.row -->

@endsection