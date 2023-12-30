<?php
    $con = new mysqli('localhost' , 'root' , '' , 'football_academy');
    session_start();
    if(isset($_POST['btnSave'])){
        $id = $_POST['playerID'];
        $name = $_POST['playerName'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $nation = $_POST['nationality'];
        $num = $_POST['number'];
        $pos = $_POST['position'];
        $fileName = $_FILES['uploadImg']['name'];
        $tmp_name = $_FILES['uploadImg']['tmp_name'];
        $path = '../img/';
        move_uploaded_file($tmp_name, $path.$fileName);
        $sql = "INSERT INTO `tbl_player`
        (`ID`, `Name`, `Gender`, `DOB`, `Nationality`, `Number`, `Position`, `Profile`)
        VALUES ('$id', '$name', '$gender', '$dob', '$nation', '$num', '$pos', '$fileName')";
        if($id != null && $name != null ){
            $exe = $con->query($sql);
            $_SESSION['msg-save'] = "Successfully Save!";
        }
        else if($id == null && $name == null ){
            $_SESSION['msg-alert'] = "Please fill the form!";
        }
        header('location: ../player.php');
}

?>
