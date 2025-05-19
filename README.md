# Company Profile of Simplay
Website company profile ini menyajikan informasi lengkap mengenai perusahaan PT Simplay Abyakta Mediatek yang dirancang untuk memberikan kesan profesional dan kredibel, serta mempermudah pengunjung untuk mengenal perusahaan secara lebih mendalam.

---

## Spesifikasi Teknologi
Proyek ini dikembangkan menggunakan teknologi berikut :

### 1. **Frontend**
- **HTML5** : Digunakan untuk struktur halaman dan elemen web semantik.
- **CSS3** : Digunakan untuk styling dan animasi halaman web.
- **Bootstrap 5** : Framework untuk membuat desain yang responsif dan konsisten.
- **JavaScript (ES6)** : Membantu menambahkan interaktivitas, validasi form, dan komunikasi API.

### 2. **Backend**
- **PHP** : Menggunakan versi 8.1.25 untuk pengembangan backend, mendukung performa lebih cepat dan fitur modern.
- **Laravel** : Framework versi 10.48.22 untuk mempermudah pengelolaan aplikasi berbasis arsitektur MVC.

### 3. **Database**
- **MySQL** : Menggunakan versi 8.0.32 sebagai database utama, yang menawarkan performa tinggi, fitur JSON indexing, dan keamanan data yang lebih baik.

### 4. **Version Control dan CI/CD**
- **Git** : Digunakan untuk kontrol versi dan mengelola perubahan kode, serta kolaborasi tim.

---

## Panduan Instalasi dan Pengaturan Proyek

### 1. **Persyaratan Sistem**
Sebelum memulai, pastikan perangkat Anda memiliki spesifikasi berikut:
- **PHP** : Versi 8.1.25 atau lebih baru.
- **Composer** : Untuk mengelola dependensi PHP.
- **Node.js** dan **NPM** : Untuk mengelola dependensi frontend.
- **MySQL** : Versi 8.0 atau lebih baru.
- **Git** : Untuk cloning repository dan kontrol versi.

---

### 2. **Langkah Instalasi Proyek**

#### **Langkah 1 : Clone Repository**
Clone proyek dari GitHub menggunakan perintah berikut :
```bash
git clone https://github.com/putriitr/Umalo-Simplay.git
cd Umalo-Simplay
```

#### **Langkah 2 : Install Dependensi Backend**
Gunakan Composer untuk menginstal dependensi PHP :
```bash
composer install
```

#### **Langkah 3 : Install Dependensi Frontend**
Gunakan NPM untuk menginstal paket frontend :
```bash
npm install
npm run dev
```

#### **Langkah 4 : Konfigurasi File .env**
Salin file .env.example menjadi .env :
```bash
cp .env.example .env
```
Modifikasi kode dalam file env dengan DB_DATABASE=compro-simplay

#### **Langkah 5 : Migrasi Database**
Jalankan perintah berikut untuk membuat tabel di database :
```bash
php artisan migrate --seed
```

#### **Langkah 6: Jalankan Server Lokal**
Gunakan perintah berikut untuk memulai server lokal :
```bash
php artisan serve
```
Atau buka aplikasi di browser melalui URL : http://localhost:8080
