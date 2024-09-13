<?php
require_once('includes/load.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $barangay_id = $_POST['barangay'];

    $sql = "SELECT af.id, af.case_number, af.first_name, af.middle_name, af.last_name, af.extension_name, af.age, af.sex, af.date_of_birth, af.place_of_birth, 
                   af.address, af.pensioner, af.barangay_id, af.educational_attainment, af.civil_status, af.occupation, af.religion, af.company_agency, 
                   af.monthly_income, af.employment_status, af.contact_number, af.email_address, af.pantawid_beneficiary, af.lgbtq, af.date, af.classification, 
                   af.problems, af.created_at, af.Indigenous_Person, af.remarks, af.status, b.name AS barangay, 
                   fm.name AS family_member_name, fm.relation AS family_member_relation, fm.age AS family_member_age, fm.birthday AS family_member_birthday, 
                   fm.civil_status AS family_member_civil_status, fm.education AS family_member_education, fm.occupation AS family_member_occupation, 
                   fm.monthly_income AS family_member_monthly_income
            FROM application_forms af
            LEFT JOIN barangays b ON af.barangay_id = b.id
            LEFT JOIN family_members fm ON af.id = fm.application_id
            ORDER BY af.id, fm.id";

    if ($barangay_id != 'all') {
        $sql .= " WHERE af.barangay_id = " . $db->escape((int) $barangay_id);
    }

    $results = find_by_sql($sql);

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename="application_forms.csv"');

    $output = fopen('php://output', 'w');

    // Set header
    fputcsv($output, [
        'Case Number',
        'First Name',
        'Middle Name',
        'Last Name',
        'Extension Name',
        'Age',
        'Sex',
        'Date of Birth',
        'Place of Birth',
        'Address',
        'Pensioner',
        'Barangay ID',
        'Barangay',
        'Educational Attainment',
        'Civil Status',
        'Occupation',
        'Religion',
        'Company/Agency',
        'Monthly Income',
        'Employment Status',
        'Contact Number',
        'Email Address',
        'Pantawid Beneficiary',
        'LGBTQ',
        'Date',
        'Classification',
        'Problems',
        'Created At',
        'Indigenous Person',
        'Remarks',
        'Status',
        'Family Member Name',
        'Family Member Relation',
        'Family Member Age',
        'Family Member Birthday',
        'Family Member Civil Status',
        'Family Member Education',
        'Family Member Occupation',
        'Family Member Monthly Income',
        'Age 0-6',
        'Age 7-22',
        'Above 22'
    ]);

    // Populate data
    $current_application_id = null;
    $children_0_6 = 0;
    $children_7_22 = 0;
    $children_above_22 = 0;

    foreach ($results as $result) {
        if ($current_application_id !== $result['id']) {
            // Output the main application form data and the first family member
            if ($current_application_id !== null) {
                fputcsv($output, [
                    $result['case_number'],
                    $result['first_name'],
                    $result['middle_name'],
                    $result['last_name'],
                    $result['extension_name'],
                    $result['age'],
                    $result['sex'],
                    $result['date_of_birth'],
                    $result['place_of_birth'],
                    $result['address'],
                    $result['pensioner'],
                    $result['barangay_id'],
                    $result['barangay'],
                    $result['educational_attainment'],
                    $result['civil_status'],
                    $result['occupation'],
                    $result['religion'],
                    $result['company_agency'],
                    $result['monthly_income'],
                    $result['employment_status'],
                    $result['contact_number'],
                    $result['email_address'],
                    $result['pantawid_beneficiary'],
                    $result['lgbtq'],
                    $result['date'],
                    $result['classification'],
                    $result['problems'],
                    $result['created_at'],
                    $result['Indigenous_Person'],
                    $result['remarks'],
                    $result['status'],
                    $result['family_member_name'],
                    $result['family_member_relation'],
                    $result['family_member_age'],
                    $result['family_member_birthday'],
                    $result['family_member_civil_status'],
                    $result['family_member_education'],
                    $result['family_member_occupation'],
                    $result['family_member_monthly_income'],
                    $children_0_6,
                    $children_7_22,
                    $children_above_22
                ]);
            }

            // Reset counters for new application
            $children_0_6 = 0;
            $children_7_22 = 0;
            $children_above_22 = 0;

            // Update counters for the first family member
            if ($result['family_member_age'] <= 6) {
                $children_0_6++;
            } elseif ($result['family_member_age'] <= 22) {
                $children_7_22++;
            } else {
                $children_above_22++;
            }

            $current_application_id = $result['id'];
        } else {
            // Update counters for additional family members
            if ($result['family_member_age'] <= 6) {
                $children_0_6++;
            } elseif ($result['family_member_age'] <= 22) {
                $children_7_22++;
            } else {
                $children_above_22++;
            }

            // Output additional family members in new rows
            fputcsv($output, [
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                $result['family_member_name'],
                $result['family_member_relation'],
                $result['family_member_age'],
                $result['family_member_birthday'],
                $result['family_member_civil_status'],
                $result['family_member_education'],
                $result['family_member_occupation'],
                $result['family_member_monthly_income'],
                '',
                '',
                ''
            ]);
        }
    }

    // Output the last application form data
    if ($current_application_id !== null) {
        fputcsv($output, [
            $result['case_number'],
            $result['first_name'],
            $result['middle_name'],
            $result['last_name'],
            $result['extension_name'],
            $result['age'],
            $result['sex'],
            $result['date_of_birth'],
            $result['place_of_birth'],
            $result['address'],
            $result['pensioner'],
            $result['barangay_id'],
            $result['barangay'],
            $result['educational_attainment'],
            $result['civil_status'],
            $result['occupation'],
            $result['religion'],
            $result['company_agency'],
            $result['monthly_income'],
            $result['employment_status'],
            $result['contact_number'],
            $result['email_address'],
            $result['pantawid_beneficiary'],
            $result['lgbtq'],
            $result['date'],
            $result['classification'],
            $result['problems'],
            $result['created_at'],
            $result['Indigenous_Person'],
            $result['remarks'],
            $result['status'],
            $result['family_member_name'],
            $result['family_member_relation'],
            $result['family_member_age'],
            $result['family_member_birthday'],
            $result['family_member_civil_status'],
            $result['family_member_education'],
            $result['family_member_occupation'],
            $result['family_member_monthly_income'],
            $children_0_6,
            $children_7_22,
            $children_above_22
        ]);
    }

    fclose($output);
    exit;
}
?>