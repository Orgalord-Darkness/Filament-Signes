<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignalementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signalements', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->timestamp('date')->nullable()->default(null);
            $table->timestamp('date_evenement')->nullable()->default(null);
            $table->unsignedInteger('secteur_id')->index('secteurs_signalements')->comment('Relation vers Secteur');
            $table->unsignedInteger('etablissement_id')->index('etabs_signalements')->comment('Relation vers Etablissement');
            //Données Etablissement
            $table->string('statut',10)->nullable();
            $table->string('type',20)->nullable();
            $table->string('competence',10)->nullable();
            $table->unsignedInteger('categorie_id')->nullable()->index('categories_signalements')->comment('Relation vers Categorie');
            $table->unsignedInteger('commune_id')->nullable()->index('communes_signalements')->comment('Relation vers Commune');
            $table->string('territoire',50)->nullable();

            $table->string('public',10);
            $table->string('etat',12);
            $table->boolean('complet')->nullable();
            $table->string('civilite',3);
            $table->string('nom',50);
            $table->string('prenom',50);
            $table->string('email',50);
            $table->string('tel',20)->nullable();
            $table->unsignedInteger('fonction_id')->index('option8_signalements')->comment('Relation vers Option');

            $table->boolean('ars_info')->nullable();
            $table->boolean('ddpp_info')->nullable();
            $table->boolean('dtpjj_info')->nullable();

            $table->unsignedInteger('rub_nature1_id')->nullable()->index('rubrique1_signalements')->comment('Relation vers Rubrique');
            $table->unsignedInteger('nature1_id')->nullable()->index('option1_signalements')->comment('Relation vers Option');
            $table->unsignedInteger('rub_nature2_id')->nullable()->index('rubrique2_signalements')->comment('Relation vers Rubrique');
            $table->unsignedInteger('nature2_id')->nullable()->index('option2_signalements')->comment('Relation vers Option');
            $table->longText('nature1_autre')->nullable();
            $table->longText('nature2_autre')->nullable();

            $table->longText('description')->nullable();
            $table->string('eig',3)->nullable();
            $table->string('periode_eig',30)->nullable();
            $table->longText('periode_eig_autre')->nullable();

            $table->string('victimes_pec',20)->nullable();
            $table->string('victimes_pro',20)->nullable();
            $table->string('victimes_autre',20)->nullable();
            $table->string('perex_pec',20)->nullable();
            $table->string('perex_pro',20)->nullable();
            $table->string('perex_autre',20)->nullable();

            $table->longText('consequence1_autre')->nullable();
            $table->longText('consequence2_autre')->nullable();
            $table->longText('consequence3_autre')->nullable();

            $table->unsignedInteger('secours_id')->nullable()->index('option6_signalements')->comment('Relation vers Option');
            $table->boolean('secours_ide')->nullable();
            $table->boolean('secours_medecin')->nullable();
            $table->boolean('secours_medecin2')->nullable();
            $table->boolean('secours_police')->nullable();
            $table->boolean('secours_samu')->nullable();
            $table->boolean('secours_pompiers')->nullable();
            $table->longText('secours_non')->nullable();
            $table->longText('secours_autre')->nullable();

            $table->longText('mesure1')->nullable();
            $table->longText('mesure2')->nullable();
            $table->longText('mesure3')->nullable();
            $table->boolean('mesure3_info')->nullable();
            $table->boolean('mesure3_soutien')->nullable();
            $table->boolean('mesure3_reunion')->nullable();

            $table->string('information',20)->nullable();
            $table->longText('information_non')->nullable();
            $table->longText('information_autre')->nullable();

            $table->longText('disposition1_autre')->nullable();
            $table->longText('disposition2_autre')->nullable();
            $table->longText('disposition3_autre')->nullable();
            $table->longText('disposition4_autre')->nullable();

            $table->string('suite1',3)->nullable();
            $table->string('suite2',3)->nullable();
            $table->string('suite3',3)->nullable();

            $table->longText('evolution')->nullable();

            $table->string('media1',3)->nullable();
            $table->longText('media1_oui')->nullable();
            $table->string('media2',3)->nullable();
            $table->longText('media2_oui')->nullable();
            $table->string('media3',3)->nullable();
            $table->longText('media3_oui')->nullable();

            $table->string('maitrise',10)->nullable();
            $table->string('analyse',3)->nullable();

            $table->string('analyse_car_event',30)->nullable();
            $table->string('analyse_collect',3)->nullable();
            $table->unsignedInteger('analyse_groupe_id')->nullable()->index('option7_signalements')->comment('Relation vers Option');
            $table->longText('analyse_groupe_autre')->nullable();

            $table->unsignedInteger('user_id')->index('users_signalements')->comment('Relation vers User');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('signalements');
    }
}
