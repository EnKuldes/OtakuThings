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
    		array('name' => 'RIFANTI OCTAVIANI ARIEF PUTRI', 'email' => '131760@nps.prod', 'perner' => '131760', 'posisi' => 'TEAM LEADER', 'user_level' => 2, 'username' => '131760'),
    		array('name' => 'LITA MARINA SOLIHA', 'email' => '131759@nps.prod', 'perner' => '131759', 'posisi' => 'QCO', 'user_level' => 3, 'username' => '131759'),
    		array('name' => 'FARHAN ALMAS HAFIZ MUZAKI', 'email' => '125828@nps.prod', 'perner' => '125828', 'posisi' => 'IT SUPPORT', 'user_level' => 4, 'username' => '125828'),
    		array('name' => 'DEWI YULIANI', 'email' => '131805@nps.prod', 'perner' => '131805', 'posisi' => 'AGENT', 'user_level' => 1, 'username' => '131805'),
    		array('name' => 'VICKY REYHAN ZAKARIA', 'email' => '131810@nps.prod', 'perner' => '131810', 'posisi' => 'AGENT', 'user_level' => 1, 'username' => '131810'),
    		array('name' => 'SRIYANI OKTAPIANI', 'email' => '131821@nps.prod', 'perner' => '131821', 'posisi' => 'AGENT', 'user_level' => 1, 'username' => '131821'),
    		array('name' => 'MEISYIELIN E. HEATUBUN', 'email' => '131803@nps.prod', 'perner' => '131803', 'posisi' => 'AGENT', 'user_level' => 1, 'username' => '131803'),
    		array('name' => 'AYU ARTISYAH', 'email' => '131806@nps.prod', 'perner' => '131806', 'posisi' => 'AGENT', 'user_level' => 1, 'username' => '131806'),
    		array('name' => 'DENIA YULIANI NURAMALINA', 'email' => '131798@nps.prod', 'perner' => '131798', 'posisi' => 'AGENT', 'user_level' => 1, 'username' => '131798'),
    		array('name' => 'VINA OCTAVIANI', 'email' => '131751@nps.prod', 'perner' => '131751', 'posisi' => 'AGENT', 'user_level' => 1, 'username' => '131751'),
    		array('name' => 'IRFANDHI YUNAIDI', 'email' => '131804@nps.prod', 'perner' => '131804', 'posisi' => 'AGENT', 'user_level' => 1, 'username' => '131804'),
    		array('name' => 'ASRI RAHMA PUTRI', 'email' => '131807@nps.prod', 'perner' => '131807', 'posisi' => 'AGENT', 'user_level' => 1, 'username' => '131807'),
    		array('name' => 'MUHAMMAD ADITYA RIDHO', 'email' => '152495@nps.prod', 'perner' => '152495', 'posisi' => 'AGENT', 'user_level' => 1, 'username' => '152495'),
    		array('name' => 'LISA DELLAYANI HAKIM', 'email' => '74256@nps.prod', 'perner' => '74256', 'posisi' => 'AGENT', 'user_level' => 1, 'username' => '74256'),
    	);
        DB::table('users')->insert($list_user);

        $list_user2 = array(
            array('name' => 'PRATIWI NINDYASARI', 'email' => '132260@nps.prod', 'perner' => '132260', 'posisi' => 'QCO', 'username' => '132260'),
            array('name' => 'KIKI AMALIA', 'email' => '108534@nps.prod', 'perner' => '108534', 'posisi' => 'DB MANAGEMENT', 'username' => '108534'),
            array('name' => 'ARVIEN  SHIDQI RABBANI', 'email' => '108544@nps.prod', 'perner' => '108544', 'posisi' => 'DATA ANALYST', 'username' => '108544'),
            array('name' => 'RUMAISHA', 'email' => '94168@nps.prod', 'perner' => '94168', 'posisi' => 'DATA ANALYST', 'username' => '94168'),
        );
        DB::table('users')->insert($list_user2);
    }
}
