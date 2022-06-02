<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string("last_name")->after("name");
            $table->string("telephone_number")->after("password")->nullable();
            $table->date("birthday")->after("telephone_number");
            $table->string("username")->after("birthday")->nullable();
            $table->string("avatar")->default('default_image.png');
            $table->string("info");

            $table->foreignId('role_id')->after("remember_token")->default(2)->constrained();

            /* crear clave foranea sin respetar la nomenclatura de nombres
            $table->unsignedBigInteger('role_id');

            $table->foreign('role_id')->references('id')->on('roles');
            */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(["last_name", "telephone_number", "birthday", "username", "avatar", "role_id", "info"]);
        });
    }
}
