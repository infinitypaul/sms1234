<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDatasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('datas', function(Blueprint $table) {
            $table->increments('id');
			$table->string('"streetid');
			$table->string('surname');
			$table->string('othername');
			$table->string('phone');
			$table->string('sex');
			$table->timestamps();
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    Schema::drop('datas');
	}

}
