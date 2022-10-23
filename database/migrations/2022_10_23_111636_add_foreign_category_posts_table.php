<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignCategoryPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            //creo colonna
            $table->unsignedBigInteger('category_id')->nullable()->after('slug');


            //creo relazione
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {

            //elimino relazione
            // $table->dropForeign('posts_category_id_foreign');
            //alternativa
            $table->dropForeign(['category_id']);

            //elimino colonna
            $table->dropColumn('category_id');
        });
    }
}
