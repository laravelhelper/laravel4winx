<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'locations', function ( Blueprint $table ) {
			$table->bigIncrements( 'locationId' );
			$table->string( 'name' );
			$table->string( 'street' );
			$table->integer( 'number' );
			$table->string( 'city' );
			$table->integer( 'spectators' );
			$table->integer( 'size' );
			$table->boolean( 'choir' );
			$table->timestamps();
		} );
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'locations' );
	}
}
