<!-- Section 1 -->
<?php
$page_title = 'Edit Application Form';
require_once('includes/load.php');
// Check what level user has permission to view this page
page_require_level(2);
?>
<?php
$form = find_by_id('application_forms', (int) $_GET['id']);
$all_barangays = find_all('barangays');
if (!$form) {
  $session->msg("d", "Missing application form id.");
  redirect('product.php');
}

// Fetch the related family members
$family_members = find_family_members_by_application_id((int) $_GET['id']);
$emergency_contact = find_emergency_contact_by_application_id((int) $_GET['id']);
?>
<?php
if (isset($_POST['update_form'])) {
  $req_fields = array('case-number', 'full_name', 'sex', 'date-of-birth', 'place-of-birth', 'address', 'barangay_id', 'educational-attainment', 'civil-status', 'religion', 'contact-number', 'email-address', 'pantawid-beneficiary', 'lgbtq', 'pensioner', 'classification', 'problems');
  validate_fields($req_fields);

  if (empty($errors)) {
    // Sanitize and escape form inputs
    $case_number = remove_junk($db->escape($_POST['case-number']));
    $full_name = remove_junk($db->escape($_POST['full_name']));
    $sex = remove_junk($db->escape($_POST['sex']));
    $date_of_birth = remove_junk($db->escape($_POST['date-of-birth']));
    $place_of_birth = remove_junk($db->escape($_POST['place-of-birth']));
    $address = remove_junk($db->escape($_POST['address']));
    $barangay_id = (int) $_POST['barangay_id'];
    $educational_attainment = remove_junk($db->escape($_POST['educational-attainment']));
    $civil_status = remove_junk($db->escape($_POST['civil-status']));
    $occupation = remove_junk($db->escape($_POST['occupation']));
    $religion = remove_junk($db->escape($_POST['religion']));
    $company_agency = remove_junk($db->escape($_POST['company-agency']));
    $monthly_income = remove_junk($db->escape($_POST['monthly-income']));
    $employment_status = remove_junk($db->escape($_POST['employment-status']));
    $contact_number = remove_junk($db->escape($_POST['contact-number']));
    $email_address = remove_junk($db->escape($_POST['email-address']));
    $pantawid_beneficiary = remove_junk($db->escape($_POST['pantawid-beneficiary']));
    $lgbtq = remove_junk($db->escape($_POST['lgbtq']));
    $pensioner = remove_junk($db->escape($_POST['pensioner']));
    $classification = remove_junk($db->escape($_POST['classification']));
    $problems = remove_junk($db->escape($_POST['problems']));

    // Calculate age
    $dob = new DateTime($date_of_birth);
    $now = new DateTime();
    $age = $now->diff($dob)->y;

    // Update the application form in the database
    $query = "UPDATE application_forms SET";
    $query .= " case_number='{$case_number}', full_name='{$full_name}', sex='{$sex}', date_of_birth='{$date_of_birth}', age='{$age}', place_of_birth='{$place_of_birth}', address='{$address}', barangay_id='{$barangay_id}', educational_attainment='{$educational_attainment}', civil_status='{$civil_status}', occupation='{$occupation}', religion='{$religion}', company_agency='{$company_agency}', monthly_income='{$monthly_income}', employment_status='{$employment_status}', contact_number='{$contact_number}', email_address='{$email_address}', pantawid_beneficiary='{$pantawid_beneficiary}', lgbtq='{$lgbtq}', pensioner='{$pensioner}', classification='{$classification}', problems='{$problems}'";
    $query .= " WHERE id='{$form['id']}'";
    $result = $db->query($query);

    if ($result && $db->affected_rows() === 1) {
      $session->msg('s', "Application form updated ");
      redirect('product.php', false);
    } else {
      $session->msg('d', 'Sorry, failed to update!');
      redirect('edit_product.php?id=' . $form['id'], false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('edit_product.php?id=' . $form['id'], false);
  }
}
?>

<!-- Section 2 -->
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Edit Application Form</span>
        </strong>
      </div>
      <div class="panel-body">
        <div class="col-md-12">
          <form method="post" action="edit_product.php?id=<?php echo (int) $form['id']; ?>" class="clearfix">
            <!-- Row 1: Case Number, Full Name, Sex, Date of Birth -->
            <div class="row d-flex align-items-center">
              <div class="col-md-10"> <strong>
                  <i>
                    <p class="mb-0">I. IDENTIFYING INFORMATION</p>
                  </i>
                </strong>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group mb-2">
                  <div class=" input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i> Case Number</span>
                    <input type="text" class="form-control" name="case-number"
                      value="<?php echo remove_junk($form['case_number']); ?>" required>
                  </div>
                </div>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <div class=" input-group">
                    <span class="input-group-addon">Full Name</span>
                    <input type="text" class="form-control" name="full_name"
                      value="<?php echo remove_junk($form['full_name']); ?>" required>
                  </div>
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon">Sex</span>
                    <select class="form-control" name="sex" required>
                      <option <?php if ($form['sex'] === 'Male')
                        echo 'selected="selected"'; ?> value="Male">Male</option>
                      <option <?php if ($form['sex'] === 'Female')
                        echo 'selected="selected"'; ?> value="Female">Female
                      </option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon">Date of Birth</span>
                    <input type="date" class="form-control" name="date-of-birth"
                      value="<?php echo remove_junk($form['date_of_birth']); ?>" required>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon">Place of Birth</span>
                    <input type="text" class="form-control" name="place-of-birth"
                      value="<?php echo remove_junk($form['place_of_birth']); ?>" required>
                  </div>
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                  <div class=" input-group">
                    <span class="input-group-addon">Address</span>
                    <input type="text" class="form-control" name="address"
                      value="<?php echo remove_junk($form['address']); ?>" required>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <div class=" input-group">
                    <span class="input-group-addon">Barangay</span>
                    <select class="form-control" name="barangay_id" required>
                      <?php foreach ($all_barangays as $barangay): ?>
                        <option <?php if ($form['barangay_id'] === $barangay['id'])
                          echo 'selected="selected"'; ?> value="
        <?php echo (int) $barangay['id']; ?>">
                          <?php echo remove_junk($barangay['name']); ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>


            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon">Educational Attainment</span>
                    <input type="text" class="form-control" name="educational-attainment"
                      value="<?php echo remove_junk($form['educational_attainment']); ?>" required>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class=" form-group">
                  <div class="input-group">
                    <span class="input-group-addon">Civil Status</span>
                    <select class="form-control" name="civil-status" required>
                      <option <?php if ($form['civil_status'] === 'Single')
                        echo 'selected="selected"'; ?> value="Single">
                        Single</option>
                      <option <?php if ($form['civil_status'] === 'Married')
                        echo 'selected="selected"'; ?>
                        value="Married">
                        Married</option>
                      <option <?php if ($form['civil_status'] === 'Divorced')
                        echo 'selected="selected"'; ?>
                        value="Divorced">Divorced</option>
                      <option <?php if ($form['civil_status'] === 'Widowed')
                        echo 'selected="selected"'; ?>
                        value="Widowed">
                        Widowed</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon">Religion</span>
                    <input type="text" class="form-control" name="religion"
                      value="<?php echo remove_junk($form['religion']); ?>" required>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class=" form-group">
                  <div class="input-group">
                    <span class="input-group-addon">Occupation</span>
                    <input type="text" class="form-control" name="occupation"
                      value="<?php echo remove_junk($form['occupation']); ?>" required>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon">Company/Agency</span>
                    <input type="text" class="form-control" name="company-agency"
                      value="<?php echo remove_junk($form['company_agency']); ?>" required>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon">Monthly Income</span>
                    <input type="text" class="form-control" name="monthly-income"
                      value="<?php echo remove_junk($form['monthly_income']); ?>" required>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon">Employment Status</span> <select class="form-control"
                      name="employment-status" required>
                      <option <?php if ($form['employment_status'] === 'Employed')
                        echo 'selected="selected"'; ?>
                        value="Employed">Employed</option>
                      <option <?php if ($form['employment_status'] === 'Self-employed')
                        echo 'selected="selected"'; ?>
                        value="Self-employed">Self-employed</option>
                      <option <?php if ($form['employment_status'] === 'Not employed')
                        echo 'selected="selected"'; ?>
                        value="Not employed">Not employed</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <div class=" input-group">
                    <span class="input-group-addon">Contact Number</span>
                    <input type="text" class="form-control" name="contact-number"
                      value="<?php echo remove_junk($form['contact_number']); ?>" required>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon">Email Address</span>
                    <input type="email" class="form-control" name="email-address"
                      value="<?php echo remove_junk($form['email_address']); ?>" required>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <div class=" input-group">
                    <span class="input-group-addon">Pantawid Beneficiary</span>
                    <select class="form-control" name="pantawid-beneficiary" required>
                      <option <?php if ($form['pantawid_beneficiary'] === 'Y')
                        echo 'selected="selected"'; ?> value="Y">
                        Yes
                      </option>
                      <option <?php if ($form['pantawid_beneficiary'] === 'N')
                        echo 'selected="selected"'; ?> value="N">No
                      </option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon">Pensioner</span>
                    <select class="form-control" name="pensioner" required>
                      <option <?php if ($form['pensioner'] === 'Y')
                        echo 'selected="selected"'; ?> value="Y">Yes</option>
                      <option <?php if ($form['pensioner'] === 'N')
                        echo 'selected="selected"'; ?> value="N">No
                      </option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon">LGBTQ</span>
                    <select class="form-control" name="lgbtq" required>
                      <option <?php if ($form['lgbtq'] === 'Y')
                        echo 'selected="selected"'; ?> value="Y">Yes</option>
                      <option <?php if ($form['lgbtq'] === 'N')
                        echo 'selected="selected"'; ?> value="N">No</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <!-- Section to display related family members -->
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <strong>
                      <i>
                        <p class="mb-0">II. FAMILY MEMBERS</p>
                      </i>
                    </strong>

                    <div class="panel-body">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Full Name</th>
                            <th class="text-center">Relationship</th>
                            <th class="text-center">Age</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if (!empty($family_members)): ?>
                            <?php foreach ($family_members as $index => $member): ?>
                              <tr>
                                <td class="text-center">
                                  <?php echo $index + 1; ?>
                                </td>
                                <td class="text-center">
                                  <?php echo remove_junk($member['name']); ?>
                                </td>
                                <td class="text-center">
                                  <?php echo remove_junk($member['relation']); ?>
                                </td>
                                <td class="text-center">
                                  <?php echo remove_junk($member['age']); ?>
                                </td>

                              </tr>
                            <?php endforeach; ?>
                          <?php else: ?>
                            <tr>
                              <td colspan="5" class="text-center">No family members found.</td>
                            </tr> <?php endif; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <strong>
                        <i>
                          <p class="mb-0">III. CLASSIFICATION</p>
                        </i>
                      </strong>
                      <div class="input-group">
                        <span class="input-group-addon">Classification</span>
                        <textarea class="form-control" name="classification"
                          required><?php echo remove_junk($form['classification']); ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <strong>
                        <i>
                          <p class="mb-0">II. PROBLEMS</p>
                        </i>
                      </strong>
                      <div class="input-group">
                        <span class="input-group-addon">Problems</span>
                        <textarea class="form-control" name="problems"
                          required><?php echo remove_junk($form['problems']); ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- -------------------Emergency Contact Section-------------------------------- -->
                <div class="row">
                  <div class="col-md-12">
                    <strong>
                      <i>
                        <p class="mb-0">III. IN CASE OF EMERGENCY</p>
                      </i>
                    </strong>
                    <div id="emergency-contact-container">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon">Contact Name</span>
                              <input type="text" class="form-control" name="emergency_contact_name"
                                value="<?php echo remove_junk($emergency_contact['name']); ?>" required>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon">Relationship</span>
                              <input type="text" class="form-control" name="emergency_contact_relationship"
                                value="<?php echo remove_junk($emergency_contact['relation']); ?>" required>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon">Contact Number</span>
                              <input type="text" class="form-control" name="emergency_contact_number"
                                value="<?php echo remove_junk($emergency_contact['contact_number']); ?>" required>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon">Address</span>
                              <input type="text" class="form-control" name="emergency_contact_address"
                                value="<?php echo remove_junk($emergency_contact['address']); ?>" required>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>

            </div>
            <div class="form-group clearfix">
              <button type="submit" name="update_form" class="btn btn-primary">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>