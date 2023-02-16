<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sells', function (Blueprint $table) {
            $table->id();
            $table->string("bill_type");
            $table->mediumInteger('user_id')->nullable();
            $table->bigInteger('customer_id')->nullable();
            $table->string('type',30)->nullable()->default('sell');
            $table->string('invoice_no',100)->nullable();
            $table->string('discount_type',30)->nullable();
            $table->string('status',30)->nullable()->default('pending');
            $table->string('payment_status',30)->nullable()->default('due');
            $table->text('note')->nullable();
            $table->date('sell_date')->nullable();
            $table->decimal('discount',8,2)->nullable()->default(0);
            $table->decimal('discount_amount',8,2)->nullable()->default(0);
            $table->decimal('tax_amount',8,2)->nullable()->default(0);
            $table->decimal('final_amount',12,2)->nullable()->default(0);
            $table->decimal('shipping_charge',6,2)->nullable()->default(0);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sells');
    }
};
