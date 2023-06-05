<?php 

session_start();
include "database.php";
if(!empty($_POST['filename']) || !empty($_FILES['image']))
{
$img = $_FILES["image"]["name"];
$tmp = $_FILES["image"]["tmp_name"];
$errorimg = $_FILES["image"]["error"];
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
$path = '../uploads/'; // upload directory

    $img = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    // echo $img;
    // get uploaded file's extension
    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
     
    // can upload same image using rand function
    $final_image = rand(1000,1000000).$img;
    // check's valid format
    if(in_array($ext, $valid_extensions)) { 
        $path = $path.strtolower($final_image); 
        // echo $path;
        if(move_uploaded_file($tmp,$path)) {
        
            $name = htmlspecialchars($_POST['filename']);
            // echo $name;
            $schoolId=$_SESSION["school_id"];
            $teacherId =$_SESSION["teacher_id"];
            $sql= "INSERT INTO `fileuploading`  (`filename`,`schoolID`,`teacherID`,`file_name`)
            VALUES ('".$name."','".$schoolId."','".$teacherId."','".$path."')";
            if($conn->query($sql)){
                echo "New Book added successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                // mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            }
        }else{
            echo "Cannot upload";
        }
    } else {
        echo "invalid";
     
    }
}else {
    echo "cannot be empty";
}

?>