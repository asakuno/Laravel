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
        Schema::create('estate_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estate_id')->constrained()->onDelete('cascade');
            $table->string('title')->comment('タイトル');
            $table->text('description')->comment('物件概要');
            $table->string('address')->comment('住所');
            $table->decimal('price', 10, 2)->comment('値段');
            $table->decimal('square_feet', 8, 2)->comment('免責');
            $table->tinyInteger('property_type')->comment('物件タイプ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estate_profiles');
    }
};
