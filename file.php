<?php
    
    $prod="";
    $prod1="";
    $prod2="";
    $dir =  getcwd();
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

        
        if(isset($a['prod']))
        {
        $aprod = $a['prod'];
        $prod=implode(", ",$aprod);
        }
        if(isset($a['prod1']))
        {
        $aprod1 = $a['prod1'];
        $prod1=implode(", ",$aprod1);
        }
        if(isset($a['prod2']))
        {$aprod2 = $a['prod2'];
        $prod2=implode(", ",$aprod2);}
   
        
        
        

        if($_FILES["vis1"]["size"]!=0)
        {
            $target_file1 = $target_dir."visitingcards/".$name."_".$company."_"."front". basename($_FILES["vis1"]["name"]);
            if (move_uploaded_file($_FILES["vis1"]["tmp_name"], $target_file1)) {
                echo "The file ". basename( $_FILES["vis1"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        else{
            $target_file1=NULL;
        }

        if($_FILES["vis2"]["size"]!=0)
        {
            $target_file2 = $target_dir."visitingcards/".$name."_".$company."_"."front". basename($_FILES["vis2"]["name"]);
            if (move_uploaded_file($_FILES["vis2"]["tmp_name"], $target_file1)) {
                echo "The file ". basename( $_FILES["vis2"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        else
        $target_file2=NULL;

        if($_FILES["vis3"]["size"]!=0)
        {
            $target_file3 = $target_dir."photos/".$name."_".$company. basename($_FILES["vis3"]["name"]);
            if (move_uploaded_file($_FILES["vis3"]["tmp_name"], $target_file3)) {
                echo "The file ". basename( $_FILES["vis3"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        else
        $target_file3=NULL;

        $sql = "INSERT INTO `leads` (`id`, `Name`, `Company`, `Email`, `Phone`, `Alt_Phone`, `Country`, `Chiros`, `Crius`, `Chimak`, `Comments`, `vis_1`, `vis_2`, `photo`) 
            VALUES (NULL, '$name', '$company', '$email','$phone', '$alt_phone', '$country', '$prod', '$prod1', '$prod2', '$message', '$target_file1', '$target_file2', '$target_file3')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


    }
    
?>