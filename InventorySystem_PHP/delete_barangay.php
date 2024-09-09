<?php
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(1);

$barangay = find_by_id('barangays', (int) $_GET['id']);
if (!$barangay) {
    $session->msg("d", "Missing Barangay id.");
    redirect('barangay.php');
}

$delete_id = delete_by_id('barangays', (int) $barangay['id']);
if ($delete_id) {
    $session->msg("s", "Barangay deleted.");
    redirect('barangay.php');
} else {
    $session->msg("d", "Barangay deletion failed.");
    redirect('barangay.php');
}
?>