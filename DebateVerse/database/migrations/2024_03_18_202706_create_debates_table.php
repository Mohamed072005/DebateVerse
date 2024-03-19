<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDebatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debates', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->string('img');
            $table->integer('reports')->default(0);
            $table->boolean('status')->default(1);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('categorie_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('debates');
    }
}
