<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDispositions3ToSignalementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disposition3_signalement', function (Blueprint $table) {
            $table->unsignedInteger('signalement_id')->nullable()->index('disposition3_signalement_id_foreign')->comment('Relation vers signalements');
            $table->unsignedInteger('disposition3_id')->nullable()->index('signalement_disposition3_id_foreign')->comment('Relation vers options');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disposition3_signalement');
    }
}
