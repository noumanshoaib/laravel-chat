<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\friend;
class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::FirstOrNew([
            'email' => 'admin@gmail.com',
        ]);
        $admin->name = 'Admin Hoxton Capital';
        $admin->email = 'admin@gmail.com';
        $admin->password = bcrypt('12345678');
        $admin->is_admin=  1;
        $admin->save();

        $admin_2 = User::FirstOrNew([
            'email' => 'admin2@gmail.com',
        ]);
        $admin_2->name = 'Admin Hoxton Capital 2';
        $admin_2->email = 'admin2@gmail.com';
        $admin_2->password = bcrypt('12345678');
        $admin_2->is_admin=  1;
        $admin_2->save();
        
        $user_1 = User::FirstOrNew([
            'email' => 'nouman@gmail.com',
        ]);
        $user_1->name = 'Nouman Shoaib';
        $user_1->email = 'nouman@gmail.com';
        $user_1->password = bcrypt('12345678');
        $user_1->save();

        $user_2 = User::FirstOrNew([
            'email' => 'test_user@gmail.com',
        ]);
        $user_2->name = 'Test User';
        $user_2->email = 'test_user@gmail.com';
        $user_2->password = bcrypt('12345678');
        $user_2->save();

        $admin_friend_1 = friend::FirstOrNew([
            'user_id' => $admin->id,
            'friend_id' => $user_1->id,
        ]);
        $admin_friend_1->user_id = $admin->id;
        $admin_friend_1->friend_id = $user_1->id;
        $admin_friend_1->save();

        $admin_friend_2 = friend::FirstOrNew([
            'user_id' => $admin->id,
            'friend_id' => $user_2->id,
        ]);
        $admin_friend_2->user_id = $admin->id;
        $admin_friend_2->friend_id = $user_2->id;
        $admin_friend_2->save();

            //second admin friends

        $admin_2_friend_1 = friend::FirstOrNew([
            'user_id' => $admin_2->id,
            'friend_id' => $user_1->id,
        ]);
        $admin_2_friend_1->user_id = $admin_2->id;
        $admin_2_friend_1->friend_id = $user_1->id;
        $admin_2_friend_1->save();

        $admin_2_friend_2 = friend::FirstOrNew([
            'user_id' => $admin_2->id,
            'friend_id' => $user_2->id,
        ]);
        $admin_2_friend_2->user_id = $admin_2->id;
        $admin_2_friend_2->friend_id = $user_2->id;
        $admin_2_friend_2->save();


        //user friends
        $user_1_friend = friend::FirstOrNew([
            'user_id' => $user_1->id,
            'friend_id' => $admin->id,
        ]);
        $user_1_friend->user_id = $user_1->id;
        $user_1_friend->friend_id = $admin->id;
        $user_1_friend->save();

        $user_2_friend = friend::FirstOrNew([
            'user_id' => $user_2->id,
            'friend_id' => $admin->id,
        ]);
        $user_2_friend->user_id = $user_2->id;
        $user_2_friend->friend_id = $admin->id;
        $user_2_friend->save();



        $user_1_friend = friend::FirstOrNew([
            'user_id' => $user_1->id,
            'friend_id' => $admin_2->id,
        ]);
        $user_1_friend->user_id = $user_1->id;
        $user_1_friend->friend_id = $admin_2->id;
        $user_1_friend->save();

        $user_2_friend = friend::FirstOrNew([
            'user_id' => $user_2->id,
            'friend_id' => $admin_2->id,
        ]);
        $user_2_friend->user_id = $user_2->id;
        $user_2_friend->friend_id = $admin_2->id;
        $user_2_friend->save();

    }
}
