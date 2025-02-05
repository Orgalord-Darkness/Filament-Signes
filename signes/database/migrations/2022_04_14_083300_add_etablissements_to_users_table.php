<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEtablissementsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etablissement_user', function (Blueprint $table) {
            $table->unsignedInteger('etablissement_id')->nullable()->index('etablissement_user_id_foreign')->comment('Relation vers users');
            $table->unsignedInteger('user_id')->nullable()->index('user_etablissement_id_foreign')->comment('Relation vers etablissements');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('etablissement_user');
    }
}
