<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(
            'CREATE PROCEDURE proc_qtd_favorito (produto_id INT(11), qtd INT(2))
            BEGIN
                UPDATE produtos SET qtd_favorito = (qtd_favorito + (qtd)) WHERE id = produto_id;
            END'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proc_qtd_favorito');
    }
}
