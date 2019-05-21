{{--
	Checks for errors and displays them
--}}
@if(count($errors) > 0)

	@foreach($errors->all() as $error)
		<div class="alert alert-danger text-center">
			{{$error}}
		</div>
	@endforeach

@endif
{{--
	Checks if session is 'succes', if session is 'succes' shows the message succes contains
--}}
@if(session('success'))
	<div class="alert alert-success text-center">
		{{session('success')}}
	</div>
@endif
{{--
	Checks if session is 'error', if session is 'error' shows the message succes contains
--}}
@if(session('error'))
	<div class="alert alert-danger text-center">
		{{session('error')}}
	</div>
@endif