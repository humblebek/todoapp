<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = [
            [
                'title' => 'Math Homework',
                'description' => 'Complete exercises from chapter 5 of the math textbook.',
                'completed' => 0,
            ],
            [
                'title' => 'Science Project',
                'description' => 'Prepare a presentation on renewable energy sources.',
                'completed' => 0,
            ],
            [
                'title' => 'History Essay',
                'description' => 'Write a 1000-word essay on the causes of World War I.',
                'completed' => 0,
            ],
            [
                'title' => 'Literature Reading',
                'description' => 'Read chapters 3 to 5 of "To Kill a Mockingbird" and prepare for discussion.',
                'completed' => 0,
            ],
            [
                'title' => 'Art Assignment',
                'description' => 'Create a landscape painting using acrylics for the art class.',
                'completed' => 0,
            ],
            [
                'title' => 'Computer Science Coding Challenge',
                'description' => 'Solve at least 5 coding problems on LeetCode.',
                'completed' => 0,
            ],
            [
                'title' => 'Group Project Meeting',
                'description' => 'Meet with the group to discuss the timeline for the biology project.',
                'completed' => 0,
            ],
            [
                'title' => 'Language Practice',
                'description' => 'Complete the language exercises in the workbook for French class.',
                'completed' => 0,
            ],
            [
                'title' => 'Prepare for Chemistry Quiz',
                'description' => 'Review notes and study for the quiz on chemical reactions.',
                'completed' => 0,
            ],
            [
                'title' => 'Sports Practice',
                'description' => 'Attend basketball practice and work on shooting techniques.',
                'completed' => 0,
            ],
        ];

        // Insert the tasks into the database using Task::create
        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
