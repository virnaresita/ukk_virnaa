<?php

// Include configuration file
include '../../config/config.php';

// Define status array
$statusArray = [0, 1, 2];
$statusString = implode(',', $statusArray);  // Convert array to comma-separated string

// Get current date
$currentDate = date('Y-m-d');

// Update status of overdue borrowings
$sql = "UPDATE peminjaman SET status='3' WHERE tgl_kembali < '$currentDate' AND status IN ($statusString)";

if ($connection->query($sql) === TRUE) {
    echo '<script>alert("Peminjaman berhasil dinonaktifkan."); window.location.href="peminjamanBuku.php";</script>';
} else {
    echo "Error: " . $sql . "<br>" . $connection->error;
}
