<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $role = [
        	[
        		'name'          => 'admin',
        		'display_name'  => 'can do all crud',
        		'description'   => 'admin have all permissions'
        	],
        	[
        		'name'          => 'organiser',
        		'display_name'  => 'crud',
        		'description'   => 'can perform crud on attendee,partners,speaker,exhibitor'
        	],
          [
        		'name'          => 'attendee',
        		'display_name'  => 'crud',
        		'description'   => 'can perform crud on his notes and activities'
        	],
          [
        		'name'          => 'agency',
        		'display_name'  => 'crud on organiser',
        		'description'   => 'can do crud on organiser and events'
        	],
          [
        		'name'          => 'speaker',
        		'display_name'  => 'event speaker',
        		'description'   => 'crud on notes and his events'
        	],
          [
        		'name'          => 'exhibitor',
        		'display_name'  => 'event exhibitor',
        		'description'   => 'exhibits products in an event'
        	],
          [
        		'name'          => 'venue',
        		'display_name'  => 'venue for events',
        		'description'   => 'can perform crud only on venue'
        	],
        ];
        foreach ($role as $one => $value) {
        	Role::create($value);
        }
    }
}
