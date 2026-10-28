<?php
// -------------------------------------------------------------------------
//
// Letakkan username, password dan database sebetulnya di file ini.
// File ini JANGAN di-commit ke GIT. TAMBAHKAN di .gitignore
// -------------------------------------------------------------------------

// Data Konfigurasi MySQL yang disesuaikan

$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'root';
$db['default']['password'] = 'eyJpdiI6IjJFbzhZd0ZjODFDRkN4U0Rvb1V5bWc9PSIsInZhbHVlIjoieDA0RC9aZ053TUx1b1V2SGNBNGNYdz09IiwibWFjIjoiMzI1NTExMWY2NzJlYjJmODMzZWI0N2I4OWQ4NzczOTA3ZTg2NmIwOTE4OTUzZjZhZDUwMTgyODRiY2NmN2I5NSIsInRhZyI6IiJ9';
$db['default']['port']     = 3306;
$db['default']['database'] = 'opensid';
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