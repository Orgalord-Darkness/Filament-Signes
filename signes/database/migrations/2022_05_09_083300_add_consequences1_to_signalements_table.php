<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConsequences1ToSignalementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consequence1_signalement', function (Blueprint $table) {
            $table->unsignedInteger('signalement_id')->nullable()->index('consequence1_signalement_id_foreign')->comment('Relation vers signalements');
            $table->unsignedInteger('consequence1_id')->nullable()->index('signalement_consequence1_id_foreign')->comment('Relation vers options');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consequence1_signalement');
    }
}
