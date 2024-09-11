<?php
require_once('includes/load.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $barangay_id = $_POST['barangay'];

    $sql = "SELECT af.id, af.case_number, af.full_name, af.address, b.name AS barangay, af.age, af.sex, af.contact_number, af.created_at 
          FROM application_forms af
          LEFT JOIN barangays b ON af.barangay_id = b.id";

    if ($barangay_id != 'all') {
        $sql .= " WHERE af.barangay_id = " . $db->escape((int) $barangay_id);
    }

    $results = find_by_sql($sql);

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename="application_forms.csv"');

    $output = fopen('php://output', 'w');

    // Set header
    fputcsv($output, ['ID', 'Case Number', 'Full Name', 'Address', 'Barangay', 'Age', 'Gender', 'Contact Number', 'Timestamp']);

    // Populate data
    foreach ($results as $result) {
        fputcsv($output, [
            $result['id'],
            $result['case_number'],
            $result['full_name'],
            $result['address'],
            $result['barangay'],
            $result['age'],
            $result['sex'],
            $result['contact_number'],
            $result['created_at']
        ]);
    }

    fclose($output);
    exit;
}
?>