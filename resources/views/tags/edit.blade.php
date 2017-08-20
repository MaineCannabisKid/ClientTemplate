@extends('main')

@section('title', 'Edit Tag' . $tag->name)

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				{!! Form::model($tag, ['route' => ['tags.update', $tag->id], 'method' => 'PUT']) !!}
					<h2>Edit Tag</h2>
					{{ Form::label('name', 'Name:') }}
					{{ Form::text('name', null, ['class' => 'form-control']) }}
					{{ Form::submit('Edit Tag', ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }}
				{!! Form::close() !!}		
			</div>
		</div>
	</div>

@endsection