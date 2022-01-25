<?php

use Illuminate\Database\Seeder;

class DancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bodyPartsMovements = [
            'body' => ['вперед-назад', 'влево-вправо', 'круговые движения'],
            'head' => ['вперед-назад', 'влево-вправо', 'вверх-вниз', ''],
            'arms' => ['круговые движения', 'согнуты в локтях', 'вперед-назад', 'влево-вправо'],
            'legs' => ['вперед-назад', 'влево-вправо', 'полуприсяд']
        ];
        $dances['hiphop'] = [
            'body' => [$bodyPartsMovements['body'][0]],
            'legs' => [ $bodyPartsMovements['legs'][2]],
            'arms' => [ $bodyPartsMovements['arms'][1]],
            'head' => [ $bodyPartsMovements['head'][0]]
        ];
        $dances['rnb'] =  [
            'body' => [ $bodyPartsMovements['body'][0]],
            'head' => [ $bodyPartsMovements['head'][2],
                $bodyPartsMovements['head'][1]],
            'arms' => [
                $bodyPartsMovements['arms'][2],
                $bodyPartsMovements['arms'][3]
            ],
            'legs' => [
                $bodyPartsMovements['legs'][0],
                $bodyPartsMovements['legs'][1]]
        ];
        $dances['electrodance'] =  [
            'body' => [
                $bodyPartsMovements['body'][2]],
            'legs' => [
                $bodyPartsMovements['legs'][0],
                $bodyPartsMovements['legs'][1]],
            'arms' => [
                $bodyPartsMovements['arms'][2],
                $bodyPartsMovements['arms'][3]
            ],
            'head' => [
                $bodyPartsMovements['head'][3]]
        ];
        $dances['pop'] =  [
            'body' => [
                $bodyPartsMovements['body'][0],
                $bodyPartsMovements['body'][1]
            ],
            'legs' =>
                [
                    $bodyPartsMovements['legs'][0],
                    $bodyPartsMovements['legs'][1]
                ],
            'arms' =>
                [
                    $bodyPartsMovements['arms'][2],
                    $bodyPartsMovements['arms'][3]
                ],
            'head' => [
                $bodyPartsMovements['head'][1],
                $bodyPartsMovements['head'][2]
            ]
        ];
        foreach ($dances as $key => $danceData) {
            DB::table('dances')->insert([
                'name' => $key,
                'movements' => json_encode($danceData)
            ]);
        }
    }
}
