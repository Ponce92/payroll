<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollStruct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Tablas pivote..

        Schema::create('marital_status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table ->string('cs_name',50)->unique();
        });
        Schema::create('relationship_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table ->string('cs_name',50)->unique();
        });
        Schema::create('employee_status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table ->string('cs_name',50)->unique();
        });
        Schema::create('contract_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table ->string('cs_name',50)->unique();
        });
        Schema::create('parking_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table ->string('cs_name',50)->unique();
        });

//Tabla departamentos . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
        Schema::create('departments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cs_code')->unique();
            $table ->string('cs_name',255)->unique();
            $table ->string('cs_desc',500)->nullable();
        });

        //tabla cargos
        Schema::create('positions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table ->integer('cn_level');
            $table->string('cs_code')->unique();
            $table ->string('cs_name',255)->unique();
            $table ->string('cs_lob',50);
        });

        Schema::create('department_position', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('position_id');


            $table->foreign('department_id')
                ->references('id')
                ->on('departments')
                ->onDelete('cascade');

            $table->foreign('position_id')
                ->references('id')
                ->on('positions')
                ->onDelete('cascade');
        });

        //Tabla personas
        Schema::create('persons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cs_name');
            $table->string('cs_last_name');
            $table->boolean('cb_sexo');
            $table->unsignedBigInteger('marital_status_id')->nullable();
            $table->date('cd_birth_date');
            $table->string('cs_dui',10)->unique();
            $table->string('cs_nit',17)->unique();
            $table->string('cs_address');
            $table->string('cs_email')->nullable();

            $table->foreign('marital_status_id')
                ->references('id')
                ->on('marital_status')
                ->onDelete('cascade');
        });

        //Tabla empleados. . .
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('person_id')->nullable();
            $table->string('cs_code')->unique();
            $table->unsignedBigInteger('employee_status_id');
            $table->unsignedBigInteger('contract_type_id');
            $table->unsignedBigInteger('parking_type_id');
            $table->unsignedBigInteger('position_id');
            $table->unsignedBigInteger('department_id');

            $table->string('cs_user_vic')->nullable();
            $table->date('cd_entry_date');
            $table->date('cd_end_date')->nullable();
            $table->string('cs_headset_code')->nullable();
            $table->string('cs_email')->nullable()->unique();
            $table->string('cs_loker')->nullable();
            $table->string('cs_biometric')->nullable();


            $table->foreign('person_id')
                    ->references('id')
                    ->on('persons')
                    ->onDelete('cascade');

            $table->foreign('employee_status_id')
                ->references('id')
                ->on('employee_status')
                ->onDelete('cascade');

            $table->foreign('department_id')
                ->references('id')
                ->on('departments')
                ->onDelete('cascade');
            $table->foreign('position_id')
                ->references('id')
                ->on('positions')
                ->onDelete('cascade');

            $table->foreign('contract_type_id')
                ->references('id')
                ->on('contract_types')
                ->onDelete('cascade');

            $table->foreign('parking_type_id')
                ->references('id')
                ->on('parking_types')
                ->onDelete('cascade');
        });

        //Tabla puestos de trabajo
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cs_code')->unique();
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('position_id');
            $table->boolean('cb_state');

            $table->foreign('department_id')
                ->references('id')
                ->on('departments')
                ->onDelete('cascade');

            $table->foreign('position_id')
                ->references('id')
                ->on('positions')
                ->onDelete('cascade');
        });

        // Relacion empleado y puesto de trabajo
        Schema::create('employee_job', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('job_id');
            $table->date('cd_entry');
            $table->date('cd_end');
            $table->string('cs_contract_type');
            $table->boolean('cb_state');

            $table->foreign('employee_id')
                ->references('id')
                ->on('employees')
                ->onDelete('restrict');

            $table->foreign('job_id')
                ->references('id')
                ->on('jobs')
                ->onDelete('restrict');
        });

        //Referencias personales;

        Schema::create('references', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cs_name');
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('relationship_type_id');
            $table ->integer('cn_number');
            $table->string('cb_emergency');

            $table->foreign('relationship_type_id')
                ->references('id')
                ->on('relationship_types')
                ->onDelete('cascade');

            $table->foreign('person_id')
                ->references('id')
                ->on('persons')
                ->onDelete('restrict');
        });
        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('person_id');
            $table->string('cn_number');
            $table->string('cb_corporate');

            $table->foreign('person_id')
                ->references('id')
                ->on('persons')
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

        Schema::dropIfExists('marital_status');
        Schema::dropIfExists('relationship_types');
        Schema::dropIfExists('employee_status');
        Schema::dropIfExists('contract_types');
        Schema::dropIfExists('parking_types');

        Schema::dropIfExists('contacts');
        Schema::dropIfExists('department_position');
        Schema::dropIfExists('employee_job');
        Schema::dropIfExists('positions');
        Schema::dropIfExists('departments');
        Schema::dropIfExists('jobs');



    }
}