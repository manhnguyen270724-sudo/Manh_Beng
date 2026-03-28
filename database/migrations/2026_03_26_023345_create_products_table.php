<?php

use Illuminate\Database\Migrations\Migration; // Dòng này cực kỳ quan trọng
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration // Đây là dòng số 7
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('ten');
            $table->integer('gia');
            $table->integer('so_luong');
            $table->integer('id_loai');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
