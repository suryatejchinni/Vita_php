<?php include('db_connect.php'); ?>
<?php


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
        $crius = $a['crius'];
        $chiros = $a['chiros'];
        $chimak = $a['chimak']; 
        $id = $a['id'];

        $sql = "UPDATE  leads set Name='$name', Company='$company', Email='$email', Phone='$phone', Alt_Phone='$alt_phone', Country='$country', Crius='$crius', Chiros='$chiros', Chimak='$chimak', Comments='$message'
        Where id = '$id'";

if ($conn->query($sql) === TRUE) {
    echo $sql;
    echo "New record updated successfully";
    header('Location: back.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

}

        ?>