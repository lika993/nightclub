<?php

use App\Dance;
use Illuminate\Database\Seeder;

class GuestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $limit = env('GUEST_LIMIT', 15);
        $names = json_decode(file_get_contents(__DIR__ . '/names.json'), true);

        $danceNames = Dance::pluck('name')->all();
        shuffle($danceNames);
        $rand_keys = array_rand($names, $limit);
        foreach ($rand_keys as $key) {
            $skills = [];
            $skillsCount = rand(0, count($danceNames) - 1);
            for ($i = 0; $i <= $skillsCount; $i ++) {
                $skills[] = $danceNames[$i];

            }
            DB::table('guests')->insert([
                'name' => $names[$key]['name'],
                'gender' => $names[$key]['gender'],
                'skills' => json_encode($skills),
            ]);
        }
    }
}
