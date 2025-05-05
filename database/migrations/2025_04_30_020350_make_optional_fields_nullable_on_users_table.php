<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('identity_card')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->string('driving_license')->nullable()->change();
            $table->string('name_bank')->nullable()->change();
            $table->string('bank_number')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('identity_card')->nullable(false)->change();
            $table->string('address')->nullable(false)->change();
            $table->string('driving_license')->nullable(false)->change();
            $table->string('name_bank')->nullable(false)->change();
            $table->string('bank_number')->nullable(false)->change();
        });
    }
};
