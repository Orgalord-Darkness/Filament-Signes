<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionSignalementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_signalements', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('question_id')->nullable()->index('options_action_signalements2')->comment('Relation vers option');
            $table->longText('reponse')->nullable();
            $table->unsignedInteger('motif_id')->index('options_action_signalements')->comment('Relation vers option');
            $table->unsignedInteger('user_id')->index('users_action_signalements')->comment('Relation vers user');
            $table->unsignedInteger('signalement_id')->index('signalements_action_signalements')->comment('Relation vers signalement');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('action_signalements');
    }
}
