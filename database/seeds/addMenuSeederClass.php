<?php

use Illuminate\Database\Seeder;

class addMenuSeederClass extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // List Menu
        $list_menu = array(
            array('parent_menu' => '3', 'menu_name' => 'Upload dan Set Target Agent', 'menu_icon' => 'feather icon-slack', 'menu_link' => 'utilities/uploads-and-targets', 'menu_child' => '0'), // Set target dan upload data consumer dan enterprise
            array('parent_menu' => '0', 'menu_name' => 'Dashboard', 'menu_icon' => 'fa fa-book', 'menu_link' => 'team-leader/dashboard', 'menu_child' => '0'), // dashboard dan tempat download report TL
            array('parent_menu' => '2', 'menu_name' => 'Consumer', 'menu_icon' => 'feather icon-slack', 'menu_link' => 'agent/workspace/consumer', 'menu_child' => '0'), // Workspace Agent COnsumer
            array('parent_menu' => '2', 'menu_name' => 'Enterprise', 'menu_icon' => 'feather icon-slack', 'menu_link' => 'agent/workspace/enterprise', 'menu_child' => '0'), // Workspace Agent Enterprise
        );
        DB::table('to_menu')->insert($list_menu);
    }
}
