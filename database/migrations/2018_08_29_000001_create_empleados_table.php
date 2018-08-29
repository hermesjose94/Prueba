<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'empleados';

    /**
     * Run the migrations.
     * @table empleados
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombre', 45);
            $table->string('apellido', 45);
            $table->unsignedInteger('empresa')->comment('Llave foranea con empresa');
            $table->string('email', 45)->nullable();
            $table->string('telefono',50)->nullable();
            $table->nullableTimestamps();

            $table->index(["empresa"], 'fk_empleados_empresa_idx');


            $table->foreign('empresa', 'fk_empleados_empresa_idx')
                ->references('id')->on('empresa')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}
