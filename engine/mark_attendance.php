<?php
// Start the session
session_start();
// Include your database connection file
include_once "database.php";
// Check if the form is submitted
if (isset($_POST['save'])) {
    // Get the school ID and class ID from the session
    $schoolId = $_SESSION["school_id"];
    $classid = $_SESSION["class_id"];
    // Get the selected student registration numbers and checkboxes
    $studentNos = $_POST['studentNo'];
    $check = $_POST['check'];
    // Check if attendance has already been marked for the current date
    $dateTaken = date("Y-m-d"); // Get the current date
    $query = "SELECT * FROM attendance WHERE class_id = '$classid' AND school_id = '$schoolId' AND dateTimeTaken = '$dateTaken' AND status = '1'";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);

    if ($count > 0) {
        $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>Attendance has already been marked for today!</div>";
    } else {
        // Prepare the SQL statement for marking attendance
        $sql = "INSERT INTO attendance (class_id, school_id, studentNo, status) VALUES (?, ?, ?, '1')";
        $stmt = $conn->prepare($sql);

        // Bind the parameters
        $stmt->bind_param("sss", $classid, $schoolId, $studentNo);

        // Iterate over the selected students and mark their attendance
        foreach ($studentNos as $studentNo) {
            // Check if the student is checked in the checkboxes
            $isChecked = in_array($studentNo, $check) ? true : false;

            // Mark attendance for the student
            $studentNo = $conn->real_escape_string($studentNo);
            $stmt->execute();
        }

        // Close the prepared statement
        $stmt->close();

        // Provide a status message
        $statusMsg = "<div class='alert alert-success' style='margin-right:700px;'>Attendance taken successfully!</div>";
    }

    // Redirect or display the status message as needed
    // You can redirect the user to another page or display the status message on the same page
    // Example: header("Location: attendance_success.php");
    echo $statusMsg;
}
?>
