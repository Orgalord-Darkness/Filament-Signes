<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDispositions4ToSignalementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disposition4_signalement', function (Blueprint $table) {
            $table->unsignedInteger('signalement_id')->nullable()->index('disposition4_signalement_id_foreign')->comment('Relation vers signalements');
            $table->unsignedInteger('disposition4_id')->nullable()->index('signalement_disposition4_id_foreign')->comment('Relation vers options');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disposition4_signalement');
    }
}
