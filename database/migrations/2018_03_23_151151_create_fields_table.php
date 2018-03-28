<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fields', function (Blueprint $table) {
            $table->increments('id');
            $table->string('data_type')->nullable();
            $table->string('name')->nullable();
            $table->integer('sequence')->nullable();
            $table->string('slug')->nullable();
            $table->integer('tab_id')->unsigned()->nullable();
            $table->foreign('tab_id')->references('id')->on('tabs')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('field_member', function (Blueprint $table) {
            $table->integer('field_id')->unsigned()->nullable();
            $table->foreign('field_id')->references('id')->on('fields')->onDelete('cascade');
            $table->integer('member_id')->unsigned()->nullable();
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->integer('id')->unsigned()->nullable();
            $table->string('value')->nullable();
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
        Schema::dropIfExists('field_member');
        Schema::dropIfExists('fields');
    }
}
