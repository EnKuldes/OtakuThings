<?php

use Illuminate\Database\Seeder;

class QuestionnaireGreetingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // List 
        $list = array(
        	array('jenis_survey' => '1', 'jenis_salam' => '1', 'ucapan_salam' => '<p>Selamat <span id=\'wkt\'><span>.<br> Apakah betul saat ini saya tersambung dgn bpk / ibu <span id=\'nm_plgn\'>...<span> ?<br> Perkenalkan saya <span id=\'nm_user\'>...<span> dari PT Telkom Indonesia Tbk.<br> Saat ini kami sedang melaksanakan survei untuk mengetahui tingkat kepuasan bapak/ibu terhadap layanan Indihome.<br> Boleh minta waktu sekitar 2 menit?</p>'),
        	array('jenis_survey' => '1', 'jenis_salam' => '0', 'ucapan_salam' => '<p>Terima kasih atas partisipasi Bapak/Ibu. Hasil survei ini akan kami gunakan untuk terus memperbaiki layanan Indihome</p>'),
        	array('jenis_survey' => '2', 'jenis_salam' => '1', 'ucapan_salam' => '<p>Selamat <span id=\'wkt\'><span>, perkenalkan saya <span id=\'nm_user\'>...<span> adalah interviewer dari INFOMEDIA yang bekerja sama dengan Telkom untuk pelaksanaan survey pelanggan.<br> Survei ini bertujuan untuk mendapatkan informasi Bpk/ Ibu mewakili perusahaan tentang kualitas pelayanan dari PT.Telkom Indonesia . Mohon kesediaan waktunya sejenak untuk berkenan memberikan informasi, berkenan bpk/bu?</p>'),
        	array('jenis_survey' => '2', 'jenis_salam' => '0', 'ucapan_salam' => '<p>Terimakasih atas partisipasi bpk/ibu.<br> Hasil survey yang telah disampaikan akan kami gunakan untuk terus memperbaiki layanan Pt.Telkom Indonesia . Selamat pagi/siang/sore dan selamat beraktivitas kembali</p>'),
        );
        DB::table('tr_questionnaire_greeting')->insert($list);
    }
}
