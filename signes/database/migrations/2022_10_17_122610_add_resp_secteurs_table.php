<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRespSecteursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('secteurs', function (Blueprint $table) {
            $table->string('email2', 50)->nullable()->after('email');
            $table->unsignedInteger('responsable_id')->nullable()->index('secteur_user_id_foreign')->comment('Relation vers users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('secteurs', function (Blueprint $table) {
            $table->dropColumn('email2');
            $table->dropColumn('responsable_id');
        });
    }
}
