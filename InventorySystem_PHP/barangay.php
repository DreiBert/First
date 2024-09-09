<?php
$page_title = 'All Barangays';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(1);

$all_barangays = find_all('barangays');
?>
<?php
if (isset($_POST['add_barangay'])) {
    $req_field = array('barangay-name');
    validate_fields($req_field);
    $barangay_name = remove_junk($db->escape($_POST['barangay-name']));
    if (empty($errors)) {
        $sql = "INSERT INTO barangays (name)";
        $sql .= " VALUES ('{$barangay_name}')";
        if ($db->query($sql)) {
            $session->msg("s", "Successfully Added New Barangay");
            redirect('barangay.php', false);
        } else {
            $session->msg("d", "Sorry Failed to insert.");
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
</div>
<div class="row">
    <div class="col-md-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Add New Barangay</span>
                </strong>
            </div>
            <div class="panel-body">
                <form method="post" action="barangay.php">
                    <div class="form-group">
                        <input type="text" class="form-control" name="barangay-name" placeholder="Barangay Name">
                    </div>
                    <button type="submit" name="add_barangay" class="btn btn-primary">Add Barangay</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>All Barangays</span>
                </strong>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">#</th>
                            <th>Barangays</th>
                            <th class="text-center" style="width: 100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($all_barangays as $barangay): ?>
                            <tr>
                                <td class="text-center"><?php echo count_id(); ?></td>
                                <td><?php echo remove_junk(ucfirst($barangay['name'])); ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="edit_barangay.php?id=<?php echo (int) $barangay['id']; ?>"
                                            class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </a>
                                        <a href="delete_barangay.php?id=<?php echo (int) $barangay['id']; ?>"
                                            class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<?php include_once('layouts/footer.php'); ?>