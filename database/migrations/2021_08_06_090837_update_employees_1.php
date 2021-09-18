<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEmployees1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {

                $table->text('password');
                $table->enum('is_active', ['0', '1'])->nullable()->default('1');
                $table->enum('is_login', ['0', '1'])->nullable()->default('0');
                $table->text('device_id')->nullable();
                $table->text('device_token')->nullable();

            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn('password');
            $table->dropColumn('is_active');
            $table->dropColumn('is_login');
            $table->dropColumn('device_id');
            $table->dropColumn('device_token');
        });
    }
}
