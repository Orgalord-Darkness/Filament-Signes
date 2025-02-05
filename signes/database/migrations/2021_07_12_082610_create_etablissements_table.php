<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtablissementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etablissements', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('delos',30);
            $table->string('nom',100);
            $table->string('statut',10);
            $table->string('type',20);
            $table->string('competence',10);
            $table->string('adresse',200);
            $table->string('adresse2',200)->nullable();
            $table->string('tel',20)->nullable();
            $table->string('email',50)->nullable();
            $table->string('territoire',50)->nullable();
            $table->boolean('actif');

            $table->unsignedInteger('secteur_id')->index('secteurs_etabs')->comment('Relation vers Secteur');
            $table->unsignedInteger('categorie_id')->index('categories_etabs')->comment('Relation vers Categorie');
            $table->unsignedInteger('commune_id')->index('communes_etabs')->comment('Relation vers Commune'); // sur N° Insee = OBJDART
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('etablissements');
    }
}
