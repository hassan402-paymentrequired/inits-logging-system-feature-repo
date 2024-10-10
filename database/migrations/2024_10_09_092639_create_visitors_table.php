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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("phone_number");
            $table->longText("purpose_of_visit");
            $table->foreignId("admin_id")->constrained("users", "id")->cascadeOnDelete();
            $table->foreignId("staff_id")->nullable()->default(null)->constrained("users", "id")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
