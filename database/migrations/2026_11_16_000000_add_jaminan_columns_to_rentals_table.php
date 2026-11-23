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
        Schema::table('rentals', function (Blueprint $table) {
            $table->enum('jaminan_type', ['ktp', 'sim', 'ktm', 'kartu_pelajar'])->nullable()->after('jaminan');
            $table->enum('jaminan_status', ['belum_diterima', 'ditahan', 'dikembalikan'])->default('belum_diterima')->after('jaminan_type');
            $table->timestamp('jaminan_received_at')->nullable()->after('jaminan_status');
            $table->timestamp('jaminan_returned_at')->nullable()->after('jaminan_received_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rentals', function (Blueprint $table) {
            $table->dropColumn([
                'jaminan_type',
                'jaminan_status',
                'jaminan_received_at',
                'jaminan_returned_at',
            ]);
        });
    }
};
