<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTermTaxonomiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('term_taxonomies', function (Blueprint $table) {
            $table->increments('id');   
            $table->integer('term_id')->unsigned()->index();
            $table->string('taxonomy');
            $table->text('description')->nullable();
            $table->integer('parent')->nullable();
            $table->timestamps();
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
        });

        Schema::create('report_term_taxonomy', function (Blueprint $table) {
            $table->integer('taxonomy_id')->unsigned()->index();
            $table->integer('report_id')->unsigned()->index();
            $table->foreign('taxonomy_id')->references('id')->on('term_taxonomies')->onDelete('cascade');
            $table->foreign('report_id')->references('id')->on('reports')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('term_taxonomies');
    }
}
