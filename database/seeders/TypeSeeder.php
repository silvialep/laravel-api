<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $types = ['Back End', 'Front End', 'Full Stack', 'UX', 'UI'];

        foreach ($types as $type) {

            $newType = new Type();

            $newType->type_name = $type;
            $newType->slug = Str::slug($newType->type_name, '-');
            $newType->description = $faker->text(100);

            $newType->save();
        }
    }
}
