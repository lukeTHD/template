<?php

use Illuminate\Database\Seeder;

class MetaBoxTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        \App\MetaBox::create([
            'meta_key' => 'home_text',
            'meta_value' => 'PLAY BLOCKCHAIN LOTTERY'
        ]);

        \App\MetaBox::create([
            'meta_key' => 'home_description',
            'meta_value' => 'Play Lottery by using your LOTTO GO tokens.
Try your luck today, knowing what will be your lucky day!'
        ]);

        \App\MetaBox::create([
            'meta_key' => 'profit',
            'meta_value' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.'
        ]);

        \App\MetaBox::create([
            'meta_key' => 'affiliate',
            'meta_value' => 'If you have a website and you’d like to help promote Lotto Go, contact us to become an affiliate. As a Lotto Go partner, you\'ll be entitled to the following benefits:'
        ]);

        \App\MetaBox::create([
            'meta_key' => 'how_to_play',
            'meta_value' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy wtext ever since the 1500s, when an unknown printer took a galley of type and scrambled.'
        ]);

        \App\MetaBox::create([
            'meta_key' => 'top_winners',
            'meta_value' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.'
        ]);
    }
}
