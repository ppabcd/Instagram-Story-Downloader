# Story Downloader
Story Downloader by Reza Juliandri

# Bahasa Indonesia
## Cara Menggunakannya

Untuk penggunaan, usahakan menggunakan alamat IP yang sering digunakan untuk melakukan login ke instagram agar akun tidak terkena checkpoint. Pastikan kamu mengubah file **lib/config.php** serta sesuaikan dengan akun, database, dan target. Untuk target, kamu bisa memilih lebih dari 1. Jika kamu terkena checkpoint, aktifkan koneksi ke database sehingga ketika melakukan verifikasi melalui email, kode ini akan menyimpang cookies ke dalam database.

Untuk menggunakannya, jalankan kode berikut.
```bash
chmod +x run.sh
./run.sh
php run.php
```

Jika kamu memiliki akun Google Cloud Platform, kamu bisa menggunakannya untuk mendeteksi wajah dari foto yang kamu dapatkan sebelumnya pada **run.php**.

Pastikan sudah melakukan configurasi pada environment variable agar script bisa membaca akun kalian. Silahkan cek link dibawah ini untuk detailnya.  
[Before you begin | Cloud Vision API](https://cloud.google.com/vision/docs/before-you-begin)
```bash
php checkFace.php
```

## Peringatan
Mohon untuk tidak menjalankan composer install ataupun composer update karena library mgp25 sudah terkena takedown oleh DMCA.

# English

## How to use
To use this repository, make sure you're using the same IP address that you use often for login to Instagram to avoid get checkpoints from Instagram. Make sure you change **lib/config.php** with your account, database, and target. When you got a checkpoint, please activate the database from the config files. So, when you do verification with email, this script will save your own cookies to your database.

Run this code below in your terminal.
```bash
chmod +x run.sh
./run.sh
php run.php
```

If you have Google Cloud Platform account, you can use it for the detection of a face from the image you get before.
Make sure you have configured the environment variable. Please check the link below for the detail.  
[Before you begin | Cloud Vision API](https://cloud.google.com/vision/docs/before-you-begin)
```bash
php checkFace.php
```

## Warning
Please don't run **composer install** or **composer update** because library mgp25 has takedown from DMCA.
