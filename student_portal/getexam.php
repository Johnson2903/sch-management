


<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include "../engine/database.php";

if(isset($_SESSION["school_id"]) && isset($_POST['questions'])){
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
        $message = "You dont have access to this exam at the moment, check later.";
        echo json_encode(array("message" => $message));
        exit();
    }
}
?>

