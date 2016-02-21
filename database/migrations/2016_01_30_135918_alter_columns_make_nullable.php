<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterColumnsMakeNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('points', function($table)
        {
            $table->text('description')->nullable()->change();
        });

        Schema::table('maps', function($table)
        {
            $table->text('title')->nullable()->change();
            $table->text('description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('points', function($table)
        {
            $table->text('description')->change();
        });

        Schema::table('maps', function($table)
        {
            $table->text('title')->change();
            $table->text('description')->change();
        });
    }

}
