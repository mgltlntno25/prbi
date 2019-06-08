<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('event_image');
            $table->string('event_name');
            $table->longText('description')->nullable();
            $table->string('amount')->default('0');
            $table->string('location');
            $table->date('event_date');
            $table->date('start_reg');
            $table->date('end_reg');
            $table->boolean('isExtended')->default(0);
            $table->date('extended_reg')->nullable();
            $table->string('status')->default('inactive');
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
        Schema::dropIfExists('events');
    }
}
