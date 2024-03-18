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
        Schema::create('class_mkb', function (Blueprint $table) {
            $table->id();
            $table->text('name')->comment('Наименование');
            $table->text('code')->comment('Код');
            $table->unsignedBigInteger('parent_id')->nullable()->comment('Вышестоящий объект');
            $table->string('parent_code')->nullable()->comment('Код вышестоящего объекта');
            $table->smallInteger('node_count')->default(0)->comment('Количество вложенных в текущую ветку');
            $table->text('additional_info')->nullable()->comment('Дополнительные данные');
            $table->index('parent_id');
            $table->index('parent_code');

            // Foreign key constraint
            $table->foreign('parent_id')->references('id')->on('class_mkb')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mkb');
    }
};
