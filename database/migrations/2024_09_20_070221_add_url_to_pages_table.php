<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; // Make sure to import Str for slugging

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('url')->nullable()->after('id');
        });

        $pages = DB::table('pages')->get();
        foreach ($pages as $page) {
            $uniqueUrl = Str::slug($page->title) . '-' . $page->id; 
            DB::table('pages')->where('id', $page->id)->update(['url' => $uniqueUrl]);
        }

        Schema::table('pages', function (Blueprint $table) {
            $table->string('url')->unique()->change(); // Make it unique
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('url');
        });
    }
};
