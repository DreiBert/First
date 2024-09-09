<?php
$page_title = 'Edit Barangay';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(1);

// Display the barangay details
$barangay = find_by_id('barangays', (int) $_GET['id']);
if (!$barangay) {
    $session->msg("d", "Missing barangay id.");
    redirect('barangay.php');
}

if (isset($_POST['edit_barangay'])) {
    $req_field = array('barangay-name');
    validate_fields($req_field);
    $barangay_name = remove_junk($db->escape($_POST['barangay-name']));
    if (empty($errors)) {
        $sql = "UPDATE barangays SET name='{$barangay_name}'";
        $sql .= " WHERE id='{$barangay['id']}'";
        $result = $db->query($sql);
        if ($result && $db->affected_rows() === 1) {
            $session->msg("s", "Successfully updated Barangay");
            redirect('barangay.php', false);
        } else {
            $session->msg("d", "Sorry! Failed to Update");
            redirect('barangay.php', false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('barangay.php', false);
    }
}
?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <?php echo display_msg($msg); ?>
    </div>
    <div class="col-md-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Editing <?php echo remove_junk(ucfirst($barangay['name'])); ?></span>
                </strong>
            </div>
            <div class="panel-body">
                <form method="post" action="edit_barangay.php?id=<?php echo (int) $barangay['id']; ?>">
                    <div class="form-group">
                        <input type="text" class="form-control" name="barangay-name"
                            value="<?php echo remove_junk(ucfirst($barangay['name'])); ?>">
                    </div>
                    <button type="submit" name="edit_barangay" class="btn btn-primary">Update Barangay</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once('layouts/footer.php'); ?>