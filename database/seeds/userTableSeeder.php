<?php

use Illuminate\Database\Seeder;
use App\User;

class userTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=[
          [
            'name'      =>  'adam',
            'email'     =>  'adam@gmail.com',
            'password'  =>  '$2y$10$IAJumxZayHeXONhaE7PKceUwo0lv9biyblWEB9o3tMoCCwHRxVaBG'
          ],
          [
            'name'      =>  'John',
            'email'     =>  'John@organise.com',
            'password'  =>  '$2y$10$DUuRzRmcGA4PrdtcSyLgHekAXqD1QDvyaasNMh0Bw0bTvpi8aGsMi'
          ],
          [
            'name'      =>  'ram',
            'email'     =>  'ram@attendee.com',
            'password'  =>  '$2y$10$sryoosvE7a9WkJOs4zeMbO2k/DvFHei/BH8vNxEk42MQ.zXKc2IZS'
          ],
          [
            'name'      =>  'sunburn',
            'email'     =>  'sunburn@agency.com',
            'password'  =>  '$2y$10$opi318L6rn8nmdwx7xxdQOI.U3KwvI1tc0Omabj7BwmFC8YcGLqdS'
          ],
          [
            'name'      =>  'Modi',
            'email'     =>  'Modi@speaker.com',
            'password'  =>  '$2y$10$1dMbf91oKfsmuCRxY8eQKudMJYXc7YPKV7iJjBKbTs9kaKIm1Mgua'
          ],
          [
            'name'      =>  'show',
            'email'     =>  'show@exhibitor.com',
            'password'  =>  '$2y$10$WKKEFVKqkW7n7m4m/4nJ.ejphtzWjR20Ng9do12S2VUGbHxP9n9X.'
          ],
          [
            'name'      =>  'The Chancery Pavillion',
            'email'     =>  'chancery@venue.com',
            'password'  =>  '$2y$10$Ij6Xk/xbj/h2ZuHwONXIluT.3A5arFAIosgdWBVvUXOeOC.dDMZJu'
          ],
        ];
        foreach ($user as $key => $value) {
          User::create($value);
        }
    }
}
