<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('phones', function (Blueprint $table) {
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->string('number', 255);
            $table->timestamps();

            $table->index(['organization_id'], 'idx_phones_org_id');
            $table->unique(['organization_id', 'number'], 'unique_org_phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('phones', function (Blueprint $table) {
            $table->dropForeign(['organization_id']);
            $table->dropUnique('unique_org_phone');
            $table->dropIndex('idx_phones_org_id');
        });
        Schema::dropIfExists('phones');
    }
};
