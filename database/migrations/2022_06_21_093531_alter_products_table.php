<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Create field and relation to pictures table


            $table
                ->foreignId('picture_id')
                ->nullable()
                ->references('id')
                ->on('pictures')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreignId('category_id')
                ->nullable()
                ->references('id')
                ->on('categories')
                ->onUpdate('CASCADE')
                ->onDelete('set null');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['picture_id']);
            $table->dropForeign(['category_id']);
        });
    }
};
