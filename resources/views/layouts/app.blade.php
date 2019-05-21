<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>{{ config('app.name', 'Laravel') }}</title>

		<!-- Scripts -->
		<script src="{{ asset('js/app.js') }}" defer></script>

		<!-- Fonts -->
		<link rel="dns-prefetch" href="//fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

		<!-- Styles -->
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	</head>
	<body>
		<div id="app">
			<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
				<div class="container">
					<a class="navbar-brand" href="{{ url('/') }}">
						{{ config('app.name', 'Laravel') }}
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse"
					        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
					        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
						<span class="navbar-toggler-icon"></span>
					</button>

					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<!-- Left Side Of Navbar -->
						<ul class="navbar-nav mr-auto">

						</ul>

						<!-- Right Side Of Navbar -->
						<ul class="navbar-nav ml-auto">
							<!-- Authentication Links -->
							@guest
								<li class="nav-item">
									<a class="nav-link" href="/pieces">Stukken</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
								</li>
								@if (Route::has('register'))
									<li class="nav-item">
										<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
									</li>
								@endif
							@else
								<?php

								$userId = Auth::id();
								// select a particular user by id
								$users = DB::select( 'select * from users where id = ?', [ $userId ] );
								foreach ( $users as $user ) {

								$type = $user->type;

								if ( $type == 1 ) {
								?>
								<li class="nav-item">
									<a href="/locations" class="nav-link">Locaties</a>
								</li>
								<li class="nav-item">
									<a href="/locations/create" class="nav-link">Locatie aanmaken</a>
								</li>
								<?php
								}elseif ( $type == 2 ) {
								?>
								<li class="nav-item">
									<a href="/reservations" class="nav-link">Boekingen</a>
								</li>
								<li class="nav-item">
									<a href="/reservations/create" class="nav-link">Locatie boeken</a>
								</li>
								<?php
								}else {
								?>
								<li class="nav-item">
									<a href="/registrations" class="nav-link">Mijn repetities</a>
								</li>
								<li class="nav-item">
									<a href="/registrations/create" class="nav-link">Inschrijven</a>
								</li>
								<?php
								}

								}
								?>
								<li class="nav-item dropdown">
									<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
									   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
										{{ Auth::user()->name }} <span class="caret"></span>
									</a>

									<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
										<a class="dropdown-item" href="{{ route('logout') }}"
										   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
											{{ __('Logout') }}
										</a>

										<form id="logout-form" action="{{ route('logout') }}" method="POST"
										      style="display: none;">
											@csrf
										</form>
									</div>
								</li>
							@endguest
						</ul>
					</div>
				</div>
			</nav>

			<main class="py-4">
				{{--
				These are the messages shown when session 'succes' or 'error' has been set
				--}}
				@include('inc.messages')
				{{--
					This is where the content from all the other views will be loaded
				--}}
				@yield('content')
			</main>
		</div>
	</body>
</html>
