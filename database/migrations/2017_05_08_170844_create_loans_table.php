<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->increments('ln_id');
            $table->integer('ln_user_id')->unsigned();
            $table->integer('ln_bk_id')->unsigned();
            $table->date('ln_date');
            $table->date('ln_due_date');
            $table->integer('ln_status');
            $table->timestamps();
            $table->foreign('ln_user_id')->references('id')->on('users');
            $table->foreign('ln_bk_id')->references('bk_id')->on('books');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
