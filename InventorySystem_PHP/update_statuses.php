<?php
require_once('includes/load.php');

// Function to update statuses
function update_statuses()
{
    global $db;

    // Get the current date
    $current_date = new DateTime();

    // Fetch all application forms
    $application_forms = find_all('application_forms');

    foreach ($application_forms as $form) {
        $date_of_birth = new DateTime($form['date_of_birth']);
        $next_birthday = clone $date_of_birth;
        $next_birthday->setDate($current_date->format('Y'), $date_of_birth->format('m'), $date_of_birth->format('d'));

        // If the next birthday is in the past, set it to the next year
        if ($next_birthday < $current_date) {
            $next_birthday->modify('+1 year');
        }

        // Calculate the date 3 months before the next birthday
        $three_months_before_birthday = clone $next_birthday;
        $three_months_before_birthday->modify('-3 months');

        // Determine the new status
        $new_status = $form['status'];
        if ($current_date >= $three_months_before_birthday && $current_date < $next_birthday) {
            $new_status = 'renewal';
        } elseif ($current_date >= $next_birthday) {
            $new_status = 'terminated';
        }

        // Update the status if it has changed
        if ($new_status !== $form['status']) {
            $sql = "UPDATE application_forms SET status='{$db->escape($new_status)}' WHERE id='{$db->escape($form['id'])}'";
            $db->query($sql);
        }
    }
}

// Run the update function
update_statuses();
?>