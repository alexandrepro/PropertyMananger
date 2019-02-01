<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('properties', function (Blueprint $table) {
			$table->increments('id');
			$table->string('address_line_1');
			$table->string('address_line_2')->nullable();
			$table->integer('city_id')->unsigned();
			$table->string('postcode');
			$table->timestamps();
			$table->engine = 'InnoDB';
			$table->charset = 'utf8';
			$table->collation = 'utf8_unicode_ci';
		});

		Schema::table('properties', function (Blueprint $table) {
			$table->foreign('city_id')
				->references('id')->on('cities')
				->onDelete('cascade')
				->onUpdate('cascade');
		});

		Schema::enableForeignKeyConstraints();
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('properties', function (Blueprint $table){
			$table->dropForeign('properties_city_id_foreign');
		});

		Schema::dropIfExists('properties');

		Schema::disableForeignKeyConstraints();
	}
}
