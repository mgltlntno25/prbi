<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application__lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('user_name');
            $table->string('user_email');
            $table->string('valid_id');
            $table->string('application_description');
            $table->string('payment_status')->default('inactive');
            $table->string('application_status')->default('inactive');

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
        Schema::dropIfExists('application__lists');
    }
}
