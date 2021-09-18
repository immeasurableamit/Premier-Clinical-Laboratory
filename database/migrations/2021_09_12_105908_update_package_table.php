<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->integer('package_type')->default(0);
            $table->integer('customer_id');
            $table->integer('collected_by')->nullable();
            $table->enum('package_status', ['Requested', 'Pending','Completed'])->nullable()->default('Requested');
            $table->integer('employee_id')->nullable()->change();
            $table->text('secondary_barcode')->nullable()->change();
            $table->text('package_number')->nullable()->change();
            $table->integer('assign_by')->nullable()->change();
            $table->date('sample_date')->nullable();
            $table->date('book_date')->nullable();
            $table->timestamp('collected_at')->nullable();
            $table->timestamp('approved_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn('package_type');
            $table->dropColumn('customer_id');
            $table->dropColumn('collected_by');
            $table->dropColumn('package_status');
            $table->dropColumn('collected_at');
            $table->dropColumn('approved_at');
        });
    }
}
