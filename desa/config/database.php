<?php
// -------------------------------------------------------------------------
//
// Letakkan username, password dan database sebetulnya di file ini.
// File ini JANGAN di-commit ke GIT. TAMBAHKAN di .gitignore
// -------------------------------------------------------------------------

// Data Konfigurasi MySQL yang disesuaikan

$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'root';
$db['default']['password'] = 'eyJpdiI6Imo0L3FSbjRqcS80MlJwQ2JSSWI0Snc9PSIsInZhbHVlIjoia0dRWiswZXc3UVNvRWFON0F4YWdLQT09IiwibWFjIjoiMDEyNTkxMDNiYTgyNGVkNDVhYTI0MDUzZGMyNzBkNjU0YmVhZWMzMGY3ZjBlZTRjMTVjYzI4OTYwMDNlMmIwOCIsInRhZyI6IiJ9';
$db['default']['port']     = 3306;
$db['default']['database'] = 'guwang';
$db['default']['dbcollat'] = 'utf8mb4_general_ci';

/*
| Untuk setting koneksi database 'Strict Mode'
| Sesuaikan dengan ketentuan hosting
*/
$db['default']['stricton'] = true;

/*
| Konfigurasi options digunakan untuk menyisipkan opsi tambahan
| saat mengatur koneksi ke database.
*/
$db['default']['options'] = [
    // PDO::ATTR_EMULATE_PREPARES => true,
];