<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id(); // id PRIMARY KEY
            $table->string('title'); // VARCHAR(255) NOT NULL
            $table->string('author'); // VARCHAR(255) NOT NULL
            $table->integer('published_year')->nullable(); // INT
            $table->string('genre', 100)->nullable(); // VARCHAR(100)

            // created_at, updated_at with default CURRENT_TIMESTAMP
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->nullable();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'))->nullable();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
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
