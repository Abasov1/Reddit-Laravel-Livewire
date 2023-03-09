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
        Schema::create('notificationsettings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->boolean('frnt');
            $table->boolean('modnt');
            $table->boolean('postnt');
            $table->boolean('allnt');
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
        //
    }
};
