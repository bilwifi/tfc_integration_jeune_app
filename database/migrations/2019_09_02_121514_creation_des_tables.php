<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationDesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('idusers');
            $table->string('nom');
            $table->string('postnom')->nullable();
            $table->string('prenom');
            $table->string('pseudo')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('idadmins');
            $table->string('nom');
            $table->string('postnom')->nullable();
            $table->string('prenom');
            $table->string('pseudo')->unique();
            $table->string('password');
            $table->text('picture');
            $table->rememberToken();
            $table->timestamps();
        });

        // Schema::create('profils', function (Blueprint $table) {
        //     $table->bigIncrements('idprofils');
        //     $table->unsignedBigInteger('idusers');
        //     $table->text('picture');
        //     $table->foreign('idusers')
        //           ->references('idusers')->on('users');
            
        // });

        Schema::create('types_offres', function (Blueprint $table) {
            $table->bigIncrements('idtypes_offres');
            $table->string('lib');
        });

        Schema::create('offres', function (Blueprint $table) {
            $table->bigIncrements('idoffres');
            $table->string('titre');
            $table->string('resume');
            $table->longText('description');
            $table->text('picture')->nullable();
            $table->enum('statut',['encours','expire'])->nullable();
            $table->unsignedBigInteger('idtypes_offres');
            $table->timestamps();
            $table->foreign('idtypes_offres')
                  ->references('idtypes_offres')->on('types_offres');
        });

        Schema::create('candidatures', function (Blueprint $table) {
            $table->bigIncrements('idcandidatures');
            $table->unsignedBigInteger('idusers');
            $table->unsignedBigInteger('idoffres');
            $table->timestamps();
            $table->foreign('idusers')
                  ->references('idusers')->on('users');
            $table->foreign('idoffres')
                  ->references('idoffres')->on('offres');
            
        });

        Schema::create('formations', function (Blueprint $table) {
            $table->bigIncrements('idformations');
            $table->unsignedBigInteger('idcandidatures');
            $table->timestamps();
            $table->foreign('idcandidatures')
                  ->references('idcandidatures')->on('candidatures');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formations');
        Schema::dropIfExists('candidatures');
        Schema::dropIfExists('offres');
        Schema::dropIfExists('types_offres');
        Schema::dropIfExists('profils');
        Schema::dropIfExists('admins');
        Schema::dropIfExists('users');
    }
}
