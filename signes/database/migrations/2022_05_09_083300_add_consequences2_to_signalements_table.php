<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConsequences2ToSignalementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consequence2_signalement', function (Blueprint $table) {
            $table->unsignedInteger('signalement_id')->nullable()->index('consequence2_signalement_id_foreign')->comment('Relation vers signalements');
            $table->unsignedInteger('consequence2_id')->nullable()->index('signalement_consequence2_id_foreign')->comment('Relation vers options');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consequence2_signalement');
    }
}
