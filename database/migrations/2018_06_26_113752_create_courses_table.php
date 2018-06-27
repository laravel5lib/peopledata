<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->integer('field_id')->unsigned()->nullable();
            $table->foreign('field_id')->references('id')->on('fields')->onDelete('set null');
            $table->integer('day')->nullable();
            $table->time('hour')->nullable();
            $table->double('value')->default(0);
            $table->string('location')->nullable();
            $table->string('status')->nullable();
            $table->string('period')->nullable();
            $table->unsignedInteger('professor_id')->nullable();
            $table->foreign('professor_id')->references('id')->on('members')->onDelete('set null');
            $table->timestamps();
        });
        Schema::create('course_member', function (Blueprint $table) {
            $table->integer('course_id')->unsigned()->nullable();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->integer('member_id')->unsigned()->nullable();
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->string('status')->default('signed')->nullable();
            $table->double('payment')->default(0);
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('course_member');
        Schema::dropIfExists('courses');
    }
}
