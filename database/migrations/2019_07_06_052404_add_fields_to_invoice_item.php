<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToInvoiceItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoice_items', function (Blueprint $table) {
            //
            $table->string('name')->after('invoice_id')->nullable();
            $table->unsignedDecimal('price',8,2)->after('name')->nullable();
            $table->text('description')->nullable()->after('price')->nullable();
            $table->string('tax_name')->nullable()->after('description')->nullable();
            $table->unsignedDecimal('tax_percent_value',8,2)->after('tax_name')->nullable();
            $table->unsignedDecimal('tax_value',8,2)->after('tax_percent_value')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoice_items', function (Blueprint $table) {
            //
        });
    }
}
