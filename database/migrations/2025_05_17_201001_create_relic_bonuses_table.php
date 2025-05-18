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
        Schema::dropIfExists('relic_bonuses');
    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('relic_bonus', static function (Blueprint $table): void {
            $table->id();   // bigint unsigned PK (keeps life simple for updates)

            // ---------- Foreign keys ----------
            $table->foreignId('relic_id')
                ->constrained('relics')
                ->cascadeOnDelete();

            $table->foreignId('bonus_type_id')
                ->constrained('bonus_types')
                ->cascadeOnDelete();

            // ---------- Bonus value ----------
            // Four-decimal precision handles values like 1234.5678 or 0.0001
            $table->decimal('value', 10, 4);

            // ---------- Constraints ----------
            // Enforce ONE bonus row per relic for now.
            // Drop this index later if/when multiple bonuses per relic are allowed.
            $table->unique('relic_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
