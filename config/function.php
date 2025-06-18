<?php
function kodeOtomatis()
{
    $koneksi = new mysqli("localhost", "root", "", "koperasi-db");
    $result = $koneksi->query("SELECT kode_anggota FROM anggota ORDER BY id_anggota DESC LIMIT 1");
    if ($result && $row = $result->fetch_assoc()) {
        // Ambil angka dari kode, misalnya dari AG-0010 ambil 10
        $lastCode = $row['kode_anggota'];
        $number = (int) substr($lastCode, 3); // 3 karena 'AG-'
        $newNumber = $number + 1;
    } else {
        $newNumber = 1;
    }


    // Format dengan leading zero
    $newCode = 'AG-' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    return $newCode;
}
