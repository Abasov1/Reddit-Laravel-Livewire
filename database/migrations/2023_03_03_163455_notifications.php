<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('duduk_id');
            $table->unsignedBigInteger('post_id')->nullable();
            $table->unsignedBigInteger('comment_id')->nullable();
            $table->unsignedBigInteger('subcomment_id')->nullable();
            $table->unsignedBigInteger('subreddit_id')->nullable();
            $table->string('content');
            $table->timestamps();
            $table->unique(['user_id', 'duduk_id', 'post_id', 'comment_id', 'subreddit_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('duduk_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade');
            $table->foreign('subcomment_id')->references('id')->on('comments')->onDelete('cascade');
            $table->foreign('subreddit_id')->references('id')->on('subreddits')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
