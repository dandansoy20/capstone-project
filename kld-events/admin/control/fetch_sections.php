<?php
include('./control/db.php');

if (isset($_GET['program']) && isset($_GET['yearLevel'])) {
    $program = $_GET['program'];
    $yearLevel = $_GET['yearLevel'];

    $query = "SELECT * FROM section_tbl WHERE course_id = '$program' AND year_level = '$yearLevel'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo '<optgroup label="Program ' . $program . ' - Year ' . $yearLevel . '">';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row['section_id'] . '">' . $row['section_name'] . '</option>';
        }
        echo '</optgroup>';
    } else {
        echo '<option value="">No sections available</option>';
    }
}
