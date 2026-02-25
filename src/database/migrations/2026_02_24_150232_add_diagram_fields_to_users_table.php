<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('full_name')->nullable()->after('name');
            $table->foreignId('colocation_id')->nullable()->after('full_name')->constrained('colocations')->nullOnDelete();
            $table->enum('role', ['admin', 'user'])->default('user')->after('email');
            $table->integer('reputation_score')->default(0)->after('role');
            $table->enum('colocation_role', ['owner', 'member'])->nullable()->after('reputation_score');
            $table->boolean('is_banned')->default(false)->after('colocation_role');
        });

        DB::table('users')->update(['full_name' => DB::raw('name')]);

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->nullable()->after('id');
        });

        DB::table('users')->update(['name' => DB::raw('full_name')]);

        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('colocation_id');
            $table->dropColumn([
                'full_name',
                'role',
                'reputation_score',
                'colocation_role',
                'is_banned',
            ]);
        });
    }
};
