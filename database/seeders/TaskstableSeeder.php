<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskstableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = [
            [
                'task_name' =>'日本時刻テスト',
                'due_date' =>'2026-03-29',
                'is_deleted' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
//            [
//                'task_name' =>'Task 2',
//                'due_date' =>'2026-03-30',
//                'is_deleted' => false,
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
//            [
//                'task_name' =>'Task 3',
//                'due_date' =>'2026-03-31',
//                'is_deleted' => false,
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
        ];

        foreach($tasks as $task){
            \App\Models\Task::create($task);
        }

    }
}
