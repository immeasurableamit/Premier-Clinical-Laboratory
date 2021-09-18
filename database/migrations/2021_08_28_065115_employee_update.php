<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmployeeUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function($table) {
            $table->integer('days')->nullable()->default(3);
            $table->text('test_expire_date')->nullable();
            $table->text('risk_level')->nullable();
            $table->text('current_test_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function($table) {
            $table->dropColumn('days');
            $table->dropColumn('test_expire_date');
            $table->dropColumn('risk_level');
            $table->dropColumn('current_test_status');
        });
    }
}
