<?php
$page_title = 'Add Product';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(2);
$all_categories = find_all('categories');
$all_photo = find_all('media');

if (isset($_POST['add_product'])) {
  $req_fields = array('case-number', 'full-name', 'age', 'sex', 'date-of-birth', 'place-of-birth', 'address', 'educational-attainment', 'civil-status', 'religion', 'contact-number', 'email-address', 'pantawid-beneficiary', 'lgbtq');
  validate_fields($req_fields);
  if (empty($errors)) {
    $case_number = remove_junk($db->escape($_POST['case-number']));
    $full_name = remove_junk($db->escape($_POST['full-name']));
    $age = remove_junk($db->escape($_POST['age']));
    $sex = remove_junk($db->escape($_POST['sex']));
    $date_of_birth = remove_junk($db->escape($_POST['date-of-birth']));
    $place_of_birth = remove_junk($db->escape($_POST['place-of-birth']));
    $address = remove_junk($db->escape($_POST['address']));
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

    $date = make_date();

    $query = "INSERT INTO application_forms (";
    $query .= "case_number, full_name, age, sex, date_of_birth, place_of_birth, address, educational_attainment, civil_status, occupation, religion, company_agency, monthly_income, employment_status, contact_number, email_address, pantawid_beneficiary, lgbtq, date";
    $query .= ") VALUES (";
    $query .= "'{$case_number}','{$full_name}', '{$age}', '{$sex}', '{$date_of_birth}', '{$place_of_birth}', '{$address}', '{$educational_attainment}', '{$civil_status}', '{$occupation}', '{$religion}', '{$company_agency}', '{$monthly_income}', '{$employment_status}', '{$contact_number}', '{$email_address}', '{$pantawid_beneficiary}', '{$lgbtq}',  '{$date}'";
    $query .= ")";
    $query .= " ON DUPLICATE KEY UPDATE full_name='{$full_name}'";

    if ($db->query($query)) {
      $application_form_id = $db->insert_id(); // Get the ID of the newly inserted application form

      // Insert family members
      foreach ($_POST['family-member-name'] as $index => $name) {
        $family_name = remove_junk($db->escape($name));
        $relationship = remove_junk($db->escape($_POST['family-member-relationship'][$index]));
        $family_age = remove_junk($db->escape($_POST['family-member-age'][$index]));
        $family_date_of_birth = remove_junk($db->escape($_POST['family-member-birthday'][$index]));
        $family_civil_status = remove_junk($db->escape($_POST['family-member-civil-status'][$index]));
        $family_education = remove_junk($db->escape($_POST['family-member-education'][$index]));
        $family_occupation = remove_junk($db->escape($_POST['family-member-occupation'][$index]));
        $family_monthly_income = remove_junk($db->escape($_POST['family-member-monthly-income'][$index]));

        // Insert the family member with the application_form_id
        $family_query = "INSERT INTO family_members (application_form_id, name, relationship, age, date_of_birth, civil_status, educational_attainment, occupation, monthly_income) VALUES (";
        $family_query .= "'{$application_form_id}', '{$family_name}', '{$relationship}', '{$family_age}', '{$family_date_of_birth}', '{$family_civil_status}', '{$family_education}', '{$family_occupation}', '{$family_monthly_income}')";
        $db->query($family_query);
      }

      $session->msg('s', "Data added ");
      redirect('add_product.php', false);
    } else {
      $session->msg('d', ' Sorry failed to add!');
      redirect('add_product.php', false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('add_product.php', false);
  }
}
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-8">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="row">
  <div class="col-md-8">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>APPLICATION FORM FOR SOLO PARENT</span>
        </strong>
      </div>
      <div class="panel-body">
        <div class="col-md-12">
          <!-- Form to add a new product -->
          <form method="post" action="add_product.php" class="clearfix">

            <!-- HEADLINE Identificaiton Name -->
            <div class="row d-flex align-items-center">
              <div class="col-md-10">
                <strong>
                  <i>
                    <p class="mb-0">I. IDENTIFYING INFORMATION</p>
                  </i>
                </strong>
              </div>

            </div>

            <!-- Full Name, Age, and Sex input fields in one row -->
            <div class="row">
              <div class="col-md-2">
                <div class="form-group mb-2">
                  <div class="input-group">
                    <input type="text" class="form-control" name="case-number" placeholder="Case Number" required>
                  </div>

                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input type="text" class="form-control" name="full-name" placeholder="Full Name" required>
                  </div>
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <div class="input-group">

                    <input type="number" class="form-control" name="age" placeholder="Age" required>
                  </div>
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <select class="form-control sex" name="sex" required>
                    <option value="">Select Sex</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                  </select>
                </div>
              </div>

            </div>

            <!-- Date of Birth & Place of Birth -->
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> Date of Birth</span>
                    <input type="date" class="form-control date-placeholder" name="date-of-birth"
                      placeholder="Date of Birth" required>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                    <input type="text" class="form-control" name="place-of-birth" placeholder="Place of Birth" required>
                  </div>
                </div>
              </div>
            </div>

            <!--Address input fields in one row  -->
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                    <input type="text" class="form-control" name="address" placeholder="Address">
                  </div>
                </div>
              </div>
            </div>
            <!--Educational Attainment and Civil Status input  -->
            <div class="row">
              <div class="col-md-10">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span>
                    <input type="text" class="form-control" name="educational-attainment"
                      placeholder="Educational Attainment">
                  </div>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <select class="form-control civil-status" name="civil-status" required>
                    <option value="">Select Civil Status</option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Divorced">Divorced</option>
                    <option value="Widowed">Widowed</option>
                  </select>
                </div>
              </div>
            </div>

            <!-- Occupation, and Religion -->
            <div class="row">
              <div class="col-md-10">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
                    <input type="text" class="form-control" name="occupation" placeholder="Occupation">
                  </div>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <div class="input-group">

                    <input type="text" class="form-control" name="religion" placeholder="Religion">
                  </div>
                </div>
              </div>
            </div>

            <!-- Company/Agency and monthly-income -->
            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-tower"></i></span>
                    <input type="text" class="form-control" name="company-agency" placeholder="Company/Agency">
                  </div>
                </div>
              </div>

              <div class="col-md-5">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                    <input type="number" class="form-control" name="monthly-income" placeholder="Input Monthly Income">
                  </div>
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <select class="form-control employment-status" name="employment-status">
                    <option value="">Select Employment Status</option>
                    <option value="Employed">Employed</option>
                    <option value="Self-employed">Self-employed</option>
                    <option value="Not employed">Not employed</option>
                  </select>
                </div>
              </div>
            </div>



            <!-- Contact No. and Email Address  -->
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                    <input type="text" class="form-control " name="contact-number" placeholder="Contact Number">
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input type="email" class="form-control" name="email-address" placeholder="Email Address">
                  </div>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <div class="input-group">
                    <select class="form-control" name="pantawid-beneficiary" required>
                      <option value="">Pantawid Beneficiary</option>
                      <option value="Y">Yes</option>
                      <option value="N">No</option>
                    </select>
                  </div>

                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <div class="input-group">
                    <select class="form-control" name="lgbtq" required>
                      <option value="">LGBTQ+</option>
                      <option value="Y">Yes</option>
                      <option value="N">No</option>
                    </select>
                  </div>

                </div>
              </div>
            </div>

            <!-- Pantawid Beneficiary, and  LGBTQ+ selection field -->
            <div class="row">

            </div>
        </div>

        <!-- Family Composition Section -->
        <div class="row">
          <div class="col-md-12">
            <strong>
              <i>
                <p class="mb-0">II. FAMILY COMPOSITION</p>
              </i>
            </strong>
          </div>
        </div>
        <div id="family-composition-section">
          <div class="family-member">
            <!-- Family: Name, Relationship, and Age -->
            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input type="text" class="form-control" name="family-member-name[]"
                      placeholder="Input Name (First, Middle, Last)">
                  </div>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-heart"></i></span>
                    <input type="text" class="form-control" name="family-member-relationship[]"
                      placeholder="Relationship">
                  </div>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-hourglass"></i></span>
                    <input type="number" class="form-control" name="family-member-age[]" placeholder="Age">
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    <input type="date" class="form-control" name="family-member-birthday[]" id="family-member-birthday"
                      placeholder="Birthday (mm/dd/yy)">
                  </div>
                </div>
              </div>
            </div>
            <!-- Family: BDAY, Civil Status, Educational Attainment, Occupation, Income -->
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                    <select class="form-control" name="family-member-civil-status[]">
                      <option value="">Civil Status</option>
                      <option value="Single">Single</option>
                      <option value="Married">Married</option>
                      <option value="Divorced">Divorced</option>
                      <option value="Widowed">Widowed</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span>
                    <input type="text" class="form-control" name="family-member-education[]"
                      placeholder="Education Attainment">
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
                    <input type="text" class="form-control" name="family-member-occupation[]" placeholder="Occupation">
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                    <input type="number" class="form-control" name="family-member-monthly-income[]"
                      placeholder="Monthly Income">
                  </div>
                </div>
              </div>
            </div>
            <!-- Remove button, initially hidden -->
            <div class="row">
              <div class="col-md-12 text-right">
                <button type="button" class="btn btn-danger remove-family-member" style="display: none;">Remove</button>
              </div>
            </div>
            <br>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-right">
            <button type="button" id="add-family-member" class="btn btn-primary">Add Family Member</button>
          </div>
        </div>
        <br>
        <!-- Submit button -->
        <div class="row">
          <div class="col-md-12 text-right">
            <button type="submit" name="add_product" class="btn btn-danger">Submit</button>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
<?php include_once('layouts/footer.php'); ?>

<script>
  document.getElementById('add-family-member').addEventListener('click', function () {
    var familyMemberSection = document.querySelector('.family-member');
    var newFamilyMember = familyMemberSection.cloneNode(true);

    // Clear the values of the cloned inputs
    var inputs = newFamilyMember.querySelectorAll('input, select');
    inputs.forEach(function (input) {
      input.value = '';
    });

    // Show the remove button in the new family member section
    newFamilyMember.querySelector('.remove-family-member').style.display = 'inline-block';

    // Append the new family member section
    var hr = document.createElement('hr');
    document.getElementById('family-composition-section').appendChild(hr);
    document.getElementById('family-composition-section').appendChild(newFamilyMember);

    // Add event listener to the new remove button
    newFamilyMember.querySelector('.remove-family-member').addEventListener('click', function () {
      newFamilyMember.previousElementSibling.remove(); // Remove the preceding <hr> element
      newFamilyMember.remove();
    });
  });

  document.querySelector('form').addEventListener('submit', function (event) {
    var requiredFields = document.querySelectorAll('input[required], select[required]');
    var allFilled = true;

    requiredFields.forEach(function (field) {
      if (!field.value) {
        allFilled = false;
        field.classList.add('is        git config --global user.name
        git config--global user.email - invalid');
      } else {
        field.classList.remove('is-invalid');
      }
    });

    if (!allFilled) {
      alert('Please fill in all required fields.');
      event.preventDefault();
    }
  });

  // No need to add even
</script>