@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="text-center mb-5">Locatie Aanmaken</h1>
			</div>

		</div>
		<form action="{{action('LocationsController@store')}}" method="POST">
			<div class="form-group row ">
				<div class="col-lg-3"></div>
				<label class="col-lg-2" for="name">Naam</label>
				<input class="form-control col-lg-2" type="input" name="name">
			</div>
			<div class="form-group row ">
				<div class="col-lg-3"></div>
				<label class="col-lg-2" for="street">Adres</label>
				<input class="form-control col-lg-2" type="input" name="street" placeholder="Straat">
				<input class="form-control col-lg-2 ml-1" type="input" name="number" placeholder="Nr">
				<input class="form-control col-lg-2 ml-1" type="input" name="city" placeholder="Plaats">
			</div>
			<div class="form-group row">
				<div class="col-lg-3"></div>
				<label class="col-lg-2" for="spectators">Toeschouwers</label>
				<input class="form-control col-lg-1" type="input" name="spectators">
			</div>
			<div class="form-group row">
				<div class="col-lg-3"></div>
				<label class="col-lg-2" for="size">Omvang(m2)</label>
				<input class="form-control col-lg-1" type="input" name="size">
			</div>
			<div class="form-group row">
				<div class="col-lg-3"></div>
				<label class="col-lg-2" for="choir">Koor</label>
				<input class="form-control col-lg-1" type="input" name="choir">
			</div>
			<div class="form-group row">
				<div class="col-lg-5"></div>
				{{ csrf_field() }}
				<input class="btn btn-primary" type="submit" value="Aanmaken">
			</div>
		</form>
	</div>
@endsection