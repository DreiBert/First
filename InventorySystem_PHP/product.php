<?php
$page_title = 'All Application Forms';
require_once('includes/load.php');
// Check what level user has permission to view this page
page_require_level(2);
$application_forms = join_application_forms_table();
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <div class="pull-right">
          <a href="add_product.php" class="btn btn-primary">Add New</a>
        </div>
      </div>
      <div class="panel-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th> Case Number </th>
              <th> Full Name </th>
              <th> Contact Number </th>
              <th> Email Address </th>
              <th class="text-center" style="width: 100px;"> Actions </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($application_forms as $form): ?>
              <tr>
                <td class="text-center"><?php echo count_id(); ?></td>
                <td> <?php echo remove_junk($form['case_number']); ?></td>
                <td> <?php echo remove_junk($form['full_name']); ?></td>
                <td> <?php echo remove_junk($form['contact_number']); ?></td>
                <td> <?php echo remove_junk($form['email_address']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_product.php?id=<?php echo (int) $form['id']; ?>" class="btn btn-info btn-xs"
                      title="Edit" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="delete_product.php?id=<?php echo (int) $form['id']; ?>" class="btn btn-danger btn-xs"
                      title="Delete" data-toggle="tooltip">
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
<?php include_once('layouts/footer.php'); ?>