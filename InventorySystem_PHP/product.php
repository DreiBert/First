<?php
$page_title = 'All Application Forms';
require_once('includes/load.php');
// Check what level user has permission to view this page
page_require_level(2);

// Get sorting parameters from URL
$sort_column = isset($_GET['sort']) ? $_GET['sort'] : 'id';
$sort_order = isset($_GET['order']) && $_GET['order'] === 'desc' ? 'desc' : 'asc';

// Toggle sort order for next click
$next_order = $sort_order === 'asc' ? 'desc' : 'asc';

// Get search term from URL
$search_term = isset($_GET['search']) ? $_GET['search'] : '';

// Get rows per page from URL or set default to 20
$rows_per_page = isset($_GET['rows']) ? (int) $_GET['rows'] : 20;

// Modify the query to include sorting, search, and limit
$application_forms = join_application_forms_table($sort_column, $sort_order, $search_term, $rows_per_page);
?>
<?php include_once('layouts/header.php'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <div class="pull-left">
          <form action="product.php" method="GET" class="form-inline">
            <div class="form-group">
              <input type="text" name="search" class="form-control" placeholder="Search"
                value="<?php echo htmlspecialchars($search_term); ?>">
              <button type="submit" class="btn btn-primary">Search</button>
            </div>
            <div class="form-group">
              <label for="rows">Rows per page:</label>
              <select name="rows" class="form-control" onchange="this.form.submit()">
                <option value="10" <?php if ($rows_per_page == 10)
                  echo 'selected'; ?>>10</option>
                <option value="20" <?php if ($rows_per_page == 20)
                  echo 'selected'; ?>>20</option>
                <option value="50" <?php if ($rows_per_page == 50)
                  echo 'selected'; ?>>50</option>
                <option value="100" <?php if ($rows_per_page == 100)
                  echo 'selected'; ?>>100</option>
              </select>
            </div>
          </form>
        </div>
        <div class="pull-right">
          <a href="add_product.php" class="btn btn-primary">Add New</a>
        </div>
      </div>
      <div class="panel-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center" style="width: 10vh;">
                <a href="?sort=id&order=<?php echo $next_order; ?>&search=<?php echo htmlspecialchars($search_term); ?>&rows=<?php echo $rows_per_page; ?>"
                  style="text-decoration: none; color: inherit;">No.
                  <i
                    class="fas fa-sort<?php echo $sort_column == 'id' ? ($sort_order == 'asc' ? '-up' : '-down') : ''; ?>"></i>
                </a>
              </th>
              <th class="text-center" style="width: 12vh;">
                <a href="?sort=case_number&order=<?php echo $next_order; ?>&search=<?php echo htmlspecialchars($search_term); ?>&rows=<?php echo $rows_per_page; ?>"
                  style="text-decoration: none; color: inherit;">ID No.
                  <i
                    class="fas fa-sort<?php echo $sort_column == 'case_number' ? ($sort_order == 'asc' ? '-up' : '-down') : ''; ?>"></i>
                </a>
              </th>
              <th class="text-center" style="width: 30vh;">
                <a href="?sort=full_name&order=<?php echo $next_order; ?>&search=<?php echo htmlspecialchars($search_term); ?>&rows=<?php echo $rows_per_page; ?>"
                  style="text-decoration: none; color: inherit;">Fullname
                  <i
                    class="fas fa-sort<?php echo $sort_column == 'full_name' ? ($sort_order == 'asc' ? '-up' : '-down') : ''; ?>"></i>
                </a>
              </th>
              <th class="text-center" style="width: 30vh;">
                <a href="?sort=address&order=<?php echo $next_order; ?>&search=<?php echo htmlspecialchars($search_term); ?>&rows=<?php echo $rows_per_page; ?>"
                  style="text-decoration: none; color: inherit;">Address
                  <i
                    class="fas fa-sort<?php echo $sort_column == 'address' ? ($sort_order == 'asc' ? '-up' : '-down') : ''; ?>"></i>
                </a>
              </th>
              <th class="text-center" style="width: 15vh;">
                <a href="?sort=barangay&order=<?php echo $next_order; ?>&search=<?php echo htmlspecialchars($search_term); ?>&rows=<?php echo $rows_per_page; ?>"
                  style="text-decoration: none; color: inherit;">Barangay
                  <i
                    class="fas fa-sort<?php echo $sort_column == 'barangay' ? ($sort_order == 'asc' ? '-up' : '-down') : ''; ?>"></i>
                </a>
              </th>
              <th class="text-center" style="width: 15vh;">
                <a href="?sort=age&order=<?php echo $next_order; ?>&search=<?php echo htmlspecialchars($search_term); ?>&rows=<?php echo $rows_per_page; ?>"
                  style="text-decoration: none; color: inherit;">Age
                  <i
                    class="fas fa-sort<?php echo $sort_column == 'age' ? ($sort_order == 'asc' ? '-up' : '-down') : ''; ?>"></i>
                </a>
              </th>
              <th class="text-center" style="width: 15vh;">Gender</th>
              <th class="text-center" style="width: 15vh;">Contact</th>
              <th class="text-center" style="width: 20vh;">
                <a href="?sort=created_at&order=<?php echo $next_order; ?>&search=<?php echo htmlspecialchars($search_term); ?>&rows=<?php echo $rows_per_page; ?>"
                  style="text-decoration: none; color: inherit;">Timestamp
                  <i
                    class="fas fa-sort<?php echo $sort_column == 'created_at' ? ($sort_order == 'asc' ? '-up' : '-down') : ''; ?>"></i>
                </a>
              </th>
              <th class="text-center" style="width: 100px;">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($application_forms as $form): ?>
              <tr>
                <td class="text-center"><?php echo count_id(); ?></td>
                <td class="text-center"> <?php echo remove_junk($form['case_number']); ?></td>
                <td class="text-center"> <?php echo remove_junk($form['full_name']); ?></td>
                <td class="text-center"> <?php echo remove_junk($form['address']); ?></td>
                <td class="text-center"> <?php echo remove_junk($form['barangay']); ?></td>
                <td class="text-center"> <?php echo remove_junk($form['age']); ?></td>
                <td class="text-center"> <?php echo remove_junk($form['sex']); ?></td>
                <td class="text-center"> <?php echo remove_junk($form['contact_number']); ?></td>
                <td class="text-center"> <?php echo remove_junk($form['created_at']); ?></td>
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