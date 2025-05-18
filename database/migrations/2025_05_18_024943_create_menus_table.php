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
        Schema::dropIfExists('menus');
    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menus', static function (Blueprint $table): void {
            $table->id();
            $table->timestamps();
        });
    }
};
