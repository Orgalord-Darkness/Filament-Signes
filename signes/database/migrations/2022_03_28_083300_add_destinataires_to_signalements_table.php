<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDestinatairesToSignalementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destinataire_signalement', function (Blueprint $table) {
            $table->unsignedInteger('signalement_id')->nullable()->index('destinataire_signalement_id_foreign')->comment('Relation vers signalements');
            $table->unsignedInteger('destinataire_id')->nullable()->index('signalement_destinataire_id_foreign')->comment('Relation vers options');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('destinataire_signalement');
    }
}
