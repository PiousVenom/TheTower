<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relics');
    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('relics', static function (Blueprint $table): void {
            $table->id();
            $table->foreignId('tier_id')->constrained('tiers')->cascadeOnDelete();
            $table->string('name');
            $table->foreignId('bonus_type_id')->constrained('bonus_types')->cascadeOnDelete();
            $table->decimal('value');
            $table->string('unlocked_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
