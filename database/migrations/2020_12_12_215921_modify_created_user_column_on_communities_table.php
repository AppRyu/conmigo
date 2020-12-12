<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCreatedUserColumnOnCommunitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('communities', function (Blueprint $table) {
            $table->dropForeign('communities_created_user_foreign');
        });
        Schema::table('communities', function (Blueprint $table) {
            $table->unsignedBigInteger('created_user')->change();
            $table->foreign('created_user')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('communities', function (Blueprint $table) {
            $table->dropForeign('communities_created_user_foreign');
        });
        Schema::table('communities', function (Blueprint $table) {
            $table->string('created_user')->change();
            $table->foreign('created_user')->references('user_name')->on('users')->onDelete('cascade');
        });
    }
}
