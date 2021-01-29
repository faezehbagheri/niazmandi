<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('created_at');
            $table->integer('updated_at');
            $table->string('user_id');
            $table->string('title');
            $table->integer('cat1_id');
            $table->integer('cat2_id');
            $table->integer('cat3_id');
            $table->smallInteger('view');
            $table->text('tozihat');
            $table->smallInteger('ostan_id');
            $table->smallInteger('shahr_id');
            $table->smallInteger('area_id')->nullable();
            $table->string('area_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
    }
}
