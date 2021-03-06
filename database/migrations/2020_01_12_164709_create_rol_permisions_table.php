<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolPermisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_rol', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedBigInteger('rol_id');
            $table->unsignedBigInteger('permission_id');


            $table->foreign('rol_id')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');

            $table->foreign('permission_id')
                ->references('id')
                ->on('permissions')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tlk_rol_permision');
    }
}
