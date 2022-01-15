<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('reviews');

        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('reviewable_id');
            $table->string('reviewable_type');
            $table->integer('user_id')->nullable();
            $table->string('email')->nullable();
            $table->string('name');
            $table->string('phone_number')->nullable();
            $table->text('review');
            $table->integer('rating')->default(0);
            $table->boolean('approved')->default(false);
            $table->unique(['reviewable_id','reviewable_type','email','phone_number','user_id'],'unique_review');
            $table->softDeletes();
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
        Schema::dropIfExists('reviews');
    }
}
