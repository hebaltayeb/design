<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('course_enrollments', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('user_id');
            $table->string('payment_method')->nullable()->after('phone');
            $table->string('status')->default('pending')->after('payment_method');
            $table->text('notes')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('course_enrollments', function (Blueprint $table) {
            $table->dropColumn(['phone', 'payment_method', 'status', 'notes']);
        });
    }
};