@extends('main')

@section('title', 'Edit Post')

@section('stylesheets')
	{!! Html::style('css/select2.min.css') !!}
@endsection

@section('content')

	<div class="row">
		{!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT']) !!}
			
			<div class="col-md-8">

				<h1>Edit Post</h1>

				{{ Form::label('title', 'Title:') }}
				{{ Form::text('title', null, ['class' => 'form-control input-lg']) }}

				{{ Form::label('slug', 'Slug:', ['class' => 'form-spacing-top']) }}
				{{ Form::text('slug', null, ['class' => 'form-control']) }}
				
				{{ Form::label('category_id', 'Category:', ['class' => 'form-spacing-top']) }}
				<select class="form-control" name="category_id">
					
					@foreach($categories as $category)
						<option value='{{ $category->id }}'>
							{{ $category->name }}
						</option>
					@endforeach

				</select>

				{{ Form::label('tags', 'Tags:', ['class' => 'form-spacing-top']) }}
				<select class="form-control select2-multi" name="tags[]" multiple="multiple">
					
					@foreach($tags as $tag)
						<option value='{{ $tag->id }}'>
							{{ $tag->name }}
						</option>
					@endforeach

				</select>
				
				{{ Form::label('body', 'Body:', ['class' => 'form-spacing-top']) }}
				{{ Form::textarea('body', null, ['class' => 'form-control']) }}
			</div> <!-- /.col-md-8 -->

			<div class="col-md-4">
				<div class="well">

					<dl>
						<dt>Created At:</dt>
						<dd>{{ date('M j, Y H:ia', strtotime($post->created_at)) }}</dd>

						<dt>Last Updated:</dt>
						<dd>{{ date('M j, Y h:ia', strtotime($post->updated_at)) }}</dd>
					</dl>

					<hr>

					<div class="row">
						<div class="col-sm-6">
							{!! Html::linkRoute('posts.show', 'Cancel', [$post->id], ['class' => 'btn btn-danger btn-block']) !!}
						</div>
						<div class="col-sm-6">
							{{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}
						</div>
					</div>

				</div> <!-- /.well -->
			</div> <!-- /.col-md-4 -->

		{!! Form::close() !!}
	</div> <!-- /.row -->

	

@endsection

@section('scripts')
	{!! Html::script('js/select2.min.js') !!}

	<script type="text/javascript">
		// Set tags field to select2 field
		$(".select2-multi").select2();

		// Dynamically Set Values of Tags Form Input
		$(".select2-multi").val({!! json_encode($post->tags->pluck('id')->all()) !!}).trigger("change");


	</script>
@endsection