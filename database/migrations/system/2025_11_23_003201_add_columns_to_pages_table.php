<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'system';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $schema = Schema::connection($this->connection);
        
        if (!$schema->hasTable('pages')) {
            return;
        }

        $schema->table('pages', function (Blueprint $table) use ($schema) {
            // Add title column if it doesn't exist
            if (!$schema->hasColumn('pages', 'title')) {
                $table->string('title')->nullable();
            }
            
            // Add slug column if it doesn't exist
            if (!$schema->hasColumn('pages', 'slug')) {
                $table->string('slug')->nullable();
            }
            
            // Add content column if it doesn't exist
            if (!$schema->hasColumn('pages', 'content')) {
                $table->text('content')->nullable();
            }
            
            // Add meta_title column if it doesn't exist
            if (!$schema->hasColumn('pages', 'meta_title')) {
                $table->string('meta_title')->nullable();
            }
            
            // Add meta_description column if it doesn't exist
            if (!$schema->hasColumn('pages', 'meta_description')) {
                $table->text('meta_description')->nullable();
            }
            
            // Add active column if it doesn't exist
            if (!$schema->hasColumn('pages', 'active')) {
                $table->boolean('active')->default(true);
            }
            
            // Add timestamps if they don't exist
            if (!$schema->hasColumn('pages', 'created_at')) {
                $table->timestamp('created_at')->nullable();
            }
            if (!$schema->hasColumn('pages', 'updated_at')) {
                $table->timestamp('updated_at')->nullable();
            }
            
            // Add soft deletes if it doesn't exist
            if (!$schema->hasColumn('pages', 'deleted_at')) {
                $table->timestamp('deleted_at')->nullable();
            }
        });

        // Add indexes after columns are created (if slug column exists)
        if ($schema->hasColumn('pages', 'slug')) {
            $connection = $schema->getConnection();
            
            // Check if unique index exists
            $uniqueExists = $connection->selectOne(
                "SELECT COUNT(*) as count FROM information_schema.statistics 
                 WHERE table_schema = ? AND table_name = 'pages' 
                 AND column_name = 'slug' AND non_unique = 0",
                [$connection->getDatabaseName()]
            );
            
            if ($uniqueExists && $uniqueExists->count == 0) {
                try {
                    $schema->table('pages', function (Blueprint $table) {
                        $table->unique('slug');
                    });
                } catch (\Exception $e) {
                    // Index might already exist, continue
                }
            }
            
            // Check if regular index exists
            $indexExists = $connection->selectOne(
                "SELECT COUNT(*) as count FROM information_schema.statistics 
                 WHERE table_schema = ? AND table_name = 'pages' 
                 AND column_name = 'slug' AND index_name != 'PRIMARY' AND non_unique = 1",
                [$connection->getDatabaseName()]
            );
            
            if ($indexExists && $indexExists->count == 0) {
                try {
                    $schema->table('pages', function (Blueprint $table) {
                        $table->index('slug');
                    });
                } catch (\Exception $e) {
                    // Index might already exist, continue
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $schema = Schema::connection($this->connection);
        
        if (!$schema->hasTable('pages')) {
            return;
        }

        $schema->table('pages', function (Blueprint $table) {
            // Remove columns if they exist (optional - you may not want to drop them)
            // $table->dropColumn(['title', 'slug', 'content', 'meta_title', 'meta_description', 'active', 'deleted_at']);
        });
    }
};
