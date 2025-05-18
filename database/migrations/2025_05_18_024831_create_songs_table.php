<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function down(): void
    {
        Schema::dropIfExists('songs');
    }

    public function up(): void
    {
        Schema::create('songs', static function (Blueprint $table): void {
            $table->id();
            $table->string('name')->unique();
            $table->decimal('value', 10, 4);
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
