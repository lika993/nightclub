<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->json('movements');
        });

        \Artisan::call('db:seed', [
            '--class' => 'DancesTableSeeder',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dances');
    }
}
