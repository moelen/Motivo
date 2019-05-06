<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLabelTodoListItemAddCascade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('label_todo_list_item', function (Blueprint $table) {
            $table->dropForeign('label_todo_list_item_label_id_foreign');
            $table->dropForeign('label_todo_list_item_todo_list_item_id_foreign');

            $table->foreign('todo_list_item_id')
                ->references('id')
                ->on('todo_list_items')
                ->onDelete('cascade');

            $table->foreign('label_id')
                ->references('id')
                ->on('labels')
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
        //
    }
}
