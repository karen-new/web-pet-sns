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
        Schema::table('petsns_items', function (Blueprint $table) {
            $table->string('tag')->nullable(); // タグを追加
            $table->string('animal_type')->nullable(); // 動物の種類を追加
            $table->string('animal_breed')->nullable(); // 各動物の種類を追加
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('petsns_items', function (Blueprint $table) {
            $table->dropColumn('tag');
            $table->dropColumn('animal_type');
            $table->dropColumn('animal_breed');
        });
    }
};
