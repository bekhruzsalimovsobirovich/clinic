<?php

use App\Domain\Patients\Models\Patient;
use App\Domain\Services\Models\Service;
use App\Models\User;
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
        Schema::create('payment_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Patient::class)
                ->index()
                ->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Service::class)
                ->index()
                ->nullable()
                ->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->tinyInteger('status')->default(0)->comment('to\'langan bo\'lsa 1, to\'lanmagan bo\'lsa 0');
            $table->tinyInteger('return_status')->default(0)->comment('qayta navbat holati 1, 0 bo\'lsa birinchi marta kelgan');
            $table->json('pays')->nullable()->comment('to\'lovlar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_histories');
    }
};
