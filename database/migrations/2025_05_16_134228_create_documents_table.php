<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->bigIncrements('id_doc');
            $table->string('num_exp')->unique();

            $table->unsignedBigInteger('id_offi');
            $table->foreign('id_offi')->references('id_offi')->on('offices');

            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id_user')->on('users');

            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id_user')->on('users');
            
            $table->string('pdf_path');
            $table->string('status_env_doc', 1)->default('P');
            $table->string('status_doc', 1)->default('A');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
