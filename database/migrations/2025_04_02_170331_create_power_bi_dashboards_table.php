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
        Schema::create('power_bi_dashboards', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('embed_url');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->json('permissions')->nullable();
            $table->timestamps();
        });
    }
 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('power_bi_dashboards');
    }
};