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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image_url');
            $table->integer('price');
            $table->integer('stock_quantity');
            $table->integer('view')->default(0);
            $table->string('page');
            $table->dateTime('publication_date');
            $table->integer('page_count');
            $table->string('publisher');
            $table->string('language');
            $table->text('description_short')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('featured')->default(0);
            $table->unsignedBigInteger('author_id');
            $table->tinyInteger('status');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
