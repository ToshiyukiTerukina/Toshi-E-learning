<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->foreignId('user_id')->onDelete('cascade')->change();
            $table->integer('activity_id')->onDelete('cascade');
            $table->string('activity_type');

            $table->dropForeign(['lesson_id']);
            $table->dropForeign(['relationship_id']);
            $table->dropColumn('lesson_id');
            $table->dropColumn('relationship_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->change();
            $table->dropColumn('activity_id');
            $table->dropColumn('activity_type');

            $table->foreignId('lesson_id')->constrained('lessons');
            $table->foreignId('relationship_id')->constrained('relationships');
        });
    }
}
