<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Subreddit;
use App\Models\User;
use App\Models\Role;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Example user',
            'password' => Hash::make('example123'),
            'email' => 'example@gmail.com',
            'image' => 'default.jpg'
        ]);
        $user->ntsetting()->create([
            'frnt' => true,
            'modnt' => true,
            'postnt' => true,
            'allnt' => false,
        ]);
        $image = Image::make(public_path('storage/' . 'default.jpg'));
        $square = $image->fit(300, 300);
        $file = uniqid() .'.jpg';
        $square->save(public_path('storage/' .$file));
        $baner = $image->fit(1000,100);
        $banner = uniqid() .'.jpg';
        $baner->save(public_path('storage/'.$banner));
        $subreddit = Subreddit::create([
            'creator_id' => $user->id,
            'name' => "Example Subreddit",
            'image' => $file.'/'.$banner
        ]);
        Role::create([
            'name' => 'admin'
        ]);
        Role::create([
            'name' => 'moderator'
        ]);
        Role::create([
            'name' => 'banned'
        ]);
        $role = Role::where('name', 'moderator')->first();
        $user->subredditss()->attach($subreddit->id, ['role_id' => $role->id]);
        $images = [
            'imaga1.jfif',
            'imaga2.jfif',
            'imaga3.jfif',
            'imaga4.jfif',
            'imaga5.jfif',
            'imaga6.jfif',
            'imaga7.jfif',
            'imaga8.jfif',
        ];
        for($i = 1;$i <= 30; $i++){
            $key = array_rand($images);
            $image = $images[$key];
            $user->posts()->create([
                'subreddit_id' => $subreddit->id,
                'title' => "Example title ".$i,
                'image' => $image
            ]);
        }
    }
}
