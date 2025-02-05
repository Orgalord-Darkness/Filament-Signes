<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDispositions1ToSignalementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disposition1_signalement', function (Blueprint $table) {
            $table->unsignedInteger('signalement_id')->nullable()->index('disposition1_signalement_id_foreign')->comment('Relation vers signalements');
            $table->unsignedInteger('disposition1_id')->nullable()->index('signalement_disposition1_id_foreign')->comment('Relation vers options');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disposition1_signalement');
    }
}
