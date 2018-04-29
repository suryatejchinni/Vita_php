<!DOCTYPE html>

<?php
$name = "";
$company = "";
$email = "";
$phone = "";
$message = "";
$alt_phone = "";
$country = "";
$crius = "";
$chiros = "";
$chimak = ""; 
$id = "";
 
//Connect to our MySQL database using the PDO extension.
$pdo = new PDO('mysql:host=localhost;dbname=registrations', 'root', '');
 
//Our select statement. This will retrieve the data that we want.
$sql = "SELECT id, name FROM leads";
 
//Prepare the select statement.
$stmt = $pdo->prepare($sql);
 
//Execute the statement.
$stmt->execute();
 
//Retrieve the rows using fetchAll.
$users = $stmt->fetchAll();

if ($_SERVER["REQUEST_METHOD"] == "POST")
{

$host = "localhost";
$userName = "root";
$password = "";
$dbName = "registrations";
 
// Create database connection
$conn = mysqli_connect($host, $userName, $password, $dbName);
 
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
else{
    echo("Connection Succeful");
}

  $id = $_POST['select'];
  echo $id;
  
  $sql = "SELECT * FROM leads where id= '$id' ";
  $result = $conn->query($sql);
  
  $a = mysqli_fetch_array($result);
  

        // here too, you put a space between it
   
      if(($a['id'])==$id){
        echo "yes";
    $name = $a['Name'];
    $company = $a['Company'];
    $email = $a['Email'];
    $phone = $a['Phone'];
    $message = $a['Comments'];
    $alt_phone = $a['Alt_Phone'];
    $country = $a['Country'];
    $chiros = $a['Chiros'];
    $crius = $a['Crius'];
    $chimak = $a['Chimak'];
    $ur1 = $a['vis_1'];
    $ur2 = $a['vis_2'];
    $ur3 = $a['photo'];

    //echo $chiros.$chimak.$crius;
      }
      }
    

 
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>BACKEND</title>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css" />
  <link rel="stylesheet" href="back_style.css">
</head>
<body>
  <div class="container">
    <h1 class="brand"><span>Back </span>End</h1>
    <div class="wrapper">
      <div class="company-info">
        <h3>Expect a revert soon!</h3>
        <ul>
          <li><i class="fa fa-road"></i> sector 82, Mohali</li>
          <li><i class="fa fa-phone"></i> +91 8123199351</li>
          <li><i class="fa fa-envelope"></i> surya@criuslife.com</li>
        </ul>
      </div>
      <div class="contact">
        <h3>Email Us</h3>
        <div class="alert">Your entry has been submitted</div>
        <form id="myForm" method="post" action="back.php" enctype="multipart/form-data">
        <select name="select" id="select">
        <?php foreach($users as $user): ?>
        <option value="<?= $user['id']; ?>"><?= $user['name']; ?></option>
        <?php endforeach; ?>
        </select>
          <div class="x">
            <button type="submit" >view</button>
          </div>
        </form>
        <form id="contactForm" method="post" action="update.php" enctype="multipart/form-data">
          <p>
            <label>Name</label>
            <input type="text" name="name" id="name" value="<?php echo $name; ?>" required>
          </p>
          <p>
            <label>Company</label>
            <input type="text" name="company" id="company" value="<?php echo $company; ?>" >
          </p>
          <p>
            <label>Email Address</label>
            <input type="email" name="email" id="email" value="<?php echo $email; ?>" required>
          </p>
          <p>
            <label>Phone Number</label>
            <input type="text" name="phone" id="phone" value="<?php echo $phone; ?>">
          </p>
          <p>
              <label>Alternate Phone Number</label>
              <input type="text" name="alt_phone" id="alt_phone" value="<?php echo $alt_phone; ?>" >
            </p>
            <p>
                <label>Country</label>
                <input type="text" name="country" id="country" value="<?php echo $country; ?>">
              </p>

            <p class="full">
                <label>Interested Products</label>
                <label>Chiros</label>
                <textarea rows="4" name="chiros" id="chiros"  ><?php echo $chiros; ?> </textarea>
                <label>Crius</label>
                <textarea rows="4" name="crius" id="crius"  ><?php echo $crius; ?> </textarea>
                <label>Chimak</label>
                <textarea rows="4" name="chimak" id="chimak"  ><?php echo $chimak; ?> </textarea>
              </p>

          <p class="full">
            <label>Comments</label>
            <textarea name="message" rows="5" id="message" > <?php echo $message; ?></textarea>
          </p>
          <p class="full" style="display:none">
                <label>ID</label>
                <input type="text" name="id" id="id" value="<?php echo $id; ?>">
              </p>
          <p class="full">
            <button type="submit">Update
            </button>
          </p>
        </form>
          <div class="row">
              <div class = "column">
                <img id="visit" alt="Visiting Card Photo" onclick="openImg(this);" src="<?php echo $ur1; ?>">
              </div>
              <div class = "column">
                <img id="visit1" alt="Visiting Card backside" onclick="openImg(this);" src="<?php echo $ur2; ?>">
              </div>
              <div class = "column">
                <img id="visit2" alt="Photo at site" onclick="openImg(this);" src="<?php echo $ur3; ?>" >
              </div>
           </div>

          <div class="container">
            <!-- Close the image -->
            <span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span>
          
            <!-- Expanded image -->
            <img id="expandedImg" style="width:100%">
          
            <!-- Image text -->
            <div id="imgtext"></div>
          </div>
      </div>
    </div>
  </div>

  <script src="https://www.gstatic.com/firebasejs/4.12.0/firebase.js"></script>
  <script src="https://www.gstatic.com/firebasejs/4.12.0/firebase-firestore.js"></script>
  <script src="back.js"></script>

  
</body>
</html>