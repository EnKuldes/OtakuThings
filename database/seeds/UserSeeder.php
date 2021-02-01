<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$list_user = array(
    		array('name' => 'Team Leader', 'email' => '131760@nps.prod', 'perner' => '131760', 'posisi' => 'TEAM LEADER', 'user_level' => 2, 'username' => '131760'),
    		array('name' => 'QCO', 'email' => '131759@nps.prod', 'perner' => '131759', 'posisi' => 'QCO', 'user_level' => 3, 'username' => '131759'),
    		array('name' => 'Super User', 'email' => '125828@nps.prod', 'perner' => '125828', 'posisi' => 'IT SUPPORT', 'user_level' => 4, 'username' => '125828'),
    		array('name' => 'Agent', 'email' => '131805@nps.prod', 'perner' => '131805', 'posisi' => 'AGENT', 'user_level' => 1, 'username' => '131805'),
    	);
        DB::table('users')->insert($list_user);

        $list_user2 = array(
            array('name' => 'Position without User Level', 'email' => '132260@nps.prod', 'perner' => '132260', 'posisi' => 'QCO', 'username' => '132260'),
        );
        DB::table('users')->insert($list_user2);
    }
}
