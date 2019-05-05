<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabelTodoListItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('label_todo_list_item', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('label_id');
            $table->unsignedBigInteger('todo_list_item_id');

            $table->foreign('label_id')
                  ->references('id')
                  ->on('labels');

            $table->foreign('todo_list_item_id')
                ->references('id')
                ->on('todo_list_items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('label_todo_list_item');
    }
}
