<?php
require_once('includes/load.php');
// Check what level user has permission to view this page
page_require_level(2);
?>
<?php
$form = find_by_id('application_forms', (int) $_GET['id']);
if (!$form) {
  $session->msg("d", "Missing Application Form id.");
  redirect('product.php');
}
?>
<?php
$delete_id = delete_by_id('application_forms', (int) $form['id']);
if ($delete_id) {
  $session->msg("s", "Application Form deleted.");
  redirect('product.php');
} else {
  $session->msg("d", "Application Form deletion failed.");
  redirect('product.php');
}
?>