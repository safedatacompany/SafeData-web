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
        // Drop foreign key and column from users if present
        if (Schema::hasTable('users') && Schema::hasColumn('users', 'user_type_id')) {
            Schema::table('users', function (Blueprint $table) {
                // drop foreign if exists
                try {
                    $table->dropForeign(['user_type_id']);
                } catch (\Exception $e) {
                    // ignore if constraint not present
                }

                // drop the column
                try {
                    $table->dropColumn('user_type_id');
                } catch (\Exception $e) {
                    // ignore
                }
            });
        }

        // Drop the user_types table if it exists
        if (Schema::hasTable('user_types')) {
            Schema::dropIfExists('user_types');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // recreate user_types table (minimal)
        if (!Schema::hasTable('user_types')) {
            Schema::create('user_types', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // add user_type_id column back to users table if missing
        if (Schema::hasTable('users') && !Schema::hasColumn('users', 'user_type_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->unsignedBigInteger('user_type_id')->nullable()->after('id');
                $table->foreign('user_type_id')->references('id')->on('user_types')->onDelete('cascade');
            });
        }
    }
};
