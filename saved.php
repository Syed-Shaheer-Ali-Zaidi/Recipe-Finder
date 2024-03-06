<?php
    session_start();
    require_once "database.php";
    // $email=$_SESSION["user"];
    // $DISC = $_GET['DISC'];

    // $sql="select * from full_recipy where rid='$DISC' ";
    // $resul=mysqli_query($conn,$sql);
    // $row=mysqli_fetch_array($resul);
    // $rid = 		  $row['rid'];
        //select $email where $rid
        //if result empty then insert else dont
        //insert $email,$rid
        mysqli_query($conn,"INSERT INTO saved (email, rid) VALUES ($email, $rid)");
        // $result = mysqli_query($conn,"SELECT * FROM saved WHERE email=$email AND rid=$rid");
        // $saved=mysqli_fetch_array($result);
        // if(isset($saved)){
            
        // }
        // else{
        // 	mysqli_query($conn,"INSERT INTO saved (email, rid) VALUES ($email, $rid)");
        // }
?>