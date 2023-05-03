<?php
session_start();
include "database.php";

if(isset($_POST['questions'])) {
    $schoolId = $_SESSION["school_id"];
    $postid = $_POST['postid'];
    $result = mysqli_query($conn, "SELECT * FROM questions WHERE examid=$postid AND schoolID=$schoolId");
    $data = array();

    if(mysqli_num_rows($result) > 0) {
        $redirect_url = 'question.php?postid=' . $postid;
        $response = array(
            'redirect_url' => $redirect_url
        );
        echo json_encode($response);
        exit();
    } else {
        $message = "No questions available at the moment";
        echo json_encode(array("message" => $message));
        exit();
    }
}
?>
