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
        Schema::dropIfExists('background_skins');
    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('background_skins', static function (Blueprint $table): void {
            $table->id();
            $table->string('name')->unique();
            $table->decimal('value', 10, 4);
            $table->string('event_name');
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
