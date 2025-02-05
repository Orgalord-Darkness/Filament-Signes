<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDispositions2ToSignalementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disposition2_signalement', function (Blueprint $table) {
            $table->unsignedInteger('signalement_id')->nullable()->index('disposition2_signalement_id_foreign')->comment('Relation vers signalements');
            $table->unsignedInteger('disposition2_id')->nullable()->index('signalement_disposition2_id_foreign')->comment('Relation vers options');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disposition2_signalement');
    }
}
