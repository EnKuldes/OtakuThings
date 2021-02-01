<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User Level
        $user_level = array(
            array('id' => '1', 'user_level' => 'Agent', 'user_level_desc' => 'Agent NPS'),
            array('id' => '2', 'user_level' => 'TL', 'user_level_desc' => 'Team Leader NPS'),
            array('id' => '3', 'user_level' => 'Support', 'user_level_desc' => 'Support NPS'),
            array('id' => '4', 'user_level' => 'SU', 'user_level_desc' => 'Admin NPC'),
            array('id' => '5', 'user_level' => 'User', 'user_level_desc' => 'User NPC'),
        );
        DB::table('to_user_level')->insert($user_level);

        // List Menu
        $list_menu = array(
            array('parent_menu' => '0', 'menu_name' => 'Dashboard', 'menu_icon' => 'feather icon-home', 'menu_link' => '', 'menu_child' => '0'),
            array('parent_menu' => '0', 'menu_name' => 'Workspace', 'menu_icon' => 'feather icon-edit', 'menu_link' => 'workspace', 'menu_child' => '0'),
            array('parent_menu' => '0', 'menu_name' => 'Utilities', 'menu_icon' => 'feather icon-slack', 'menu_link' => '#', 'menu_child' => '1'),
            array('parent_menu' => '3', 'menu_name' => 'User Managements', 'menu_icon' => 'feather icon-slack', 'menu_link' => 'utilities/user-managements', 'menu_child' => '0'),
            array('parent_menu' => '3', 'menu_name' => 'Menu Managements', 'menu_icon' => 'feather icon-slack', 'menu_link' => 'utilities/menu-managements', 'menu_child' => '0'),
        );
        DB::table('to_menu')->insert($list_menu);

        // List Access
        $list_menu = array(
            array('user_level' => '4', 'menu_id' => '1'),
            array('user_level' => '4', 'menu_id' => '2'),
            array('user_level' => '4', 'menu_id' => '3'),
            array('user_level' => '4', 'menu_id' => '4'),
            array('user_level' => '4', 'menu_id' => '5'),
        );
        DB::table('to_user_access')->insert($list_menu);

        // $this->call(UserSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(addMenuSeederClass::class);
        
    }
}
