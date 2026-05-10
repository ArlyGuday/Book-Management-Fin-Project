<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        // Create regular users
        $user1 = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'role' => 'user',
        ]);

        $user2 = User::factory()->create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'role' => 'user',
        ]);

        // Create sample books for each user
        \App\Models\Book::create([
            'user_id' => $admin->id,
            'title' => 'Laravel Best Practices',
            'author' => 'Taylor Otwell',
            'description' => 'A comprehensive guide to Laravel development patterns.',
        ]);

        \App\Models\Book::create([
            'user_id' => $user1->id,
            'title' => 'PHP Advanced Concepts',
            'author' => 'John Developer',
            'description' => 'Master advanced PHP programming techniques.',
        ]);

        \App\Models\Book::create([
            'user_id' => $user1->id,
            'title' => 'Web Security Essentials',
            'author' => 'Jane Expert',
            'description' => 'Learn how to build secure web applications.',
        ]);

        \App\Models\Book::create([
            'user_id' => $user2->id,
            'title' => 'Database Design Guide',
            'author' => 'Database Pro',
            'description' => 'Optimal strategies for database architecture.',
        ]);
    }
}
