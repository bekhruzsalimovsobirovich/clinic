<?php

use App\Domain\Agents\Models\Agent;
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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)
                ->index()
                ->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Agent::class)
                ->index()
                ->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('full_name');
            $table->string('workplace')->comment('ish joyi')->nullable();
            $table->date('birthday');
            $table->string('province_city')->comment('viloyat, shahar');
            $table->string('address');
            $table->string('job')->nullable();
            $table->string('phone')->nullable();
            $table->text('description')->nullable();
            $table->string('avatar')->nullable();
            $table->string('avatar_path')->nullable();
            $table->string('code')->unique();
            $table->text('body')->nullable();
            $table->json('files')->nullable();
            $table->json('mkb')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
