<?php

namespace App\Http\Controllers;

use App\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegistrationsController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$userId = Auth::id();
		// select a particular user by id
		$users = DB::select( 'select * from users where id = ?', [ $userId ] );
		foreach ( $users as $user ) {
			
			$type = $user->type;
			if ( $type != 3 ) {
				return redirect( '/' )->with( 'error', 'U mag deze pagina niet bezoeken' );
			}
		}
		
		return view( 'pages.registrations' );
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$userId = Auth::id();
		// select a particular user by id
		$users = DB::select( 'select * from users where id = ?', [ $userId ] );
		foreach ( $users as $user ) {
			
			$type = $user->type;
			if ( $type != 3 ) {
				return redirect( '/' )->with( 'error', 'U mag deze pagina niet bezoeken' );
			}
		}
		
		return view( 'pages.create_registrations' );
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {
		$registrations = DB::select( 'select fkId, dancers, singers, choir, type, fkReservationId from registrations INNER JOIN reservations on fkReservationId = reservationId' );
		$totaldancers  = 0;
		$totalsingers  = 0;
		$totalchoir    = 0;
		$full          = false;
		foreach ( $registrations as $registration ) {
			if ( $registration->fkId == $request->input( 'fkId' ) && $registration->fkReservationId == $request->input( 'fkReservationId' ) ) {
				return redirect( '/registrations/create' )->with( 'error', 'U heeft zich al ingeschreven bij dit stuk' );
			}
			
			if ( $registration->fkReservationId == $request->input( 'fkReservationId' ) ) {
				if ( $request->input( 'type' ) == 1 ) {
					if ( $registration->type == 1 ) {
						$totaldancers = $totaldancers + 1;
					}
					
					if ( $totaldancers >= $registration->dancers ) {
						$full = true;
					}
				}
				
				if ( $request->input( 'type' ) == 2 ) {
					if ( $registration->type == 2 ) {
						$totalsingers = $totalsingers + 1;
					}
					if ( $totalsingers >= $registration->singers ) {
						$full = true;
					}
				}
				
				if ( $request->input( 'type' ) == 3 ) {
					if ( $registration->type == 3 ) {
						$totalchoir = $totalchoir + 1;
					}
					
					if ( $totalchoir >= $registration->choir ) {
						$full = true;
					}
				}
			}
		}
		
		if ( $full == true ) {
			return redirect( '/registrations/create' )->with( 'error', 'Deze rol is al vol' );
		}
		
		$newRegistration = new Registration;
		
		$newRegistration->fkId            = $request->input( 'fkId' );
		$newRegistration->fkReservationId = $request->input( 'fkReservationId' );
		$newRegistration->type            = $request->input( 'type' );
		
		$newRegistration->save();
		
		return redirect( '/registrations' )->with( 'success', 'U heeft zich succesvol ingeschreven ' );
	}
	
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public
	function show(
		$id
	) {
		//
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public
	function edit(
		$id
	) {
		//
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int                      $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public
	function update(
		Request $request, $id
	) {
		//
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public
	function destroy(
		$id
	) {
		//
	}
}
