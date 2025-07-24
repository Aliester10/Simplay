@component('mail::message')

<div style="text-align: center; margin-bottom: 20px;">
    <img src="http://156.67.218.119:8002/assets/img/Logo.png" style="height: 70px;" alt="Company Logo">
</div>

# Notifikasi Lamaran Baru

Halo Tim HR,

Sistem karier telah menerima lamaran baru untuk posisi yang dibuka. Berikut detail lamaran tersebut:

@component('mail::table')
| Informasi | Detail |
|:----------|:-------|
| **Nama Pelamar** | {{ $application->name }} |
| **Email** | [{{ $application->email }}](mailto:{{ $application->email }}) |
| **Posisi yang Dilamar** | {{ $position->title }} |
| **CV** | Terlampir pada email ini |
@endcomponent

@component('mail::panel')
### Tahapan Selanjutnya
Mohon untuk melakukan review lamaran dan menghubungi kandidat yang memenuhi kualifikasi. Proses seleksi tahap awal diharapkan selesai dalam 3 hari kerja.
@endcomponent

@component('mail::button', ['url' => 'mailto:' . $application->email])
Hubungi Kandidat
@endcomponent

Terima kasih,<br>
**Departemen Rekrutmen**<br>
**PT. Simplay Abyakta Mediatek**

<div style="margin-top: 30px; padding-top: 15px; border-top: 1px solid #e8e5ef; text-align: center; font-size: 12px; color: #718096;">
    Email ini dikirim secara otomatis oleh Sistem Rekrutmen PT. Simplay Abyakta Mediatek.
</div>

@endcomponent