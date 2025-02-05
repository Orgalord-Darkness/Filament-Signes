<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->increments('id');
            $table->string('libelle', 100);
            $table->unsignedSmallInteger('ordre');
            $table->boolean('actif');

            $table->unsignedInteger('section_id')->index('sections_options')->comment('Relation vers Section');
            $table->unsignedInteger('rubrique_id')->index('rubriques_options')->comment('Relation vers Rubrique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('options');
    }
}
