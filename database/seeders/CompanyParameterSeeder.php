<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('compro_parameter')->insert([
            [
                'email' => 'info@simplay.co.id',
                'no_telepon' => '(021) 22097542',
                'no_wa' => '+62 821-69998-0001',
                'website' => 'www.simplay.co.id',
                'alamat' => 'Rajawali Selatan Raya Blok A No.33 Gunung Sahari Utara Sawah Besar Kota Adm. Jakarta Pusat DKI Jakarta 10720',
                'maps' => 'https://maps.app.goo.gl/qyNy2Y54hEn3nWvq7',
                'visi' => 'Perusahaan rintisan teknologi yang menyediakan solusi inovatif untuk tumbuh dan memberikan nilai tambah bagi industri Anda.',
                'misi' => 'Dengan memberikan pelayanan terbaik melalui inovasi sehingga Anda mendapatkan solusi yang tepat dalam memenuhi setiap kebutuhan dengan orientasi yang detail dan juga garansi yang dapat diandalkan.',
                'instagram' => 'None',
                'linkedin' => 'https://www.linkedin.com/company/arkamaya-guna-saharsa/?originalSubdomain=id',
                'ekatalog' => 'https://e-katalog.lkpp.go.id/info/penyedia/444815?komoditasId=812',
                'nama_perusahaan' => 'PT Simplay Abyakta Mediatek',
                'sejarah_singkat' => 'SIMPLAY YOUR DIGITAL SOLUTIONS adalah perusahaan yang bergerak di bidang Perdagangan serta Penyedia barang Elektronik dan Peralatan Pendukungnya yang didirikan pada tahun 2020. Kami menyediakan solusi bisnis yang inovatif kepada perusahaan yang menjadi konsumen kami. Kami mengutamakan mutu serta kepercayaan konsumen dengan harapan melalui pelayanan istimewa dari kami secara profesional menghasilkan integrasi dan kepuasan penuh pelanggan kami.',
            ]
        ]);
    }
}
