<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertDefaultValueAdminMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::table('admin_menus')->insert(
            [
                [
                    'main_menu_id' => 0,
                    'name' => 'Dashboard',
                    'icon' => '',
                    'link' => 'dashboard',
                    'sort_id' => 1,
                    'show' => 'T',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'main_menu_id' => 0,
                    'name' => 'User',
                    'icon' => '',
                    'link' => 'user',
                    'sort_id' => 10,
                    'show' => 'T',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'main_menu_id' => 0,
                    'name' => 'Profile',
                    'icon' => '',
                    'link' => 'profile',
                    'sort_id' => 9,
                    'show' => 'T',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'main_menu_id' => 0,
                    'name' => 'Logout',
                    'icon' => '',
                    'link' => 'logout',
                    'sort_id' => '99.99',
                    'show' => 'T',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'main_menu_id' => 0,
                    'name' => 'Manage Menu',
                    'icon' => '',
                    'link' => 'ManageMenu',
                    'sort_id' => 1,
                    'show' => 'T',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'main_menu_id' => 0,
                    'name' => 'Install',
                    'icon' => '',
                    'link' => 'Install',
                    'sort_id' => 1,
                    'show' => 'T',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::table('admin_menus')->whereIn('link',['dashboard','user','profile','logout'])->delete();
    }
}
