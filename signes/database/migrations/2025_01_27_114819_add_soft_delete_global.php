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
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('actif');
            $table->softDeletes();
        });

        Schema::table('catfaqs', function (Blueprint $table) {
            $table->dropColumn('actif');
            $table->softDeletes();
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->dropColumn('actif');
            $table->softDeletes();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('actif');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cfam_achat', function (Blueprint $table) {
            $table->boolean('actif');
            $table->dropSoftDeletes();
        });

        Schema::table('fam_achat', function (Blueprint $table) {
            $table->boolean('actif');
            $table->dropSoftDeletes();
        });

        Schema::table('marche_reserve', function (Blueprint $table) {
            $table->boolean('actif');
            $table->dropSoftDeletes();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->boolean('actif');
            $table->dropSoftDeletes();
        });
    }
};
