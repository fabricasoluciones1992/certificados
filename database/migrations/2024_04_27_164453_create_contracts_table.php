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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->date('start');
            $table->date('end')->nullable();
            $table->double('salary');
            $table->boolean('status');
            $table->foreignId('id_users')->constrained('users');
            $table->foreignId('id_posts')->constrained('posts');
            $table->foreignId('id_type_contracts')->constrained('type_contracts');
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
        Schema::dropIfExists('contracts');
    }
};