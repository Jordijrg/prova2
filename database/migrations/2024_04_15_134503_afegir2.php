<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('afegir2', function (Blueprint $table) {
            $table->id();
            $table->string('titol')->nullable();
            $table->text('contingut')->nullable();
            $table->tinyInteger('visible')->default(1);
            $table->unsignedBigInteger('id_curs');
            $table->timestamps();  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
