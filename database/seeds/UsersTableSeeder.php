<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // 生成数据集合
        $users = factory(User::class)->times(10)->create();

        // 单独处理第一个用户的数据
        $user = User::find(1);
        $user->name = 'CalDey';
        $user->email = 'caldey@123456.com';
        $user->avatar = 'http://laraweb.test/uploads/images/avatars/202011/05/1_1604566780_uxdORCLWql.jpg';
        $user->save();
    }
}
