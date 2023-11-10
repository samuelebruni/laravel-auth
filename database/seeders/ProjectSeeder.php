<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 12; $i++) {
            $project = new Project();
            $project->title = $faker->realText(50);
            $project->slug = Str::slug($project->title, '-');
            $project->description = $faker->realText();
            $project->cover_image = 'placeholder/' . $faker->image('public/storage/placeholder', category: 'Posts', fullPath: false);
            $project->project_link = $faker->url();
            $project->online_link = $faker->url();
            $project->save();
        }
    }
}
