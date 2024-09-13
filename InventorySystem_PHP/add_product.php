<?php
// Set the page title
$page_title = 'Add Product';

// Include necessary files
require_once('includes/load.php');
$barangays = find_all_barangays();
// Check what level user has permission to view this page
page_require_level(3);

// Fetch all categories and photos
$all_categories = find_all('categories');
$all_photo = find_all('media');

// Check if the form is submitted
if (isset($_POST['add_product'])) {
  // Required fields for validation
  $req_fields = array('last-name', 'first-name', 'middle-name', 'sex', 'date-of-birth', 'place-of-birth', 'address', 'barangay_id', 'educational-attainment', 'civil-status', 'religion', 'contact-number', 'email-address', 'pantawid-beneficiary', 'lgbtq', 'Indigenous_Person', 'status', 'pensioner');

  // Validate the required fields
  validate_fields($req_fields);

  // If no errors, proceed to process the form data
  if (empty($errors)) {
    // Generate the case number
    $current_year_month = date('Y-m');
    $last_case_number_query = "SELECT case_number FROM application_forms WHERE case_number LIKE '{$current_year_month}-%' ORDER BY case_number DESC LIMIT 1";
    $last_case_number_result = $db->query($last_case_number_query);
    $last_case_number = $db->fetch_assoc($last_case_number_result)['case_number'];

    if ($last_case_number) {
      $last_number = (int) substr($last_case_number, -5);
      $new_number = str_pad($last_number + 1, 5, '0', STR_PAD_LEFT);
    } else {
      $new_number = '00001';
    }

    $case_number = "{$current_year_month}-{$new_number}";

    // Sanitize and escape form inputs

    $last_name = remove_junk($db->escape($_POST['last-name']));
    $first_name = remove_junk($db->escape($_POST['first-name']));
    $middle_name = remove_junk($db->escape($_POST['middle-name']));
    $extension_name = remove_junk($db->escape($_POST['extension-name']));
    $classification = remove_junk($db->escape($_POST['classification']));
    $remarks = remove_junk($db->escape($_POST['remarks']));
    $problems = remove_junk($db->escape($_POST['problems']));
    $date_of_birth = remove_junk($db->escape($_POST['date-of-birth']));
    $status = remove_junk($db->escape($_POST['status']));
    $place_of_birth = remove_junk($db->escape($_POST['place-of-birth']));
    $address = remove_junk($db->escape($_POST['address']));
    $barangay_id = remove_junk($db->escape($_POST['barangay_id']));
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
    $Indigenous_Person = remove_junk($db->escape($_POST['Indigenous_Person']));
    $pensioner = remove_junk($db->escape($_POST['pensioner']));
    $sex = remove_junk($db->escape($_POST['sex']));

    $birthDate = DateTime::createFromFormat('Y-m-d', $date_of_birth);
    if (!$birthDate || $birthDate->format('Y-m-d') !== $date_of_birth) {
      $session->msg('d', 'Invalid date of birth format.');
      redirect('add_product.php', false);
    }

    // Calculate age based on date of birth
    $today = new DateTime();
    $age = $today->diff($birthDate)->y;

    // Get the current date
    $date = make_date();

    // Sanitize and escape form inputs
    $classification = remove_junk($db->escape($_POST['classification']));
    $problems = remove_junk($db->escape($_POST['problems']));
    $remarks = remove_junk($db->escape($_POST['remarks']));


    // Construct the SQL query to insert data into the database
    $query = "INSERT INTO application_forms (";
    $query .= "case_number, last_name, first_name, middle_name, extension_name, age, sex, date_of_birth, place_of_birth, address, barangay_id, educational_attainment, civil_status, occupation, religion, company_agency, monthly_income, employment_status, contact_number, email_address, pantawid_beneficiary, lgbtq, Indigenous_Person, pensioner, classification, problems, remarks, status,  date";
    $query .= ") VALUES (";
    $query .= "'{$case_number}', '{$last_name}', '{$first_name}', '{$middle_name}', '{$extension_name}', '{$age}', '{$sex}', '{$date_of_birth}', '{$place_of_birth}', '{$address}', '{$barangay_id}', '{$educational_attainment}', '{$civil_status}', '{$occupation}', '{$religion}', '{$company_agency}', '{$monthly_income}', '{$employment_status}', '{$contact_number}', '{$email_address}', '{$pantawid_beneficiary}', '{$lgbtq}', '{$Indigenous_Person}', '{$pensioner}', '{$classification}', '{$problems}', '{$remarks}', '{$status}', '{$date}'";
    $query .= ")";
    $query .= " ON DUPLICATE KEY UPDATE last_name='{$last_name}'";

    // Execute the query and check if it was successful
    if ($db->query($query)) {
      // Get the last inserted ID
      $application_id = $db->insert_id();

      // Process family members
      if (isset($_POST['family'])) {
        foreach ($_POST['family'] as $family_member) {
          $family_name = !empty($family_member['name']) ? remove_junk($db->escape($family_member['name'])) : NULL;
          $family_relation = !empty($family_member['relation']) ? remove_junk($db->escape($family_member['relation'])) : NULL;
          $family_birthday = !empty($family_member['birthday']) ? remove_junk($db->escape($family_member['birthday'])) : NULL;
          $family_civil_status = !empty($family_member['civil_status']) ? remove_junk($db->escape($family_member['civil_status'])) : NULL;
          $family_education = !empty($family_member['education']) ? remove_junk($db->escape($family_member['education'])) : NULL;
          $family_occupation = !empty($family_member['occupation']) ? remove_junk($db->escape($family_member['occupation'])) : NULL;
          $family_monthly_income = !empty($family_member['monthly_income']) ? remove_junk($db->escape($family_member['monthly_income'])) : NULL;

          // Check if all fields are empty
          if ($family_name || $family_relation || $family_birthday || $family_civil_status || $family_education || $family_occupation || $family_monthly_income) {
            // Validate family member's birthday if provided
            if ($family_birthday) {
              $family_birthDate = DateTime::createFromFormat('Y-m-d', $family_birthday);
              if (!$family_birthDate || $family_birthDate->format('Y-m-d') !== $family_birthday) {
                $session->msg('d', 'Invalid family member birthday format.');
                redirect('add_product.php', false);
              }
              // Calculate family member's age based on birthday
              $family_age = $today->diff($family_birthDate)->y;
            } else {
              $family_age = NULL;
            }

            $family_query = "INSERT INTO family_members (application_id, name, relation, age, birthday, civil_status, education, occupation, monthly_income) VALUES ('{$application_id}', '{$family_name}', '{$family_relation}', '{$family_age}', '{$family_birthday}', '{$family_civil_status}', '{$family_education}', '{$family_occupation}', '{$family_monthly_income}')";
            $db->query($family_query);
          }
        }
      }

      // Process emergency contact
      if (!empty($_POST['emergency']['name']) && !empty($_POST['emergency']['relation']) && !empty($_POST['emergency']['address']) && !empty($_POST['emergency']['contact'])) {
        $emergency_name = remove_junk($db->escape($_POST['emergency']['name']));
        $emergency_relation = remove_junk($db->escape($_POST['emergency']['relation']));
        $emergency_address = remove_junk($db->escape($_POST['emergency']['address']));
        $emergency_contact = remove_junk($db->escape($_POST['emergency']['contact']));

        $emergency_query = "INSERT INTO emergency_contacts (application_id, name, relation, address, contact_number) VALUES ('{$application_id}', '{$emergency_name}', '{$emergency_relation}', '{$emergency_address}', '{$emergency_contact}')";
        $db->query($emergency_query);
      }

      // Success message and redirect
      $session->msg('s', "Data added ");
      redirect('add_product.php', false);
    } else {
      // Failure message and redirect
      $session->msg('d', ' Sorry failed to add!');
      redirect('add_product.php', false);
    }
  } else {
    // Display validation errors and redirect
    $session->msg("d", $errors);
    redirect('add_product.php', false);
  }
}
?>
<?php include_once('layouts/header.php'); ?>

<!-- Display messages -->
<div class="row">
  <div class="col-md-8">
    <?php echo display_msg($msg); ?>
  </div>
</div>

<!-- Form container -->
<div class="row">
  <div class="col-md-12">
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

            <!-- Headline Identification Name -->
            <div class="row d-flex align-items-center">
              <div class="col-md-10">
                <strong>
                  <i>
                    <p class="mb-0">I. IDENTIFYING INFORMATION</p>
                  </i>
                </strong>
              </div>
            </div>
            <!-- ------------------------PERSONAL INFORMATION -------------------------- -->

            <!-- Full Name, Age, and Sex input fields in one row -->
            <div class="row">

              <!-- Last Name -->
              <div class="col-md-3">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon">Surname</span>
                    <input type="text" class="form-control" name="last-name" placeholder="Last Name" required>
                  </div>
                </div>
              </div>

              <!-- First Name -->
              <div class="col-md-3">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon">First</span>
                    <input type="text" class="form-control" name="first-name" placeholder="First Name" required>
                  </div>
                </div>
              </div>

              <!-- Middle Name -->
              <div class="col-md-3">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon">Middle</span>
                    <input type="text" class="form-control" name="middle-name" placeholder="Middle Name">
                  </div>
                </div>
              </div>

              <!-- Extension Name -->
              <div class="col-md-3">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon">Extension</span>
                    <input type="text" class="form-control" name="extension-name" placeholder="Extension Name">
                  </div>
                </div>
              </div>


            </div>

            <!-- Date of Birth & Place of Birth -->
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"> Sex</span>
                    <select class="form-control sex" name="sex" required>
                      <option value="">Select Sex</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                      <option value="Other">Other</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> Date of Birth</span>
                    <input type="date" class="form-control date-placeholder" name="date-of-birth"
                      placeholder="Date of Birth" required>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i> Place of Birth</span>
                    <input type="text" class="form-control" name="place-of-birth" required>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i> Status</span>
                    <select class="form-control" name="status" required>
                      <option value="">Select Status</option>
                      <option value="new">New</option>
                      <option value="renewal">Renewal</option>
                      <option value="terminated">Terminated</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <!-- Address input fields in one row -->
            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i> Address</span>
                    <input type="text" class="form-control" name="address" required>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i> Barangay</span>
                      <select class="form-control" name="barangay_id" required>
                        <option value="">Select Barangay</option>
                        <?php foreach ($barangays as $barangay): ?>
                          <?php if ($barangay['name'] !== 'Dasmariñas (City)'): ?>
                            <option value="<?php echo $barangay['id']; ?>"><?php echo $barangay['name']; ?></option>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>



            <!-- Educational Attainment, Civil Status input, Religion  -->
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-education"></i> Educational
                      Attainment</span>
                    <select class="form-control" name="educational-attainment" required>
                      <option value="">Select</option>
                      <option value="no education">No Education</option>
                      <option value="elementary level">Elementary Level</option>
                      <option value="elementary graduate">Elementary Graduate</option>
                      <option value="high school level">High School Level</option>
                      <option value="high school graduate">High School Graduate</option>
                      <option value="vocational/tvet">Vocational/TVET</option>
                      <option value="college level">College Level</option>
                      <option value="college graduate">College Graduate</option>
                      <option value="post-graduate">Post-Graduate</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"></i> Civil Status</span>
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
              <div class="col-md-3">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-book"></i> Religion</span>
                    <input type="text" class="form-control" name="religion">
                  </div>
                </div>
              </div>
            </div>

            <!-- Occupation, Agency, Montly Income -->
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i> Occupation</span>
                    <input type="text" class="form-control" name="occupation">
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-tower"></i> Company</span>
                    <input type="text" class="form-control" name="company-agency">
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i> Monthly Income</span>
                    <select class="form-control" name="monthly-income">
                      <option value="">Select</option>
                      <option value="minimum wage and below">Minimum Wage and Below</option>
                      <option value="minimum wage +1 to Php 20833">(Minimum Wage +1) to Php 20833</option>
                      <option value="Php 20834 and above">Php 20834 and Above</option>
                    </select>
                  </div>
                </div>
              </div>

            </div>

            <!-- Employment Status, Contact Number -->
            <div class="row">


              <div class="col-md-4">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i> Employment
                      Status</span>
                    <select class="form-control employment-status" name="employment-status">
                      <option value="">Select Status</option>
                      <option value="Employed">Employed</option>
                      <option value="Self-employed">Self-employed</option>
                      <option value="Not employed">Not employed</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i> Contact Number</span>
                    <input type="text" class="form-control" name="contact-number">
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i> Email Address</span>
                    <input type="email" class="form-control" name="email-address">
                  </div>
                </div>
              </div>
            </div>

            <!-- Pantawid Beneficiary, LGBTQ -->
            <div class="row">


              <div class="col-md-3">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"> Pantawid Beneficiary</span>
                    <select class="form-control" name="pantawid-beneficiary" required>
                      <option value="">Select</option>
                      <option value="Y">Yes</option>
                      <option value="N">No</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon">Pensioner</span>
                    <select class="form-control" name="pensioner" required>
                      <option value="">Select</option>
                      <option value="Y">Yes</option>
                      <option value="N">No</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"> LGBTQ+</span>
                    <select class="form-control" name="lgbtq" required>
                      <option value="">Select</option>
                      <option value="Y">Yes</option>
                      <option value="N">No</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"> Indigenous Person</span>
                    <select class="form-control" name="Indigenous_Person" required>
                      <option value="">Select</option>
                      <option value="Y">Yes</option>
                      <option value="N">No</option>
                    </select>
                  </div>
                </div>
              </div>

            </div>

            <!-- -------------------Family Members Section-------------------------------- -->
            <div class="row">
              <div class="col-md-12">
                <strong>
                  <i>
                    <p class="mb-0">II. FAMILY COMPOSITION</p>
                  </i>
                </strong>
                <div id="family-members-container">
                  <!-- Family member template -->
                  <div class="family-member">
                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon"> Name</span>
                            <input type="text" class="form-control" name="family[0][name]" placeholder="Full Name">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon"> Relationship</span>
                            <input type="text" class="form-control" name="family[0][relation]"
                              placeholder="Relationship">
                          </div>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon"> Birthday</span>
                            <input type="date" class="form-control" name="family[0][birthday]" placeholder="Birthday">
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- -------- ROW 2 --------- -->
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon"> Civil Status</span>
                            <select class="form-control" name="family[0][civil_status]">
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
                            <span class="input-group-addon"> Education</span>
                            <input type="text" class="form-control" name="family[0][education]"
                              placeholder="Educational Attainment">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon"> Occupation</span>
                            <input type="text" class="form-control" name="family[0][occupation]"
                              placeholder="Occupation">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon">Income</span>
                            <input type="number" class="form-control" name="family[0][monthly_income]"
                              placeholder="Income">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-1">
                        <!-- Empty column for spacing or future use -->
                      </div>
                    </div>
                  </div>
                </div>
                <button type="button" id="add-family-member" class="btn btn-primary">Add Family Member</button>
              </div>
            </div>

            <!-- ------------------------- Classification Section -------------------------------- -->
            <br>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="classification"> III. Classification/ circumstances of being a solo parent Dahilan bakit
                    naging solo parent</label>
                  <select class="form-control" id="classification" name="classification" required>
                    <option value="">Select</option>
                    <option value="a1. Consequence of rape">a1. Consequence of rape</option>
                    <option value="a2. Widow/ widower">a2. Widow/ widower</option>
                    <option value="a3. Spouse of PDL">a3. Spouse of PDL</option>
                    <option value="a4. Spouse of PWD">a4. Spouse of PWD</option>
                    <option value="a5. Separated of de facto separated">a5. Separated of de facto separated</option>
                    <option value="a6. Anulled">a6. Anulled</option>
                    <option value="a7. abandoned">a7. abandoned</option>
                    <option value="b. Spouse/Relative of OFW">b. Spouse/Relative of OFW</option>
                    <option value="c. Unmarried Person">c. Unmarried Person</option>
                    <option value="d. Legal guardian, Adpotive or Foster Parent">d. Legal guardian, Adpotive or Foster
                      Parent</option>
                    <option value="e. Relative">e. Relative</option>
                    <option value="f. Pregnant woman">f. Pregnant woman</option>
                  </select>
                </div>
              </div>
            </div>

            <!-- Problems Section -->
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="problems">IV. Needs/problems as a solo parent (Kinakailangan/problema bilang isang solo
                    parent?)</label>
                  <textarea class="form-control" id="problems" name="problems"
                    placeholder="Enter problems details"></textarea>
                </div>
              </div>
            </div>


            <!-- -------------------In Case of Emergency Section-------------------------------- -->

            <div class="row">
              <div class="col-md-12">
                <strong>
                  <i>
                    <p class="mb-0">V. IN CASE OF EMERGENCY</p>
                  </i>
                </strong>
              </div>
            </div>

            <!-- Row 1: Name, Relationship -->
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon">Name</span>
                    <input type="text" class="form-control" id="emergency-name" name="emergency[name]"
                      placeholder="Full Name">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon">Relationship</span>
                    <input type="text" class="form-control" id="emergency-relation" name="emergency[relation]"
                      placeholder="Relationship">
                  </div>
                </div>
              </div>
            </div>

            <!-- Row 2: Address, Contact Number -->
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon">Address</span>
                    <input type="text" class="form-control" id="emergency-address" name="emergency[address]"
                      placeholder="Address">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon">Contact Number</span>
                    <input type="text" class="form-control" id="emergency-contact" name="emergency[contact]"
                      placeholder="Contact Number">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="remarks">Remarks</label>
                  <textarea class="form-control" id="remarks" name="remarks"
                    placeholder="Enter any remarks here"></textarea>
                </div>
              </div>
            </div>

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
  // Add event listener to the "Add Family Member" button
  document.getElementById('add-family-member').addEventListener('click', function () {
    // Get the container where family members are added
    var container = document.getElementById('family-members-container');
    // Get the current number of family members to ensure correct indexing
    var index = container.querySelectorAll('.family-member').length;
    // Template for a new family member form
    var template = `
      <div class="family-member">
        <div class="row">
          <div class="col-md-12">
        <h5 class="family-order">Family Member ${index + 1}</h5>
          </div>
          <div class="col-md-5">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"> Name</span>
            <input type="text" class="form-control" name="family[${index}][name]" placeholder="Full Name">
          </div>
        </div>
          </div>
          <div class="col-md-4">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"> Relationship</span>
            <input type="text" class="form-control" name="family[${index}][relation]" placeholder="Relationship">
          </div>
        </div>
          </div>
          <div class="col-md-3">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"> Birthday</span>
            <input type="date" class="form-control" name="family[${index}][birthday]" placeholder="Birthday">
          </div>
        </div>
          </div>
        </div>
        <!-- -----------------------ROW 2 ------------------ -->
        <div class="row">
          <div class="col-md-3">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"> Civil Status</span>
            <select class="form-control" name="family[${index}][civil_status]">
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
            <span class="input-group-addon"> Education</span>
            <input type="text" class="form-control" name="family[${index}][education]" placeholder="Educational Attainment">
          </div>
        </div>
          </div>
          <div class="col-md-3">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"> Occupation</span>
            <input type="text" class="form-control" name="family[${index}][occupation]" placeholder="Occupation">
          </div>
        </div>
          </div>
          <div class="col-md-2">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon">Income</span>
            <input type="number" class="form-control" name="family[${index}][monthly_income]" placeholder="Income">
          </div>
        </div>
          </div>
          <div class="col-md-1">
        <!-- Button to remove the family member -->
        <button type="button" class="btn btn-danger remove-family-member">Remove</button>
          </div>
        </div>
      </div>
    `;
    // Insert the new family member form into the container
    container.insertAdjacentHTML('beforeend', template);
    // Update the order of family members
    updateFamilyOrder();
  });

  // Add event listener to the container to handle removing family members
  document.getElementById('family-members-container').addEventListener('click', function (event) {
    // Check if the clicked element is a "Remove" button
    if (event.target.classList.contains('remove-family-member')) {
      // Remove the closest parent element with the class "family-member"
      event.target.closest('.family-member').remove();
      // Update the order of remaining family members
      updateFamilyOrder();
    }
  });

  // Function to update the order of family members
  function updateFamilyOrder() {
    // Get all family member elements
    var familyMembers = document.querySelectorAll('.family-member');
    // Iterate over each family member to update their order and name attributes
    familyMembers.forEach(function (member, index) {
      // Update the order text
      var orderText = member.querySelector('.family-order');
      orderText.textContent = `Family Member ${index + 1}`;

      // Update name attributes to ensure correct indexing
      member.querySelectorAll('input, select').forEach(function (input) {
        var name = input.getAttribute('name');
        if (name) {
          // Replace the index in the name attribute with the new index
          var newName = name.replace(/\[\d+\]/, `[${index}]`);
          input.setAttribute('name', newName);
        }
      });
    });
  }
</script>