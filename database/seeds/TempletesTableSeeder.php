<?php

use Illuminate\Database\Seeder;

class TempletesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('templetes')->truncate();
        
        DB::table('templetes')->insert([
            [
                'rarity_name' => 'はずれ',
                'prize_name' => 'ポケットティッシュ',
            ],
            [
                'rarity_name' => 'はずれ',
                'prize_name' => 'たわし',
            ],
            [
                'rarity_name' => 'はずれ',
                'prize_name' => 'えんぴつ',
            ],
            [
                'rarity_name' => '当たり',
                'prize_name' => 'コーヒーセット',
            ],
            [
                'rarity_name' => '当たり',
                'prize_name' => '入浴剤',
            ],
            [
                'rarity_name' => '大当たり',
                'prize_name' => '旅行券',
            ],
            ]);
    }
}
