<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->text('question')->nullable();
            $table->text('reponse')->nullable();
            $table->boolean('actif');

            $table->unsignedInteger('catfaq_id')->index('catfaqs_faqs')->comment('Relation vers Catégorie FAQ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faqs');
    }
}

