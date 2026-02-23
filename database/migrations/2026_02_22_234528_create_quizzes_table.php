<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();

            $table->string('title', 200);
            $table->string('slug', 220)->unique();

            $table->boolean('is_active')->default(true);

            // enum string olarak tutulur cast enum ile yapılır modelde baglantı kurarken kullanacağımız enum değerleri 
            $table->string('status', 20)->default('taslak');
            $table->timestamps();

            $table->index(['is_active', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};