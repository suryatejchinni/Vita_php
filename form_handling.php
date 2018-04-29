<?php

$host = "localhost";
$userName = "root";
$password = "";
$dbName = "registrations";
$dir="";
 
// Create database connection
$conn = mysqli_connect($host, $userName, $password, $dbName);
 
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
else{
    echo("Connection Succeful");
    $dir =  getcwd();
    echo $dir;

}


    $prod="";
    $prod1="";
    $prod2="";
    $target_dir=$dir."/uploads/";
    

       

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $a = $_POST;
    //print_r( $a );
    //print_r($_FILES);    
   
    $name = $a['name'];
    $company = $a['company'];
    $email = $a['email'];
    $phone = $a['phone'];
    $message = $a['message'];
    $alt_phone = $a['alt_phone'];
    $country = $a['country'];

    $target_file1 = $target_dir."visitingcards/".$name."_".$company."_"."front". basename($_FILES["vis1"]["name"]);
    $target_file2 = $target_dir."visitingcards/".$name."_".$company."_"."back". basename($_FILES["vis2"]["name"]);
    $target_file3 = $target_dir."photos/".$name."_".$company. basename($_FILES["vis3"]["name"]);
    
   
    $aprod = $a['prod'];
    $aprod1 = $a['prod1'];
    $aprod2 = $a['prod2'];
   
    $prod=implode(", ",$aprod);
    $prod1=implode(", ",$aprod1);
    $prod2=implode(", ",$aprod2);
  

    echo $name;
    echo "<br>";
    echo $company;
    echo "<br>";
    echo $email;
    echo "<br>";
    echo $phone;
    echo "<br>";
    echo $alt_phone;
    echo "<br>";
    echo $message;
    echo "<br>";
    echo $country;
    echo "<br>";
    echo $prod."<br>";
    echo $prod1."<br>";
    echo $prod2."<br>";
    echo $_FILES['vis1']['name'];
    echo "<br>";
    echo $_FILES['vis2']['name'];
    echo "<br>";
    echo $_FILES['vis3']['name'];
    echo "<br>";

   

    if (move_uploaded_file($_FILES["vis1"]["tmp_name"], $target_file1)) {
        echo "The file ". basename( $_FILES["vis1"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    if (move_uploaded_file($_FILES["vis2"]["tmp_name"], $target_file2)) {
        echo "The file ". basename( $_FILES["vis2"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    if (move_uploaded_file($_FILES["vis3"]["tmp_name"], $target_file3)) {
        echo "The file ". basename( $_FILES["vis3"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }



    $sql = "INSERT INTO `leads` (`id`, `Name`, `Company`, `Email`, `Phone`, `Alt_Phone`, `Country`, `Chiros`, `Crius`, `Chimak`, `Comments`, `vis_1`, `vis_2`, `photo`) 
            VALUES (NULL, '$name', '$company', '$email','$phone', '$alt_phone', '$country', '$prod', '$prod1', '$prod2', '$message', '$target_file1', '$target_file2', '$target_file3')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    die();
    }
?>