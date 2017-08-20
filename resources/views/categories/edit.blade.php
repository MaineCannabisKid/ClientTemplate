@extends('main')

@section('title', 'Edit Category' . $category->name)

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				{!! Form::model($category, ['route' => ['categories.update', $category->id], 'method' => 'PUT']) !!}
					<h2>Edit Category</h2>
					{{ Form::label('name', 'Name:') }}
					{{ Form::text('name', null, ['class' => 'form-control']) }}
					{{ Form::submit('Edit Category', ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }}
				{!! Form::close() !!}		
			</div>
		</div>
	</div>

@endsection