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
        // $this->call(UserSeeder::class);
        $this->call(UserSeeder::class);

        // List Jenis Survey
        $jenis_survey = array(
            array('id' => '1', 'jenis_survey' => 'Consumer', 'deskripsi' => 'Consumer'),
            array('id' => '2', 'jenis_survey' => 'Enterprise', 'deskripsi' => 'Enterprise'),
        );
        DB::table('tr_jenis_survey')->insert($jenis_survey);

        // List Episode
        $list_episode = array(
            array('jenis_survey' => '1', 'num' => '1', 'nama_episode' => 'Explore', 'deskripsi_episode' => 'Explore'),
            array('jenis_survey' => '1', 'num' => '2', 'nama_episode' => 'Buy', 'deskripsi_episode' => 'Buy'),
            array('jenis_survey' => '1', 'num' => '3', 'nama_episode' => 'Activate', 'deskripsi_episode' => 'Activate'),
            array('jenis_survey' => '1', 'num' => '4', 'nama_episode' => 'Use IndiHome', 'deskripsi_episode' => 'Use IndiHome'),
            array('jenis_survey' => '1', 'num' => '5', 'nama_episode' => 'Use Internet', 'deskripsi_episode' => 'Use Internet'),
            array('jenis_survey' => '1', 'num' => '6', 'nama_episode' => 'Use UseeTV', 'deskripsi_episode' => 'Use UseeTV'),
            array('jenis_survey' => '1', 'num' => '7', 'nama_episode' => 'Use Telepon', 'deskripsi_episode' => 'Use Telepon'),
            array('jenis_survey' => '1', 'num' => '8', 'nama_episode' => 'Use Video OTT', 'deskripsi_episode' => 'Use Video OTT'),
            array('jenis_survey' => '1', 'num' => '9', 'nama_episode' => 'Pay', 'deskripsi_episode' => 'Pay'),
            array('jenis_survey' => '1', 'num' => '10', 'nama_episode' => 'Get Support', 'deskripsi_episode' => 'Get Support'),
            array('jenis_survey' => '1', 'num' => '11', 'nama_episode' => 'Terminate', 'deskripsi_episode' => 'Terminate'),
            array('jenis_survey' => '2', 'num' => '1', 'nama_episode' => 'Explore', 'deskripsi_episode' => 'Explore'),
            array('jenis_survey' => '2', 'num' => '2', 'nama_episode' => 'Buy', 'deskripsi_episode' => 'Buy'),
            array('jenis_survey' => '2', 'num' => '3', 'nama_episode' => 'Activate', 'deskripsi_episode' => 'Activate'),
            array('jenis_survey' => '2', 'num' => '4', 'nama_episode' => 'Use IndiHome', 'deskripsi_episode' => 'Use IndiHome'),
            array('jenis_survey' => '2', 'num' => '5', 'nama_episode' => 'Use Internet', 'deskripsi_episode' => 'Use Internet'),
            array('jenis_survey' => '2', 'num' => '6', 'nama_episode' => 'Use UseeTV', 'deskripsi_episode' => 'Use UseeTV'),
            array('jenis_survey' => '2', 'num' => '7', 'nama_episode' => 'Use Telepon', 'deskripsi_episode' => 'Use Telepon'),
            array('jenis_survey' => '2', 'num' => '8', 'nama_episode' => 'Use Video OTT', 'deskripsi_episode' => 'Use Video OTT'),
            array('jenis_survey' => '2', 'num' => '9', 'nama_episode' => 'Pay', 'deskripsi_episode' => 'Pay'),
            array('jenis_survey' => '2', 'num' => '10', 'nama_episode' => 'Get Support', 'deskripsi_episode' => 'Get Support'),
            array('jenis_survey' => '2', 'num' => '11', 'nama_episode' => 'Terminate', 'deskripsi_episode' => 'Terminate'),
        );
        DB::table('tr_episode_list')->insert($list_episode);

        // List Reason Episode
        $list_reason_episode = array(
            array('jenis_survey' => '1', 'num_episode' => '3', 'num' => '1', 'reason_category' => '0', 'reason_desc' => 'Teknisi tidak menjelaskan cara menggunakan produk', 'ket_episode' => 'Activate'),
            array('jenis_survey' => '1', 'num_episode' => '3', 'num' => '2', 'reason_category' => '0', 'reason_desc' => 'Waktu instalasi dilakukan tidak sesuai kesepakatan', 'ket_episode' => 'Activate'),
            array('jenis_survey' => '1', 'num_episode' => '3', 'num' => '3', 'reason_category' => '0', 'reason_desc' => 'Aktivasi menunggu lama', 'ket_episode' => 'Activate'),
            array('jenis_survey' => '1', 'num_episode' => '3', 'num' => '4', 'reason_category' => '0', 'reason_desc' => 'Instalasi tidak selesai pada kunjungan pertama', 'ket_episode' => 'Activate'),
            array('jenis_survey' => '1', 'num_episode' => '3', 'num' => '5', 'reason_category' => '0', 'reason_desc' => 'Instalasi tidak rapi', 'ket_episode' => 'Activate'),
            array('jenis_survey' => '1', 'num_episode' => '3', 'num' => '6', 'reason_category' => '0', 'reason_desc' => 'Teknisi tidak ramah dan rapi', 'ket_episode' => 'Activate'),
            array('jenis_survey' => '1', 'num_episode' => '3', 'num' => '7', 'reason_category' => '0', 'reason_desc' => 'Kualitas produk kurang baik', 'ket_episode' => 'Activate'),
            array('jenis_survey' => '1', 'num_episode' => '3', 'num' => '8', 'reason_category' => '0', 'reason_desc' => 'Lainnya service', 'ket_episode' => 'Activate'),
            array('jenis_survey' => '1', 'num_episode' => '3', 'num' => '1', 'reason_category' => '1', 'reason_desc' => 'Teknisi menjelaskan cara menggunakan produk', 'ket_episode' => 'Activate'),
            array('jenis_survey' => '1', 'num_episode' => '3', 'num' => '2', 'reason_category' => '1', 'reason_desc' => 'Waktu instalasi dilakukan sesuai kesepakatan', 'ket_episode' => 'Activate'),
            array('jenis_survey' => '1', 'num_episode' => '3', 'num' => '3', 'reason_category' => '1', 'reason_desc' => 'Aktivasi tidak menunggu lama', 'ket_episode' => 'Activate'),
            array('jenis_survey' => '1', 'num_episode' => '3', 'num' => '4', 'reason_category' => '1', 'reason_desc' => 'Instalasi selesai pada kunjungan pertama', 'ket_episode' => 'Activate'),
            array('jenis_survey' => '1', 'num_episode' => '3', 'num' => '5', 'reason_category' => '1', 'reason_desc' => 'Instalasi rapi', 'ket_episode' => 'Activate'),
            array('jenis_survey' => '1', 'num_episode' => '3', 'num' => '6', 'reason_category' => '1', 'reason_desc' => 'Teknisi ramah dan rapi', 'ket_episode' => 'Activate'),
            array('jenis_survey' => '1', 'num_episode' => '3', 'num' => '7', 'reason_category' => '1', 'reason_desc' => 'Kualitas produk sudah baik', 'ket_episode' => 'Activate'),
            array('jenis_survey' => '1', 'num_episode' => '3', 'num' => '8', 'reason_category' => '1', 'reason_desc' => 'Lainnya service', 'ket_episode' => 'Activate'),
            array('jenis_survey' => '1', 'num_episode' => '3', 'num' => '1', 'reason_category' => '2', 'reason_desc' => 'OOT', 'ket_episode' => 'Activate'),
            array('jenis_survey' => '1', 'num_episode' => '4', 'num' => '1', 'reason_category' => '0', 'reason_desc' => 'Layanan tidak berfungsi dengan normal', 'ket_episode' => 'Use IndiHome'),
            array('jenis_survey' => '1', 'num_episode' => '4', 'num' => '2', 'reason_category' => '0', 'reason_desc' => 'Sering terjadi gangguan', 'ket_episode' => 'Use IndiHome'),
            array('jenis_survey' => '1', 'num_episode' => '4', 'num' => '3', 'reason_category' => '0', 'reason_desc' => 'Tidak mendapatkan info terkait layanan dan promosi', 'ket_episode' => 'Use IndiHome'),
            array('jenis_survey' => '1', 'num_episode' => '4', 'num' => '4', 'reason_category' => '0', 'reason_desc' => 'Lainnya service', 'ket_episode' => 'Use IndiHome'),
            array('jenis_survey' => '1', 'num_episode' => '4', 'num' => '1', 'reason_category' => '1', 'reason_desc' => 'Layanan berfungsi dengan normal', 'ket_episode' => 'Use IndiHome'),
            array('jenis_survey' => '1', 'num_episode' => '4', 'num' => '2', 'reason_category' => '1', 'reason_desc' => 'Jarang terjadi gangguan', 'ket_episode' => 'Use IndiHome'),
            array('jenis_survey' => '1', 'num_episode' => '4', 'num' => '3', 'reason_category' => '1', 'reason_desc' => 'Mendapatkan info terkait layanan dan promosi', 'ket_episode' => 'Use IndiHome'),
            array('jenis_survey' => '1', 'num_episode' => '4', 'num' => '4', 'reason_category' => '1', 'reason_desc' => 'Lainnya service', 'ket_episode' => 'Use IndiHome'),
            array('jenis_survey' => '1', 'num_episode' => '4', 'num' => '1', 'reason_category' => '2', 'reason_desc' => 'OOT', 'ket_episode' => 'Use IndiHome'),
            array('jenis_survey' => '1', 'num_episode' => '5', 'num' => '1', 'reason_category' => '0', 'reason_desc' => 'Internet tidak stabil', 'ket_episode' => 'Use Internet'),
            array('jenis_survey' => '1', 'num_episode' => '5', 'num' => '2', 'reason_category' => '0', 'reason_desc' => 'Kecepatan tidak sesuai paket', 'ket_episode' => 'Use Internet'),
            array('jenis_survey' => '1', 'num_episode' => '5', 'num' => '3', 'reason_category' => '0', 'reason_desc' => 'Sering terjadi gangguan', 'ket_episode' => 'Use Internet'),
            array('jenis_survey' => '1', 'num_episode' => '5', 'num' => '4', 'reason_category' => '0', 'reason_desc' => 'Tidak mendapatkan info terkait layanan dan promosi', 'ket_episode' => 'Use Internet'),
            array('jenis_survey' => '1', 'num_episode' => '5', 'num' => '5', 'reason_category' => '0', 'reason_desc' => 'Lainnya service', 'ket_episode' => 'Use Internet'),
            array('jenis_survey' => '1', 'num_episode' => '5', 'num' => '1', 'reason_category' => '1', 'reason_desc' => 'Internet stabil', 'ket_episode' => 'Use Internet'),
            array('jenis_survey' => '1', 'num_episode' => '5', 'num' => '2', 'reason_category' => '1', 'reason_desc' => 'Kecepatan sesuai paket', 'ket_episode' => 'Use Internet'),
            array('jenis_survey' => '1', 'num_episode' => '5', 'num' => '3', 'reason_category' => '1', 'reason_desc' => 'Jarang terjadi gangguan', 'ket_episode' => 'Use Internet'),
            array('jenis_survey' => '1', 'num_episode' => '5', 'num' => '4', 'reason_category' => '1', 'reason_desc' => 'Mendapatkan info terkait layanan dan promosi', 'ket_episode' => 'Use Internet'),
            array('jenis_survey' => '1', 'num_episode' => '5', 'num' => '5', 'reason_category' => '1', 'reason_desc' => 'Lainnya service', 'ket_episode' => 'Use Internet'),
            array('jenis_survey' => '1', 'num_episode' => '5', 'num' => '1', 'reason_category' => '2', 'reason_desc' => 'OOT', 'ket_episode' => 'Use Internet'),
            array('jenis_survey' => '1', 'num_episode' => '6', 'num' => '1', 'reason_category' => '0', 'reason_desc' => 'Channel tidak lengkap tidak sesuai paket', 'ket_episode' => 'Use UseeTV'),
            array('jenis_survey' => '1', 'num_episode' => '6', 'num' => '2', 'reason_category' => '0', 'reason_desc' => 'Gambar putus-putus atau blank', 'ket_episode' => 'Use UseeTV'),
            array('jenis_survey' => '1', 'num_episode' => '6', 'num' => '3', 'reason_category' => '0', 'reason_desc' => 'Fitur tidak berfungsi normal', 'ket_episode' => 'Use UseeTV'),
            array('jenis_survey' => '1', 'num_episode' => '6', 'num' => '4', 'reason_category' => '0', 'reason_desc' => 'Sering terjadi gangguan', 'ket_episode' => 'Use UseeTV'),
            array('jenis_survey' => '1', 'num_episode' => '6', 'num' => '5', 'reason_category' => '0', 'reason_desc' => 'Tidak mendapatkan info terkait layanan dan promosi', 'ket_episode' => 'Use UseeTV'),
            array('jenis_survey' => '1', 'num_episode' => '6', 'num' => '6', 'reason_category' => '0', 'reason_desc' => 'Lainnya service', 'ket_episode' => 'Use UseeTV'),
            array('jenis_survey' => '1', 'num_episode' => '6', 'num' => '1', 'reason_category' => '1', 'reason_desc' => 'Channel lengkap sesuai paket', 'ket_episode' => 'Use UseeTV'),
            array('jenis_survey' => '1', 'num_episode' => '6', 'num' => '2', 'reason_category' => '1', 'reason_desc' => 'Gambar jernih', 'ket_episode' => 'Use UseeTV'),
            array('jenis_survey' => '1', 'num_episode' => '6', 'num' => '3', 'reason_category' => '1', 'reason_desc' => 'Fitur dapat berfungsi normal', 'ket_episode' => 'Use UseeTV'),
            array('jenis_survey' => '1', 'num_episode' => '6', 'num' => '4', 'reason_category' => '1', 'reason_desc' => 'Jarang terjadi gangguan', 'ket_episode' => 'Use UseeTV'),
            array('jenis_survey' => '1', 'num_episode' => '6', 'num' => '5', 'reason_category' => '1', 'reason_desc' => 'Mendapatkan info terkait layanan dan promosi', 'ket_episode' => 'Use UseeTV'),
            array('jenis_survey' => '1', 'num_episode' => '6', 'num' => '6', 'reason_category' => '1', 'reason_desc' => 'Lainnya service', 'ket_episode' => 'Use UseeTV'),
            array('jenis_survey' => '1', 'num_episode' => '6', 'num' => '1', 'reason_category' => '2', 'reason_desc' => 'OOT', 'ket_episode' => 'Use UseeTV'),
            array('jenis_survey' => '1', 'num_episode' => '7', 'num' => '1', 'reason_category' => '0', 'reason_desc' => 'Telepon tidak dapat digunakan dengan baik', 'ket_episode' => 'Use Telepon'),
            array('jenis_survey' => '1', 'num_episode' => '7', 'num' => '2', 'reason_category' => '0', 'reason_desc' => 'Kualitas suara buruk', 'ket_episode' => 'Use Telepon'),
            array('jenis_survey' => '1', 'num_episode' => '7', 'num' => '3', 'reason_category' => '0', 'reason_desc' => 'Telepon sudah jarang digunakan', 'ket_episode' => 'Use Telepon'),
            array('jenis_survey' => '1', 'num_episode' => '7', 'num' => '4', 'reason_category' => '0', 'reason_desc' => 'Layanan tidak memenuhi kebutuhan anda', 'ket_episode' => 'Use Telepon'),
            array('jenis_survey' => '1', 'num_episode' => '7', 'num' => '5', 'reason_category' => '0', 'reason_desc' => 'Lainnya service', 'ket_episode' => 'Use Telepon'),
            array('jenis_survey' => '1', 'num_episode' => '7', 'num' => '1', 'reason_category' => '1', 'reason_desc' => 'Telepon dapat digunakan dengan baik', 'ket_episode' => 'Use Telepon'),
            array('jenis_survey' => '1', 'num_episode' => '7', 'num' => '2', 'reason_category' => '1', 'reason_desc' => 'Kualitas suara baik', 'ket_episode' => 'Use Telepon'),
            array('jenis_survey' => '1', 'num_episode' => '7', 'num' => '3', 'reason_category' => '1', 'reason_desc' => 'Telepon masih sering digunakan', 'ket_episode' => 'Use Telepon'),
            array('jenis_survey' => '1', 'num_episode' => '7', 'num' => '4', 'reason_category' => '1', 'reason_desc' => 'Layanan memenuhi kebutuhan anda', 'ket_episode' => 'Use Telepon'),
            array('jenis_survey' => '1', 'num_episode' => '7', 'num' => '5', 'reason_category' => '1', 'reason_desc' => 'Lainnya service', 'ket_episode' => 'Use Telepon'),
            array('jenis_survey' => '1', 'num_episode' => '7', 'num' => '1', 'reason_category' => '2', 'reason_desc' => 'OOT', 'ket_episode' => 'Use Telepon'),
            array('jenis_survey' => '1', 'num_episode' => '10', 'num' => '1', 'reason_category' => '0', 'reason_desc' => 'Gangguan tidak terselesaikan pada laporan pertama', 'ket_episode' => 'Get Support'),
            array('jenis_survey' => '1', 'num_episode' => '10', 'num' => '2', 'reason_category' => '0', 'reason_desc' => 'Jadwal perbaikan tidak dilakukan sesuai dengan kesepakatan', 'ket_episode' => 'Get Support'),
            array('jenis_survey' => '1', 'num_episode' => '10', 'num' => '3', 'reason_category' => '0', 'reason_desc' => 'Kualitas pekerjaan teknisi kurang baik', 'ket_episode' => 'Get Support'),
            array('jenis_survey' => '1', 'num_episode' => '10', 'num' => '4', 'reason_category' => '0', 'reason_desc' => 'Teknisi tidak ramah dan tidak rapi', 'ket_episode' => 'Get Support'),
            array('jenis_survey' => '1', 'num_episode' => '10', 'num' => '5', 'reason_category' => '0', 'reason_desc' => 'Lainnya kualitas produk', 'ket_episode' => 'Get Support'),
            array('jenis_survey' => '1', 'num_episode' => '10', 'num' => '6', 'reason_category' => '0', 'reason_desc' => 'Lainnya service', 'ket_episode' => 'Get Support'),
            array('jenis_survey' => '1', 'num_episode' => '10', 'num' => '1', 'reason_category' => '1', 'reason_desc' => 'Gangguan terselesaikan pada laporan pertama', 'ket_episode' => 'Get Support'),
            array('jenis_survey' => '1', 'num_episode' => '10', 'num' => '2', 'reason_category' => '1', 'reason_desc' => 'Jadwal perbaikan dilakukan sesuai dengan kesepakatan', 'ket_episode' => 'Get Support'),
            array('jenis_survey' => '1', 'num_episode' => '10', 'num' => '3', 'reason_category' => '1', 'reason_desc' => 'Kualitas pekerjaan teknisi baik', 'ket_episode' => 'Get Support'),
            array('jenis_survey' => '1', 'num_episode' => '10', 'num' => '4', 'reason_category' => '1', 'reason_desc' => 'Teknisi ramah dan rapi', 'ket_episode' => 'Get Support'),
            array('jenis_survey' => '1', 'num_episode' => '10', 'num' => '5', 'reason_category' => '1', 'reason_desc' => 'Lainnya kualitas produk', 'ket_episode' => 'Get Support'),
            array('jenis_survey' => '1', 'num_episode' => '10', 'num' => '6', 'reason_category' => '1', 'reason_desc' => 'Lainnya service', 'ket_episode' => 'Get Support'),
            array('jenis_survey' => '1', 'num_episode' => '10', 'num' => '1', 'reason_category' => '2', 'reason_desc' => 'OOT', 'ket_episode' => 'Get Support'),
            array('jenis_survey' => '1', 'num_episode' => '11', 'num' => '1', 'reason_category' => '0', 'reason_desc' => 'Tertarik atau pindah layanan operator lain', 'ket_episode' => 'Terminate'),
            array('jenis_survey' => '1', 'num_episode' => '11', 'num' => '2', 'reason_category' => '0', 'reason_desc' => 'Proses berhenti berlangganan rumit', 'ket_episode' => 'Terminate'),
            array('jenis_survey' => '1', 'num_episode' => '11', 'num' => '3', 'reason_category' => '0', 'reason_desc' => 'Tagihan akhir bermasalah', 'ket_episode' => 'Terminate'),
            array('jenis_survey' => '1', 'num_episode' => '11', 'num' => '4', 'reason_category' => '0', 'reason_desc' => 'Tagihan berubah-ubah', 'ket_episode' => 'Terminate'),
            array('jenis_survey' => '1', 'num_episode' => '11', 'num' => '5', 'reason_category' => '0', 'reason_desc' => 'Tidak ada promo untuk pelanggan lama', 'ket_episode' => 'Terminate'),
            array('jenis_survey' => '1', 'num_episode' => '11', 'num' => '6', 'reason_category' => '0', 'reason_desc' => 'Lainnya kualitas produk', 'ket_episode' => 'Terminate'),
            array('jenis_survey' => '1', 'num_episode' => '11', 'num' => '7', 'reason_category' => '0', 'reason_desc' => 'Lainnya service', 'ket_episode' => 'Terminate'),
            array('jenis_survey' => '1', 'num_episode' => '11', 'num' => '1', 'reason_category' => '1', 'reason_desc' => 'Memutus layanan pada laporan pertama', 'ket_episode' => 'Terminate'),
            array('jenis_survey' => '1', 'num_episode' => '11', 'num' => '2', 'reason_category' => '1', 'reason_desc' => 'Proses memutus layanan cepat', 'ket_episode' => 'Terminate'),
            array('jenis_survey' => '1', 'num_episode' => '11', 'num' => '3', 'reason_category' => '1', 'reason_desc' => 'Tagihan akhir jelas', 'ket_episode' => 'Terminate'),
            array('jenis_survey' => '1', 'num_episode' => '11', 'num' => '4', 'reason_category' => '1', 'reason_desc' => 'Lainnya kualitas produk', 'ket_episode' => 'Terminate'),
            array('jenis_survey' => '1', 'num_episode' => '11', 'num' => '5', 'reason_category' => '1', 'reason_desc' => 'Lainnya service', 'ket_episode' => 'Terminate'),
            array('jenis_survey' => '1', 'num_episode' => '11', 'num' => '1', 'reason_category' => '2', 'reason_desc' => 'OOT', 'ket_episode' => 'Terminate'),
            array('jenis_survey' => '2', 'num_episode' => '3', 'num' => '1', 'reason_category' => '0', 'reason_desc' => 'Kualitas layanan', 'ket_episode' => 'Activate'),
            array('jenis_survey' => '2', 'num_episode' => '3', 'num' => '2', 'reason_category' => '0', 'reason_desc' => 'Waktu penyelesaian', 'ket_episode' => 'Activate'),
            array('jenis_survey' => '2', 'num_episode' => '3', 'num' => '3', 'reason_category' => '0', 'reason_desc' => 'Pengaturan jadwal dengan teknisi', 'ket_episode' => 'Activate'),
            array('jenis_survey' => '2', 'num_episode' => '3', 'num' => '4', 'reason_category' => '0', 'reason_desc' => 'Kemudahan koordinasi dengan teknisi', 'ket_episode' => 'Activate'),
            array('jenis_survey' => '2', 'num_episode' => '3', 'num' => '5', 'reason_category' => '0', 'reason_desc' => 'Kecakapan petugas Telkom', 'ket_episode' => 'Activate'),
            array('jenis_survey' => '2', 'num_episode' => '3', 'num' => '6', 'reason_category' => '0', 'reason_desc' => 'Informasi progress pemasangan layanan', 'ket_episode' => 'Activate'),
            array('jenis_survey' => '2', 'num_episode' => '3', 'num' => '7', 'reason_category' => '0', 'reason_desc' => 'Kerapihan instalasi', 'ket_episode' => 'Activate'),
            array('jenis_survey' => '2', 'num_episode' => '3', 'num' => '8', 'reason_category' => '0', 'reason_desc' => 'Lainnya', 'ket_episode' => 'Activate'),
            array('jenis_survey' => '2', 'num_episode' => '3', 'num' => '1', 'reason_category' => '1', 'reason_desc' => 'Kualitas layanan', 'ket_episode' => 'Activate'),
            array('jenis_survey' => '2', 'num_episode' => '3', 'num' => '2', 'reason_category' => '1', 'reason_desc' => 'Waktu penyelesaian', 'ket_episode' => 'Activate'),
            array('jenis_survey' => '2', 'num_episode' => '3', 'num' => '3', 'reason_category' => '1', 'reason_desc' => 'Pengaturan jadwal dengan teknisi', 'ket_episode' => 'Activate'),
            array('jenis_survey' => '2', 'num_episode' => '3', 'num' => '4', 'reason_category' => '1', 'reason_desc' => 'Kemudahan koordinasi dengan teknisi', 'ket_episode' => 'Activate'),
            array('jenis_survey' => '2', 'num_episode' => '3', 'num' => '5', 'reason_category' => '1', 'reason_desc' => 'Kecakapan petugas Telkom', 'ket_episode' => 'Activate'),
            array('jenis_survey' => '2', 'num_episode' => '3', 'num' => '6', 'reason_category' => '1', 'reason_desc' => 'Informasi progress pemasangan layanan', 'ket_episode' => 'Activate'),
            array('jenis_survey' => '2', 'num_episode' => '3', 'num' => '7', 'reason_category' => '1', 'reason_desc' => 'Kerapihan instalasi', 'ket_episode' => 'Activate'),
            array('jenis_survey' => '2', 'num_episode' => '3', 'num' => '8', 'reason_category' => '1', 'reason_desc' => 'Lainnya', 'ket_episode' => 'Activate'),
            array('jenis_survey' => '2', 'num_episode' => '4', 'num' => '1', 'reason_category' => '0', 'reason_desc' => 'Kehandalan layanan', 'ket_episode' => 'Use IndiHome'),
            array('jenis_survey' => '2', 'num_episode' => '4', 'num' => '2', 'reason_category' => '0', 'reason_desc' => 'Kesesuaian kualitas dengan spesifikasi dengan kontrak', 'ket_episode' => 'Use IndiHome'),
            array('jenis_survey' => '2', 'num_episode' => '4', 'num' => '3', 'reason_category' => '0', 'reason_desc' => 'Ketersediaan informasi jaringan atau penggunaan layanan', 'ket_episode' => 'Use IndiHome'),
            array('jenis_survey' => '2', 'num_episode' => '4', 'num' => '4', 'reason_category' => '0', 'reason_desc' => 'Kemudahan penggunaan layanan', 'ket_episode' => 'Use IndiHome'),
            array('jenis_survey' => '2', 'num_episode' => '4', 'num' => '5', 'reason_category' => '0', 'reason_desc' => 'Kemudahan perubahan atau upgrade layanan', 'ket_episode' => 'Use IndiHome'),
            array('jenis_survey' => '2', 'num_episode' => '4', 'num' => '6', 'reason_category' => '0', 'reason_desc' => 'Lainnya', 'ket_episode' => 'Use IndiHome'),
            array('jenis_survey' => '2', 'num_episode' => '4', 'num' => '1', 'reason_category' => '1', 'reason_desc' => 'Kehandalan layanan', 'ket_episode' => 'Use IndiHome'),
            array('jenis_survey' => '2', 'num_episode' => '4', 'num' => '2', 'reason_category' => '1', 'reason_desc' => 'Kesesuaian kualitas dengan spesifikasi dengan kontrak', 'ket_episode' => 'Use IndiHome'),
            array('jenis_survey' => '2', 'num_episode' => '4', 'num' => '3', 'reason_category' => '1', 'reason_desc' => 'Ketersediaan informasi jaringan atau penggunaan layanan', 'ket_episode' => 'Use IndiHome'),
            array('jenis_survey' => '2', 'num_episode' => '4', 'num' => '4', 'reason_category' => '1', 'reason_desc' => 'Kemudahan penggunaan layanan', 'ket_episode' => 'Use IndiHome'),
            array('jenis_survey' => '2', 'num_episode' => '4', 'num' => '5', 'reason_category' => '1', 'reason_desc' => 'Kemudahan perubahan atau upgrade layanan', 'ket_episode' => 'Use IndiHome'),
            array('jenis_survey' => '2', 'num_episode' => '4', 'num' => '6', 'reason_category' => '1', 'reason_desc' => 'Lainnya', 'ket_episode' => 'Use IndiHome'),
            array('jenis_survey' => '2', 'num_episode' => '10', 'num' => '1', 'reason_category' => '0', 'reason_desc' => 'Informasi progress penanganan gangguan', 'ket_episode' => 'Get Support'),
            array('jenis_survey' => '2', 'num_episode' => '10', 'num' => '2', 'reason_category' => '0', 'reason_desc' => 'Waktu penyelesaian', 'ket_episode' => 'Get Support'),
            array('jenis_survey' => '2', 'num_episode' => '10', 'num' => '3', 'reason_category' => '0', 'reason_desc' => 'Pengaturan jadwal dengan teknisi', 'ket_episode' => 'Get Support'),
            array('jenis_survey' => '2', 'num_episode' => '10', 'num' => '4', 'reason_category' => '0', 'reason_desc' => 'Kemudahan koordinasi dengan teknisi', 'ket_episode' => 'Get Support'),
            array('jenis_survey' => '2', 'num_episode' => '10', 'num' => '5', 'reason_category' => '0', 'reason_desc' => 'Kecakapan petugas Telkom', 'ket_episode' => 'Get Support'),
            array('jenis_survey' => '2', 'num_episode' => '10', 'num' => '6', 'reason_category' => '0', 'reason_desc' => 'Kerapihan instalasi', 'ket_episode' => 'Get Support'),
            array('jenis_survey' => '2', 'num_episode' => '10', 'num' => '7', 'reason_category' => '0', 'reason_desc' => 'Lainnya', 'ket_episode' => 'Get Support'),
            array('jenis_survey' => '2', 'num_episode' => '10', 'num' => '1', 'reason_category' => '1', 'reason_desc' => 'Informasi progress penanganan gangguan', 'ket_episode' => 'Get Support'),
            array('jenis_survey' => '2', 'num_episode' => '10', 'num' => '2', 'reason_category' => '1', 'reason_desc' => 'Waktu penyelesaian', 'ket_episode' => 'Get Support'),
            array('jenis_survey' => '2', 'num_episode' => '10', 'num' => '3', 'reason_category' => '1', 'reason_desc' => 'Pengaturan jadwal dengan teknisi', 'ket_episode' => 'Get Support'),
            array('jenis_survey' => '2', 'num_episode' => '10', 'num' => '4', 'reason_category' => '1', 'reason_desc' => 'Kemudahan koordinasi dengan teknisi', 'ket_episode' => 'Get Support'),
            array('jenis_survey' => '2', 'num_episode' => '10', 'num' => '5', 'reason_category' => '1', 'reason_desc' => 'Kecakapan petugas Telkom', 'ket_episode' => 'Get Support'),
            array('jenis_survey' => '2', 'num_episode' => '10', 'num' => '6', 'reason_category' => '1', 'reason_desc' => 'Kerapihan instalasi', 'ket_episode' => 'Get Support'),
            array('jenis_survey' => '2', 'num_episode' => '10', 'num' => '7', 'reason_category' => '1', 'reason_desc' => 'Lainnya', 'ket_episode' => 'Get Support'),
            array('jenis_survey' => '2', 'num_episode' => '9', 'num' => '1', 'reason_category' => '0', 'reason_desc' => 'Akurasi invoice', 'ket_episode' => 'Pay'),
            array('jenis_survey' => '2', 'num_episode' => '9', 'num' => '2', 'reason_category' => '0', 'reason_desc' => 'Waktu penyampaian invoice', 'ket_episode' => 'Pay'),
            array('jenis_survey' => '2', 'num_episode' => '9', 'num' => '3', 'reason_category' => '0', 'reason_desc' => 'Kemudahan koordinasi dengan petugas pembayaran', 'ket_episode' => 'Pay'),
            array('jenis_survey' => '2', 'num_episode' => '9', 'num' => '4', 'reason_category' => '0', 'reason_desc' => 'Kecakapan Petugas Telkom', 'ket_episode' => 'Pay'),
            array('jenis_survey' => '2', 'num_episode' => '9', 'num' => '5', 'reason_category' => '0', 'reason_desc' => 'Kemudahan proses pembayaran', 'ket_episode' => 'Pay'),
            array('jenis_survey' => '2', 'num_episode' => '9', 'num' => '6', 'reason_category' => '0', 'reason_desc' => 'Lainnya', 'ket_episode' => 'Pay'),
            array('jenis_survey' => '2', 'num_episode' => '9', 'num' => '1', 'reason_category' => '1', 'reason_desc' => 'Akurasi invoice', 'ket_episode' => 'Pay'),
            array('jenis_survey' => '2', 'num_episode' => '9', 'num' => '2', 'reason_category' => '1', 'reason_desc' => 'Waktu penyampaian invoice', 'ket_episode' => 'Pay'),
            array('jenis_survey' => '2', 'num_episode' => '9', 'num' => '3', 'reason_category' => '1', 'reason_desc' => 'Kemudahan koordinasi dengan petugas pembayaran', 'ket_episode' => 'Pay'),
            array('jenis_survey' => '2', 'num_episode' => '9', 'num' => '4', 'reason_category' => '1', 'reason_desc' => 'Kecakapan Petugas Telkom', 'ket_episode' => 'Pay'),
            array('jenis_survey' => '2', 'num_episode' => '9', 'num' => '5', 'reason_category' => '1', 'reason_desc' => 'Kemudahan proses pembayaran', 'ket_episode' => 'Pay'),
            array('jenis_survey' => '2', 'num_episode' => '9', 'num' => '6', 'reason_category' => '1', 'reason_desc' => 'Lainnya', 'ket_episode' => 'Pay'),
        );
        DB::table('tr_reason_episode')->insert($list_reason_episode);

        // List Status Call
        $list_status_call = array(
            array('status_call' => 'Answered'),
            array('status_call' => 'Mailbox'),
            array('status_call' => 'No Answer'),
        );
        DB::table('tr_status_call')->insert($list_status_call);

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
    }
}
