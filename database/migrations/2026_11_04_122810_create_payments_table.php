<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number', 64)->unique(); // dipakai sebagai trxId (VA) / partnerReferenceNo (e-wallet)
            $table->foreignId('rental_id')->constrained('rentals')->onDelete('cascade');
            $table->decimal('amount', 12, 2);
            $table->char('currency', 3)->default('IDR');

            $table->enum('payment_method', [
                'cash', 'transfer', 'e_wallet', 'qr',
                'virtual_account', 'direct_debit',
            ]);
            $table->enum('payment_status', [
                'pending', 'paid', 'failed', 'refunded', 'expired',
            ])->default('pending');

            $table->string('channel', 50)->nullable();            // VIRTUAL_ACCOUNT_BANK_CIMB, EMONEY_OVO_SNAP, dst
            $table->string('virtual_account_no', 20)->nullable(); // khusus VA
            $table->string('customer_no', 20)->nullable();        // khusus VA
            $table->string('reference_no', 64)->nullable();       // referensi dari DOKU
            $table->string('external_id', 64)->nullable();        // dipakai untuk cek status / refund
            $table->text('payment_url')->nullable();              // URL bayar (DANA / ShopeePay / jump app)
            $table->string('response_code', 10)->nullable();      // contoh 2002400
            $table->string('response_message')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->timestamp('paid_at')->nullable();

            $table->timestamps();

            $table->index('virtual_account_no');
            $table->index('reference_no');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
