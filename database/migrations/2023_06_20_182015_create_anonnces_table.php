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
        Schema::create('annonces', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('photo');
            $table->float('prix');
            $table->date('datepub');
            $table->unsignedBigInteger('userid');
            $table->Foreign("userid")->references("id")->on("users")->onDelete('cascade');
            $table->unsignedBigInteger('idville');
            $table->Foreign("idville")->references("id")->on("villes")->onDelete('cascade');
            $table->unsignedBigInteger('idcategorie');
            $table->Foreign("idcategorie")->references("id")->on("categories")->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annonces');
    }
};
