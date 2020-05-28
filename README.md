# Story Downloader
Story Downloader by Reza Juliandri

## Cara Pake
Usahain untuk gunain ini pertama kali di alamat IP yang paling sering dipake biar engga kena checkpoint.

Ubah config sesuaiin sama akun. Kalau bisa connect ke db juga biar misalkan lolos checkpoint engga kena checkpoint lagi.

Jalanin kode berikut
```bash
php run.php
```

Misalkan kalian punya akun GCP, kalian bisa gunain untuk deteksi wajah dari foto yang udah kalian dapetin.
Pastiin udah ngelakuin config GCP ke environment variable kalian. Silahkan cek link dibawah untuk detailnya.

[Before you begin | Cloud Vision API](https://cloud.google.com/vision/docs/before-you-begin)
```bash
php checkFace.php
```
Script ini akan ngedeteksi wajah di foto yang udah kalian dapetin sebelumnya. Jadi untuk pengecekan menggunakan 2 cara. Yang pertama cek labelnya kalau engga sesuai baru ngehitung jumlah wajah di gambar.
## Warn
Mohon untuk tidak menjalankan composer install ataupun composer update karena library mgp25 udah kena takedown sama DMCA.