<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoryIdToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Add category id to posts table
            $table->integer('category_id')->nullable()->after('slug')->unsigned();
            // Add foreign Key to category_id column
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('Set NULL');
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
            // Remove Foreign Key before dropping column
            $table->dropForeign('posts_category_id_foreign');
        });

        Schema::table('posts', function (Blueprint $table) {
            // Drop the category id column
            $table->dropColumn('category_id');
        });


    }
}
