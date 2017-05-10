<?php
include 'dbconfig.php';
if(isset($_POST['action'])){
    $action = $_POST['action'];
    switch ($action){
        case "add": addPost($conn);
        break;
        case "delete": deletePost($conn);
        break;
        case "all_posts":getAllPost($conn);
        break;
        case "user_posts":getUserPosts($conn);
        break;
    }
}
function addPost($conn){
    $user_id=$_POST['user_id'];
    $post=$_POST['post'];
    $location=$_POST['location'];
    $posted_on=$_POST['timestamp'];
    $place_name=$_POST['place_name'];

    $query="INSERT INTO posts (posted_by,location,post,posted_on,place_name) VALUES ('$user_id','$location','$post','$posted_on','$place_name')";
    if(mysqli_query($conn,$query)){
        $success = true;
            $message ="Post added successfully";
            
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
function deletePost($conn){
    $user_id = $_POST['user_id'];
    $post_id = $_POST['post_id'];

    $query = "DELETE FROM posts WHERE id='$post_id' AND posted_by='$user_id'";
if(mysqli_query($conn,$query)){
        $success = true;
            $message ="Post added successfully";
            
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
function getAllPost($conn){
    $distance=$_POST['distance'];
    $locations = explode(",",$_POST['location']);
    //$query="SELECT * FROM posts ORDER BY id DESC";
    $query ="SELECT *, ( 6371 * acos( cos( radians(37) ) * cos( radians( $locations[0] ) ) * cos( radians( $locations[1] ) - radians(-122) ) + sin( radians(37) ) * sin( radians( $locations[0] ) ) ) ) AS distance FROM posts  ORDER BY distance LIMIT 0 , 20";
    //echo $query1;
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
        $success = true;
        $message ="Data found";
        $data[] = array(
            "id"=>$row['id'],
            "post"=>$row['post'],
            "location"=>$row['location'],
            "place_name"=>$row['place_name'],
            "posted_by"=>getProfileDetails($conn,$row['posted_by']),
            "posted_on"=>$row['posted_on'],
        );
        }
    }else{
        $success = false;
        $message = "No data found ";
    }
    $output = array(

        "success" => $success,
        "message" => $message,
        "data"=>$data
    );
    echo json_encode($output);
    mysqli_close($conn);
}
function bar_get_nearby( $lat, $lng, $limit = 50, $distance = 50, $unit = 'mi' ) {
    // radius of earth; @note: the earth is not perfectly spherical, but this is considered the 'mean radius'
    if( $unit == 'km' ) { $radius = 6371.009; }
    elseif ( $unit == 'mi' ) { $radius = 3958.761; }

    // latitude boundaries
    $maxLat = ( float ) $lat + rad2deg( $distance / $radius );
    $minLat = ( float ) $lat - rad2deg( $distance / $radius );

    // longitude boundaries (longitude gets smaller when latitude increases)
    $maxLng = ( float ) $lng + rad2deg( $distance / $radius) / cos( deg2rad( ( float ) $lat ) );
    $minLng = ( float ) $lng - rad2deg( $distance / $radius) / cos( deg2rad( ( float ) $lat ) );

    $max_min_values = array(
        'max_latitude' => $maxLat,
        'min_latitude' => $minLat,
        'max_longitude' => $maxLng,
        'min_longitude' => $minLng
    );

    return $max_min_values;
}
function getUserPosts($conn){
    $user_id = $_POST['user_id'];
    $query="SELECT * FROM posts WHERE posted_by='$user_id'";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
        $success = true;
        $message ="Data found";
        $data[] = array(
            "id"=>$row['id'],
            "post"=>$row['post'],
            "location"=>$row['location'],
            "place_name"=>$row['place_name'],
            "posted_by"=>$row['posted_by'],
            "posted_on"=>$row['posted_on'],
        );
        }
    }else{
        $success = false;
        $message = "No data found ";
    }
    $output = array(

        "success" => $success,
        "message" => $message,
        "data"=>$data
    );
    echo json_encode($output);
    mysqli_close($conn);

}
function getProfileDetails($conn,$user_id){
    $query="SELECT * FROM users WHERE id='$user_id'";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result)>0){
        $success = true;
        $message ="UserData found";
        while($row=mysqli_fetch_assoc($result)){
            $data= array(
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
    return $output;
}
?>