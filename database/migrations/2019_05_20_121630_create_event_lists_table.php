<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('event_id');
            $table->string('event_name');
            $table->date('event_date');
            $table->string('prbi_id');
            $table->string('user_name');
            $table->string('user_email');
            $table->integer('user_age');
            $table->string('category');
            $table->string('payment_status')->default('inactive');
            $table->string('reg_status')->default('inactive');
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
        Schema::dropIfExists('event_lists');
    }
}
