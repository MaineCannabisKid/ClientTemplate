@extends('main')

@section('title', 'View Post')

@section('content')

	<div class="row">

		<div class="col-md-8">
			<h1>{{ $post->title }}</h1>
			<p class="lead">{{ $post->body }}</p>

			<hr>
			
			<div class="tags">
				@foreach ($post->tags as $tag)
					<span class="label label-default">{{ $tag->name }}</span>		
				@endforeach
			</div>

		</div> <!-- /.col-md-8 -->

		<div class="col-md-4">
			<div class="well">

				<dl>
					<dt>URL:</dt>
					<dd>
						<a href="{{ route('blog.single', $post->slug) }}">
							{{ route('blog.single', $post->slug) }}
						</a>
					</dd>

					<dt>Created At:</dt>
					<dd>{{ date('M j, Y H:ia', strtotime($post->created_at)) }}</dd>

					<dt>Last Updated:</dt>
					<dd>{{ date('M j, Y h:ia', strtotime($post->updated_at)) }}</dd>

					<dt>Category:</dt>
					<dd>{{ $post->category_id ? $post->category->name : "No Category Specified" }}</dd>
				</dl>

				<hr>

				<div class="row">
					<div class="col-sm-6">
						{!! Html::linkRoute('posts.edit', 'Edit', [$post->id], ['class' => 'btn btn-primary btn-block']) !!}
					</div>
					<div class="col-sm-6">
						{!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'DELETE']) !!}
						
						{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}

						{!! Form::close() !!}
					</div>
				</div>

				<div class="row">
					<div class="col-sm-12">
						{!! Html::linkRoute('posts.index', '<< Show All Posts', [], ['class' => 'btn btn-default btn-block btn-h1-spacing']) !!}
					</div>
				</div>

			</div> <!-- /.well -->

		</div> <!-- /.col-md-4 -->

	</div> <!-- /.row -->

	

@endsection