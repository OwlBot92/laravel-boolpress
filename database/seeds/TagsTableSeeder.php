<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'Gluten Free',
            'Vegan',
            'Lactose Free',
            'Spicy'
        ];


        foreach ($tags as $tag) {
            $new_tag = new Tag();
            $new_tag->name = $tag;
            $new_tag->slug = Str::slug($new_tag->name, '-');
            $new_tag->save();
        }
    }
}
