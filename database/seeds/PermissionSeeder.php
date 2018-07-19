<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $permission =[
          [
        		'name' => 'create',
        		'display_name' => 'create events',
        		'description' => 'can create new event exhibition'
        	],
        	[
        		'name' => 'read',
        		'display_name' => 'view',
        		'description' => 'can only view'
        	],
        	[
        		'name' => 'update',
        		'display_name' => 'edit',
        		'description' => 'can only edit'
        	],
        	[
        		'name' => 'delete',
        		'display_name' => 'delete',
        		'description' => 'can delete'
        	]
      ];
      foreach ($permission as $key => $value) {
        Permission::create($value);
      }
    }
}
