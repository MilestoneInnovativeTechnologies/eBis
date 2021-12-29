<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupPageLayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_page_layouts', function (Blueprint $table) {
            $table->unsignedBigInteger('group')->index();
            $table->unsignedBigInteger('page')->index();
            $table->unsignedBigInteger('layout')->index();
            $table->primary(['group','page','layout']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_page_layouts');
    }
}
