<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id_user');
            $table->string('name_user');
            $table->string('ape_pat_user');
            $table->string('ape_mat_user');
            $table->string('dni_user')->unique();
            $table->string('nick_user')->unique();
            $table->string('password');
            $table->string('level_user', 1)->default('U');
            $table->unsignedBigInteger('id_offi');
            $table->foreign('id_offi')->references('id_offi')->on('offices');
            $table->string('status_user', 1)->default('A');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
