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
        Schema::create('activity_organization', function (Blueprint $table) {
            $table->foreignId('organization_id')->constrained();
            $table->foreignId('activity_id')->constrained();

            $table->index(['organization_id'], 'idx_act_org_organization_id');
            $table->index(['activity_id'], 'idx_act_org_activity_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activity_organization', function (Blueprint $table) {
            $table->dropForeign(['organization_id']);
            $table->dropForeign(['activity_id']);

            $table->dropIndex('idx_act_org_organization_id');
            $table->dropIndex('idx_act_org_activity_id');
        });
        Schema::dropIfExists('activity_organization');
    }
};
