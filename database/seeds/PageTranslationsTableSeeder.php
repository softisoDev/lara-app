<?php

use Illuminate\Database\Seeder;

class PageTranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('page_translations')->insert([
            'lang'    => 'en',
            'page_id' => 1,
            'title'   => 'Home',
            'slug'    => 'home',
            'body'    => '<p>Welcome</p>',
        ]);
    }
}
