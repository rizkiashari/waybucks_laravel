<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid_transaction', 100);
            $table->foreignId('user_id');
            $table->string('name_transaction', 100);
            $table->string('email_transaction', 100);
            $table->string('phone_transaction', 15);
            $table->integer('postal_code_transaction');
            $table->text('address_transaction');
            $table->string('attach_transaction');
            $table->integer('total_transaction');
            $table->string('status_transaction', 100);
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
        Schema::dropIfExists('transactions');
    }
}
