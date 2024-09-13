<?php
require_once('includes/load.php');

/*--------------------------------------------------------------*/
/* Function for find all database table rows by table name
/*--------------------------------------------------------------*/
function find_all($table)
{
  global $db;
  if (tableExists($table)) {
    return find_by_sql("SELECT * FROM " . $db->escape($table));
  }
}
/*--------------------------------------------------------------*/
/* Function for Perform queries
/*--------------------------------------------------------------*/
function find_by_sql($sql)
{
  global $db;
  $result = $db->query($sql);
  $result_set = $db->while_loop($result);
  return $result_set;
}

function find_emergency_contact_by_application_id($application_id)
{
  global $db;
  $sql = "SELECT * FROM emergency_contacts WHERE application_id = " . $db->escape((int) $application_id) . " LIMIT 1";
  $result = find_by_sql($sql);
  return !empty($result) ? $result[0] : null;
}




/*--------------------------------------------------------------*/
/*  Function for Find data from table by id
/*--------------------------------------------------------------*/
function find_by_id($table, $id)
{
  global $db;
  $id = (int) $id;
  if (tableExists($table)) {
    $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE id='{$db->escape($id)}' LIMIT 1");
    if ($result = $db->fetch_assoc($sql))
      return $result;
    else
      return null;
  }
}
/*--------------------------------------------------------------*/
/* Function for Delete data from table by id
/*--------------------------------------------------------------*/
function delete_by_id($table, $id)
{
  global $db;
  if (tableExists($table)) {
    // Delete related records in emergency_contacts table
    if ($table == 'application_forms') {
      $db->query("DELETE FROM emergency_contacts WHERE application_id=" . $db->escape($id));
    }

    // Delete the record in the specified table
    $sql = "DELETE FROM " . $db->escape($table);
    $sql .= " WHERE id=" . $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
  }
}
/*--------------------------------------------------------------*/
/* Function for Count id  By table name
/*--------------------------------------------------------------*/

function count_by_id($table)
{
  global $db;
  if (tableExists($table)) {
    $sql = "SELECT COUNT(id) AS total FROM " . $db->escape($table);
    $result = $db->query($sql);
    return ($db->fetch_assoc($result));
  }
}
/*--------------------------------------------------------------*/
/* Determine if database table exists
/*--------------------------------------------------------------*/
function tableExists($table)
{
  global $db;
  $table_exit = $db->query("SHOW TABLES LIKE '{$db->escape($table)}'");
  if ($table_exit) {
    if ($db->num_rows($table_exit) > 0)
      return true;
    else
      return false;
  }
  return false;
}
/*--------------------------------------------------------------*/
/* Login with the data provided in $_POST,
/* coming from the login form.
/*--------------------------------------------------------------*/
function authenticate($username = '', $password = '')
{
  global $db;
  $username = $db->escape($username);
  $password = $db->escape($password);
  $sql = sprintf("SELECT id,username,password,user_level FROM users WHERE username ='%s' LIMIT 1", $username);
  $result = $db->query($sql);
  if ($db->num_rows($result)) {
    $user = $db->fetch_assoc($result);
    $password_request = sha1($password);
    if ($password_request === $user['password']) {
      return $user['id'];
    }
  }
  return false;
}
/*--------------------------------------------------------------*/
/* Login with the data provided in $_POST,
/* coming from the login_v2.php form.
/* If you used this method then remove authenticate function.
/*--------------------------------------------------------------*/
function authenticate_v2($username = '', $password = '')
{
  global $db;
  $username = $db->escape($username);
  $password = $db->escape($password);
  $sql = sprintf("SELECT id,username,password,user_level FROM users WHERE username ='%s' LIMIT 1", $username);
  $result = $db->query($sql);
  if ($db->num_rows($result)) {
    $user = $db->fetch_assoc($result);
    $password_request = sha1($password);
    if ($password_request === $user['password']) {
      return $user;
    }
  }
  return false;
}


/*--------------------------------------------------------------*/
/* Find current log in user by session id
/*--------------------------------------------------------------*/
function current_user()
{
  static $current_user;
  global $db;
  if (!$current_user) {
    if (isset($_SESSION['user_id'])):
      $user_id = intval($_SESSION['user_id']);
      $current_user = find_by_id('users', $user_id);
    endif;
  }
  return $current_user;
}
/*--------------------------------------------------------------*/
/* Find all user by
/* Joining users table and user gropus table
/*--------------------------------------------------------------*/
function find_all_user()
{
  global $db;
  $results = array();
  $sql = "SELECT u.id,u.name,u.username,u.user_level,u.status,u.last_login,";
  $sql .= "g.group_name ";
  $sql .= "FROM users u ";
  $sql .= "LEFT JOIN user_groups g ";
  $sql .= "ON g.group_level=u.user_level ORDER BY u.name ASC";
  $result = find_by_sql($sql);
  return $result;
}
/*--------------------------------------------------------------*/
/* Function to update the last log in of a user
/*--------------------------------------------------------------*/

function updateLastLogIn($user_id)
{
  global $db;
  $date = make_date();
  $sql = "UPDATE users SET last_login='{$date}' WHERE id ='{$user_id}' LIMIT 1";
  $result = $db->query($sql);
  return ($result && $db->affected_rows() === 1 ? true : false);
}

/*--------------------------------------------------------------*/
/* Find all Group name
/*--------------------------------------------------------------*/
function find_by_groupName($val)
{
  global $db;
  $sql = "SELECT group_name FROM user_groups WHERE group_name = '{$db->escape($val)}' LIMIT 1 ";
  $result = $db->query($sql);
  return ($db->num_rows($result) === 0 ? true : false);
}
/*--------------------------------------------------------------*/
/* Find group level
/*--------------------------------------------------------------*/
function find_by_groupLevel($level)
{
  global $db;
  $sql = "SELECT group_level FROM user_groups WHERE group_level = '{$db->escape($level)}' LIMIT 1 ";
  $result = $db->query($sql);
  return ($db->num_rows($result) === 0 ? true : false);
}
/*--------------------------------------------------------------*/
/* Function for cheaking which user level has access to page
/*--------------------------------------------------------------*/
function page_require_level($require_level)
{
  global $session;
  $current_user = current_user();
  $login_level = find_by_groupLevel($current_user['user_level']);
  //if user not login
  if (!$session->isUserLoggedIn(true)):
    $session->msg('d', 'Please login...');
    redirect('index.php', false);
    //if Group status Deactive
  elseif (is_array($login_level) && $login_level['group_status'] == '0'):
    $session->msg('d', 'This level user has been band!');
    redirect('home.php', false);
    //cheackin log in User level and Require level is Less than or equal to
  elseif ($current_user['user_level'] <= (int) $require_level):
    return true;
  else:
    $session->msg("d", "Sorry! you dont have permission to view the page.");
    redirect('home.php', false);
  endif;

}
/*--------------------------------------------------------------*/
/* Function for Finding all product name
/* JOIN with categorie  and media database table
/*--------------------------------------------------------------*/
/*
function join_product_table()
{
  global $db;
  $sql = " SELECT p.id,p.name,p.quantity,p.buy_price,p.sale_price,p.media_id,p.date,c.name";
  $sql .= " AS categorie,m.file_name AS image";
  $sql .= " FROM products p";
  $sql .= " LEFT JOIN categories c ON c.id = p.categorie_id";
  $sql .= " LEFT JOIN media m ON m.id = p.media_id";
  $sql .= " ORDER BY p.id ASC";
  return find_by_sql($sql);

}
  */
function join_product_table()
{
  global $db;
  $sql = " SELECT p.id,p.name,p.quantity,p.buy_price,p.sale_price,p.media_id,p.date,c.name";
  $sql .= " AS categorie,m.file_name AS image";
  $sql .= " FROM products p";

  $sql .= " LEFT JOIN categories c ON c.id = p.categorie_id";
  $sql .= " LEFT JOIN media m ON m.id = p.media_id";
  $sql .= " ORDER BY p.id ASC";
  return find_by_sql($sql);

}
function find_all_barangays()
{
  global $db;
  $sql = "SELECT id, name FROM barangays ORDER BY name ASC";
  return find_by_sql($sql);
}


function join_application_forms_table($sort_column, $sort_order, $search_term, $rows_per_page, $offset, $selected_status)
{
  global $db;

  // Handle the special case for barangay
  if ($sort_column == 'barangay') {
    $sort_column = 'b.name';
  } else {
    $sort_column = 'af.' . $sort_column;
  }

  // Add search term to the query
  $search_sql = '';
  if (!empty($search_term)) {
    $search_term = $db->escape($search_term);
    $search_sql = "AND (af.case_number LIKE '%$search_term%' OR af.last_name LIKE '%$search_term%' OR af.first_name LIKE '%$search_term%' OR af.middle_name LIKE '%$search_term%' OR af.extension_name LIKE '%$search_term%' OR af.address LIKE '%$search_term%' OR b.name LIKE '%$search_term%' OR af.age LIKE '%$search_term%' OR af.sex LIKE '%$search_term%' OR af.contact_number LIKE '%$search_term%' OR af.created_at LIKE '%$search_term%' OR af.status LIKE '%$search_term%')";
  }

  // Add status filter to the query
  $status_sql = '';
  if (!empty($selected_status)) {
    $selected_status = $db->escape($selected_status);
    $status_sql = "AND af.status = '$selected_status'";
  }

  // Add pagination to the query
  $sql = "SELECT af.id, af.case_number, 
                 CONCAT(af.last_name, ', ', af.first_name, ' ', af.middle_name, ' ', af.extension_name) AS full_name, 
                 af.address, b.name AS barangay, af.age, af.sex AS sex, af.contact_number, af.created_at, af.status 
          FROM application_forms af
          LEFT JOIN barangays b ON af.barangay_id = b.id
          WHERE 1=1 $search_sql $status_sql
          ORDER BY {$sort_column} {$sort_order}
          LIMIT {$db->escape($rows_per_page)} OFFSET {$db->escape($offset)}";
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Function for Count total application forms
/*--------------------------------------------------------------*/
function count_application_forms()
{
  global $db;
  $sql = "SELECT COUNT(id) AS total FROM application_forms";
  $result = $db->query($sql);
  return ($db->fetch_assoc($result));
}

/*--------------------------------------------------------------*/
/* Function for Count total males
/*--------------------------------------------------------------*/
function count_males()
{
  global $db;
  $sql = "SELECT COUNT(id) AS total FROM application_forms WHERE sex = 'Male'";
  $result = $db->query($sql);
  return ($db->fetch_assoc($result));
}

/*--------------------------------------------------------------*/
/* Function for Count total females
/*--------------------------------------------------------------*/
function count_females()
{
  global $db;
  $sql = "SELECT COUNT(id) AS total FROM application_forms WHERE sex = 'Female'";
  $result = $db->query($sql);
  return ($db->fetch_assoc($result));
}

/*--------------------------------------------------------------*/
/* Function for fetching people per barangay
/*--------------------------------------------------------------*/
function find_people_per_barangay()
{
  global $db;
  $sql = "SELECT barangays.name AS barangay, COUNT(application_forms.id) AS total 
          FROM barangays 
          LEFT JOIN application_forms ON application_forms.barangay_id = barangays.id 
          GROUP BY barangays.name";
  $result = $db->query($sql);
  return $db->while_loop($result);
}

/*--------------------------------------------------------------*/
/* Function for Count total barangays
/*--------------------------------------------------------------*/
function count_barangays()
{
  global $db;
  $sql = "SELECT COUNT(id) AS total FROM barangays";
  $result = $db->query($sql);
  return ($db->fetch_assoc($result));
}



/*--------------------------------------------------------------*/
/* Function for Finding all product name
/* Request coming from ajax.php for auto suggest
/*--------------------------------------------------------------*/

function find_product_by_title($product_name)
{
  global $db;
  $p_name = remove_junk($db->escape($product_name));
  $sql = "SELECT name FROM products WHERE name like '%$p_name%' LIMIT 5";
  $result = find_by_sql($sql);
  return $result;
}

/*--------------------------------------------------------------*/
/* Function for Finding all product info by product title
/* Request coming from ajax.php
/*--------------------------------------------------------------*/
function find_all_product_info_by_title($title)
{
  global $db;
  $sql = "SELECT * FROM products ";
  $sql .= " WHERE name ='{$title}'";
  $sql .= " LIMIT 1";
  return find_by_sql($sql);
}

/*--------------------------------------------------------------*/
/* Function for Update product quantity
/*--------------------------------------------------------------*/
function update_product_qty($qty, $p_id)
{
  global $db;
  $qty = (int) $qty;
  $id = (int) $p_id;
  $sql = "UPDATE products SET quantity=quantity -'{$qty}' WHERE id = '{$id}'";
  $result = $db->query($sql);
  return ($db->affected_rows() === 1 ? true : false);

}
/*--------------------------------------------------------------*/
/* Function for Display Recent product Added
/*--------------------------------------------------------------*/
function find_recent_product_added($limit)
{
  global $db;
  $sql = " SELECT p.id,p.name,p.sale_price,p.media_id,c.name AS categorie,";
  $sql .= "m.file_name AS image FROM products p";
  $sql .= " LEFT JOIN categories c ON c.id = p.categorie_id";
  $sql .= " LEFT JOIN media m ON m.id = p.media_id";
  $sql .= " ORDER BY p.id DESC LIMIT " . $db->escape((int) $limit);
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Function for Find Highest saleing Product
/*--------------------------------------------------------------*/
function find_higest_saleing_product($limit)
{
  global $db;
  $sql = "SELECT p.name, COUNT(s.product_id) AS totalSold, SUM(s.qty) AS totalQty";
  $sql .= " FROM sales s";
  $sql .= " LEFT JOIN products p ON p.id = s.product_id ";
  $sql .= " GROUP BY s.product_id";
  $sql .= " ORDER BY SUM(s.qty) DESC LIMIT " . $db->escape((int) $limit);
  return $db->query($sql);
}


/*--------------------------------------------------------------*/
/* Function for finding family members by application ID
/*--------------------------------------------------------------*/

function find_family_members_by_application_id($application_id)
{
  global $db;
  $sql = "SELECT * FROM family_members WHERE application_id = " . $db->escape((int) $application_id);
  $result = find_by_sql($sql);

  // Debugging: Check if the query returns any results
  if (empty($result)) {
    error_log("No family members found for application_id: " . $application_id);
  }

  return $result;
}

/*--------------------------------------------------------------*/
/* Function for find all sales
/*--------------------------------------------------------------*/
function find_all_sale()
{
  global $db;
  $sql = "SELECT s.id,s.qty,s.price,s.date,p.name";
  $sql .= " FROM sales s";
  $sql .= " LEFT JOIN products p ON s.product_id = p.id";
  $sql .= " ORDER BY s.date DESC";
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Function for Display Recent sale
/*--------------------------------------------------------------*/
function find_recent_sale_added($limit)
{
  global $db;
  $sql = "SELECT s.id,s.qty,s.price,s.date,p.name";
  $sql .= " FROM sales s";
  $sql .= " LEFT JOIN products p ON s.product_id = p.id";
  $sql .= " ORDER BY s.date DESC LIMIT " . $db->escape((int) $limit);
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Function for Generate sales report by two dates
/*--------------------------------------------------------------*/
function find_sale_by_dates($start_date, $end_date)
{
  global $db;
  $start_date = date("Y-m-d", strtotime($start_date));
  $end_date = date("Y-m-d", strtotime($end_date));
  $sql = "SELECT s.date, p.name,p.sale_price,p.buy_price,";
  $sql .= "COUNT(s.product_id) AS total_records,";
  $sql .= "SUM(s.qty) AS total_sales,";
  $sql .= "SUM(p.sale_price * s.qty) AS total_saleing_price,";
  $sql .= "SUM(p.buy_price * s.qty) AS total_buying_price ";
  $sql .= "FROM sales s ";
  $sql .= "LEFT JOIN products p ON s.product_id = p.id";
  $sql .= " WHERE s.date BETWEEN '{$start_date}' AND '{$end_date}'";
  $sql .= " GROUP BY DATE(s.date),p.name";
  $sql .= " ORDER BY DATE(s.date) DESC";
  return $db->query($sql);
}
/*--------------------------------------------------------------*/
/* Function for Generate Daily sales report
/*--------------------------------------------------------------*/
function dailySales($year, $month)
{
  global $db;
  $sql = "SELECT s.qty,";
  $sql .= " DATE_FORMAT(s.date, '%Y-%m-%e') AS date,p.name,";
  $sql .= "SUM(p.sale_price * s.qty) AS total_saleing_price";
  $sql .= " FROM sales s";
  $sql .= " LEFT JOIN products p ON s.product_id = p.id";
  $sql .= " WHERE DATE_FORMAT(s.date, '%Y-%m' ) = '{$year}-{$month}'";
  $sql .= " GROUP BY DATE_FORMAT( s.date,  '%e' ),s.product_id";
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Function for Generate Monthly sales report
/*--------------------------------------------------------------*/
function monthlySales($year)
{
  global $db;
  $sql = "SELECT s.qty,";
  $sql .= " DATE_FORMAT(s.date, '%Y-%m-%e') AS date,p.name,";
  $sql .= "SUM(p.sale_price * s.qty) AS total_saleing_price";
  $sql .= " FROM sales s";
  $sql .= " LEFT JOIN products p ON s.product_id = p.id";
  $sql .= " WHERE DATE_FORMAT(s.date, '%Y' ) = '{$year}'";
  $sql .= " GROUP BY DATE_FORMAT( s.date,  '%c' ),s.product_id";
  $sql .= " ORDER BY date_format(s.date, '%c' ) ASC";
  return find_by_sql($sql);
}

