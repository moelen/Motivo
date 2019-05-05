<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTodoListItemsTableAddSnoozeField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('todo_list_items', function (Blueprint $table) {
            $table->dateTime('display_after')
                  ->after('name')
                  ->nullable()
                  ->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('todo_list_items', function (Blueprint $table) {
            $table->dropColumn('display_after');
        });
    }
}
