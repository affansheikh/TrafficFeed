<?php
include 'dbconfig.php';
if(isset($_POST['action'])){
    $action = $_POST['action'];
    switch ($action){
        case "login": doLogin($conn);
        break;
        case "signup": doSignup($conn);
        break;
        case "get_profile":getProfile($conn);
        break;
        case "update_profile":updateProfile($conn);
        break;
    }
}
function doLogin($conn){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query="SELECT * FROM users WHERE BINARY email='$email' AND password='$password'";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result)==1){
        $msg="Login Successful";
        $success=true;
        while($row=mysqli_fetch_assoc($result)){
            $user_id=$row['id'];
        }
    }else{
        $msg="Please check credentials";
        $success=false;
        $user_id=0;
    }
    $output = array(
        "success" => $success,
        "message" => $msg,
        "user_id" => $user_id
    );
    echo json_encode($output);
    mysqli_close($conn);
}
function doSignup($conn){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    $check_user_query = "SELECT * FROM users where  email = '$email'";
    $insert_user_query = "INSERT INTO users (fname,lname, email,mobile, password) VALUES ('$fname','$lname','$email','$mobile','$password')";
    $check_user_result = mysqli_query($conn, $check_user_query);
    if(mysqli_num_rows($check_user_result) > 0){
        $success = false;
        $message = "User already registered";
    }else{
        if( mysqli_query($conn, $insert_user_query)){
            $success = true;
            $message ="Singup successful";
            
        }else{
            $success = false;
            $message = "Something went wrong. Error: ".mysqli_error($conn);
        }

    }
    $result = array(

        "success" => $success,
        "message" => $message
    );
    echo json_encode($result);
    mysqli_close($conn);
}
function getProfile($conn){
    $user_id=$_POST['user_id'];
    $query="SELECT * FROM users WHERE id='$user_id'";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result)>0){
        $success = true;
        $message ="UserData found";
        while($row=mysqli_fetch_assoc($result)){
            $data = array(
            "id"=>$row['id'],
            "fname"=>$row['fname'],
            "lname"=>$row['lname'],
            "mobile"=>$row['mobile'],
            "email"=>$row['email'],
        );
        }
    }else{
        $success = false;
        $message = "No user found ";
    }
     $output = array(

        "success" => $success,
        "message" => $message,
        "data"=>$data
    );
    echo json_encode($output);
    mysqli_close($conn);
}
function updateProfile($conn){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mobile = $_POST['mobile'];

    $update_query = "UPDATE users SET fname='$fname' ,lname ='$lname', mobile='$mobile'";
    
    
        if( mysqli_query($conn, $update_query)){
            $success = true;
            $message ="Profile updated successfullly";
            
        }else{
            $success = false;
            $message = "Something went wrong. Error: ".mysqli_error($conn);
        }

    
    $result = array(

        "success" => $success,
        "message" => $message
    );
    echo json_encode($result);
    mysqli_close($conn);
}
?>