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
        Schema::dropIfExists('guardians');
    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('guardians', static function (Blueprint $table): void {
            $table->id();
            $table->string('name')->unique();
            $table->decimal('value', 10, 4);
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
