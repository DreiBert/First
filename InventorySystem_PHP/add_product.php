<?php
// Set the page title
$page_title = 'Add Product';

// Include necessary files
require_once('includes/load.php');
$barangays = find_all_barangays();
// Check what level user has permission to view this page
page_require_level(2);

// Fetch all categories and photos
$all_categories = find_all('categories');
$all_photo = find_all('media');

// Check if the form is submitted
if (isset($_POST['add_product'])) {
  // Required fields for validation
  $req_fields = array('case-number', 'last-name', 'first-name', 'middle-name', 'sex', 'date-of-birth', 'place-of-birth', 'address', 'barangay_id', 'educational-attainment', 'civil-status', 'religion', 'contact-number', 'email-address', 'pantawid-beneficiary', 'lgbtq', 'pensioner');

  // Validate the required fields
  validate_fields($req_fields);

  // If no errors, proceed to process the form data
  if (empty($errors)) {
    // Sanitize and escape form inputs
    $case_number = remove_junk($db->escape($_POST['case-number']));
    $last_name = remove_junk($db->escape($_POST['last-name']));
    $first_name = remove_junk($db->escape($_POST['first-name']));
    $middle_name = remove_junk($db->escape($_POST['middle-name']));
    $full_name = "{$last_name}, {$first_name} {$middle_name}";
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

    // Validate date of birth
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

    // Construct the SQL query to insert data into the database
    $query = "INSERT INTO application_forms (";
    $query .= "case_number, full_name, age, sex, date_of_birth, place_of_birth, address, barangay_id, educational_attainment, civil_status, occupation, religion, company_agency, monthly_income, employment_status, contact_number, email_address, pantawid_beneficiary, lgbtq, pensioner, classification, problems, date";
    $query .= ") VALUES (";
    $query .= "'{$case_number}','{$full_name}', '{$age}', '{$sex}', '{$date_of_birth}', '{$place_of_birth}', '{$address}', '{$barangay_id}', '{$educational_attainment}', '{$civil_status}', '{$occupation}', '{$religion}', '{$company_agency}', '{$monthly_income}', '{$employment_status}', '{$contact_number}', '{$email_address}', '{$pantawid_beneficiary}', '{$lgbtq}', '{$pensioner}', '{$classification}', '{$problems}', '{$date}'";
    $query .= ")";
    $query .= " ON DUPLICATE KEY UPDATE full_name='{$full_name}'";

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
              <div class="col-md-3">
                <div class="form-group mb-2">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i> Case Number</span>
                    <input type="text" class="form-control" name="case-number" placeholder="Case Number" required>
                  </div>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon">Surname</span>
                    <input type="text" class="form-control" name="last-name" placeholder="Last Name" required>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"> First </span>
                    <input type="text" class="form-control" name="first-name" placeholder="First Name" required>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon">Middle</span>
                    <input type="text" class="form-control" name="middle-name" placeholder="Middle Name" required>
                  </div>
                </div>
              </div>


            </div>

            <!-- Date of Birth & Place of Birth -->
            <div class="row">
              <div class="col-md-2">
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
              <div class="col-md-7">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i> Place of Birth</span>
                    <input type="text" class="form-control" name="place-of-birth" placeholder="Place of Birth" required>
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
                    <input type="text" class="form-control" name="address" placeholder="Address">
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
                          <option value="<?php echo $barangay['id']; ?>"><?php echo $barangay['name']; ?></option>
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
                    <input type="text" class="form-control" name="educational-attainment"
                      placeholder="Educational Attainment">
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
                    <input type="text" class="form-control" name="religion" placeholder="Religion">
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
                    <input type="text" class="form-control" name="occupation" placeholder="Occupation">
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-tower"></i> Company</span>
                    <input type="text" class="form-control" name="company-agency" placeholder="Company/Agency">
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i> Monthly Income</span>
                    <input type="number" class="form-control" name="monthly-income" placeholder="Input Monthly Income">
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
                    <input type="text" class="form-control" name="contact-number" placeholder="Contact Number">
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i> Email Address</span>
                    <input type="email" class="form-control" name="email-address" placeholder="Email Address">
                  </div>
                </div>
              </div>
            </div>

            <!-- Pantawid Beneficiary, LGBTQ -->
            <div class="row">


              <div class="col-md-4">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-ok"></i> Pantawid Beneficiary</span>
                    <select class="form-control" name="pantawid-beneficiary" required>
                      <option value="">Pantawid Beneficiary</option>
                      <option value="Y">Yes</option>
                      <option value="N">No</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-ok"></i> Pensioner</span>
                    <select class="form-control" name="pensioner" required>
                      <option value="">Pensioner</option>
                      <option value="Y">Yes</option>
                      <option value="N">No</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-ok"></i> LGBTQ+</span>
                    <select class="form-control" name="lgbtq" required>
                      <option value="">LGBTQ+</option>
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
                    <p class="mb-0">II. FAMILY MEMBERS</p>
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
                  <label for="classification"> III. Classification</label>
                  <textarea class="form-control" id="classification" name="classification"
                    placeholder="Enter classification details"></textarea>
                </div>
              </div>
            </div>

            <!-- Problems Section -->
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="problems">IV. Problems</label>
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