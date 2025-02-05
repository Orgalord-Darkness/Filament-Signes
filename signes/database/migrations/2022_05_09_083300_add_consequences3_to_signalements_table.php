<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConsequences3ToSignalementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consequence3_signalement', function (Blueprint $table) {
            $table->unsignedInteger('signalement_id')->nullable()->index('consequence3_signalement_id_foreign')->comment('Relation vers signalements');
            $table->unsignedInteger('consequence3_id')->nullable()->index('signalement_consequence3_id_foreign')->comment('Relation vers options');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consequence3_signalement');
    }
}
