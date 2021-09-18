<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PackagesUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->text('genes')->nullable();
            $table->text('s_gene')->nullable();
            $table->text('n_gene')->nullable();
            $table->text('orf_1_ab')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('packages', function($table) {
            $table->dropColumn('genes');
            $table->dropColumn('s_gene');
            $table->dropColumn('n_gene');
            $table->dropColumn('orf_1_ab');
        });
    }
}
