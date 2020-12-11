<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('discord_id')
                ->unique()
                ->nullable();

            $table->string('username')
                ->unique()
                ->nullable();
            
            $table->string('discriminator')
                ->unique()
                ->nullable();

            $table->string('master_key_id')
                ->unique()
                ->require();
                
            $table->string('status')
                ->require()
                ->default('idle');
                
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
        Schema::dropIfExists('users');
    }
}
