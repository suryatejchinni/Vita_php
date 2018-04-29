<?php include('db_connect.php'); ?>
<?php include('compress.php'); ?>

<?php
    
    $prod="";
    $prod1="";
    $prod2="";
    $dir =  getcwd();
    $tar = "/Vita_php/uploads/";
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
            $target_file1 = $target_dir."visitingcards1/".$name."_".$company."_"."front". basename($_FILES["vis1"]["name"]);
            $source1 = $_FILES["vis1"]["tmp_name"];
            /*if (move_uploaded_file($source1, $target_file1)) {
                echo "The file ". basename( $source1. " has been uploaded.");
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
*/

            $success = compress_image($source1, $target_file1, 0, 0, -1);
            $temp_di1= $tar."visitingcards1/".$name."_".$company."_"."front". basename($_FILES["vis1"]["name"]);  

        }
        else{
            $target_file1=NULL;
        }

        if($_FILES["vis2"]["size"]!=0)
        {
            $target_file2 = $target_dir."visitingcards/".$name."_".$company."_"."back". basename($_FILES["vis2"]["name"]);
            $source2= $_FILES["vis2"]["tmp_name"];

            $success = compress_image($source2, $target_file2, 0, 0, -1); 
            $temp_di2= $tar."visitingcards/".$name."_".$company."_"."back". basename($_FILES["vis2"]["name"]);            
        }
        else
        $target_file2=NULL;

        if($_FILES["vis3"]["size"]!=0)
        {
            $target_file3 = $target_dir."photos/".$name."_".$company. basename($_FILES["vis3"]["name"]);
            $source3=$_FILES["vis3"]["tmp_name"];
            $success = compress_image($source3, $target_file3, 0, 0, -1);  
            $temp_di3= $tar."photos/".$name."_".$company. basename($_FILES["vis3"]["name"]);              

        }
        else
        $target_file3=NULL;

        $sql = "INSERT INTO `leads` (`id`, `Name`, `Company`, `Email`, `Phone`, `Alt_Phone`, `Country`, `Chiros`, `Crius`, `Chimak`, `Comments`, `vis_1`, `vis_2`, `photo`) 
            VALUES (NULL, '$name', '$company', '$email','$phone', '$alt_phone', '$country', '$prod', '$prod1', '$prod2', '$message', '$temp_di1', '$temp_di2', '$temp_di3')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        header('Location: index.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


    }
    
?>



<!DOCTYPE html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Crius Life Sciences</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css" />
  <link rel="stylesheet" href="index.css">
  

 </head>
 <body>
 <div class="container">
    <h1 class="brand"><span>Crius </span> Life Sciences</h1>
    <div class="wrapper">
    
      <div class="contact">
        <h3>Email Us</h3>
        <div class="alert">Your entry has been submitted</div>
        <form id="contactForm" method="post" action="index.php" enctype="multipart/form-data">

            <div class="row">
                <div class="col-md-6">
                    
                        <div class="form-group">  
                          <p>
                        <label>Name</label>
                        <input type="text" name="name" id="name" required>
                         </p>
                        </div>
                      
                </div>
                <div class="col-md-6">
                    <div class="form-group">  
                        <p>
                            <label>Company</label>
                            <input type="text" name="company" id="company">
                       </p>
                      </div>
                </div>
             </div>
            
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">  
                          <p>
                              <label>Email Address</label>
                              <input type="email" name="email" id="email" required>
                         </p>
                        </div>
                   </div>

                   <div class="col-md-6">
                      <div class="form-group">  
                          <p>
                              <label>Phone Number</label>
                              <input type="text" name="phone" id="phone" pattern="[+0-9]+[0-9].+" title="Phone no can contain + followed by only numbers">
                         </p>
                        </div>
                   </div>
               </div>

               <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">  
                          <p>
                              <label>Alternate Phone Number</label>
                              <input type="tel" name="alt_phone" id="alt_phone" pattern="[+0-9]+[0-9].+" title="Phone no can contain + followed by only numbers" >
                         </p>
                        </div>
                   </div>
                

                   <div class="col-md-6">
                      <div class="form-group">  
                          <p>
                              <label>Country</label>
                              <select name="country" style="width:100%;max-width:90%;" id="country_picker">
                                  <option value="Afghanistan" title="Afghanistan">Afghanistan</option>
                                  <option value="Åland Islands" title="Åland Islands">Åland Islands</option>
                                  <option value="Albania" title="Albania">Albania</option>
                                  <option value="Algeria" title="Algeria">Algeria</option>
                                  <option value="American Samoa" title="American Samoa">American Samoa</option>
                                  <option value="Andorra" title="Andorra">Andorra</option>
                                  <option value="Angola" title="Angola">Angola</option>
                                  <option value="Anguilla" title="Anguilla">Anguilla</option>
                                  <option value="Antarctica" title="Antarctica">Antarctica</option>
                                  <option value="Antigua and Barbuda" title="Antigua and Barbuda">Antigua and Barbuda</option>
                                  <option value="Argentina" title="Argentina">Argentina</option>
                                  <option value="Armenia" title="Armenia">Armenia</option>
                                  <option value="Aruba" title="Aruba">Aruba</option>
                                  <option value="Australia" title="Australia">Australia</option>
                                  <option value="Austria" title="Austria">Austria</option>
                                  <option value="Azerbaijan" title="Azerbaijan">Azerbaijan</option>
                                  <option value="Bahamas" title="Bahamas">Bahamas</option>
                                  <option value="Bahrain" title="Bahrain">Bahrain</option>
                                  <option value="Bangladesh" title="Bangladesh">Bangladesh</option>
                                  <option value="Barbados" title="Barbados">Barbados</option>
                                  <option value="Belarus" title="Belarus">Belarus</option>
                                  <option value="Belgium" title="Belgium">Belgium</option>
                                  <option value="Belize" title="Belize">Belize</option>
                                  <option value="Benin" title="Benin">Benin</option>
                                  <option value="Bermuda" title="Bermuda">Bermuda</option>
                                  <option value="Bhutan" title="Bhutan">Bhutan</option>
                                  <option value="Bolivia, Plurinational State of" title="Bolivia, Plurinational State of">Bolivia, Plurinational State of</option>
                                  <option value="Bonaire, Sint Eustatius and Saba" title="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba</option>
                                  <option value="Bosnia and Herzegovina" title="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                  <option value="Botswana" title="Botswana">Botswana</option>
                                  <option value="Bouvet Island" title="Bouvet Island">Bouvet Island</option>
                                  <option value="Brazil" title="Brazil">Brazil</option>
                                  <option value="British Indian Ocean Territory" title="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                  <option value="Brunei Darussalam" title="Brunei Darussalam">Brunei Darussalam</option>
                                  <option value="Bulgaria" title="Bulgaria">Bulgaria</option>
                                  <option value="Burkina Faso" title="Burkina Faso">Burkina Faso</option>
                                  <option value="Burundi" title="Burundi">Burundi</option>
                                  <option value="Cambodia" title="Cambodia">Cambodia</option>
                                  <option value="Cameroon" title="Cameroon">Cameroon</option>
                                  <option value="Canada" title="Canada">Canada</option>
                                  <option value="Cape Verde" title="Cape Verde">Cape Verde</option>
                                  <option value="Cayman Islands" title="Cayman Islands">Cayman Islands</option>
                                  <option value="Central African Republic" title="Central African Republic">Central African Republic</option>
                                  <option value="Chad" title="Chad">Chad</option>
                                  <option value="Chile" title="Chile">Chile</option>
                                  <option value="China" title="China">China</option>
                                  <option value="Christmas Island" title="Christmas Island">Christmas Island</option>
                                  <option value="Cocos (Keeling) Islands" title="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                  <option value="Colombia" title="Colombia">Colombia</option>
                                  <option value="Comoros" title="Comoros">Comoros</option>
                                  <option value="Congo" title="Congo">Congo</option>
                                  <option value="Congo, the Democratic Republic of the" title="Congo, the Democratic Republic of the">Congo, the Democratic Republic of the</option>
                                  <option value="Cook Islands" title="Cook Islands">Cook Islands</option>
                                  <option value="Costa Rica" title="Costa Rica">Costa Rica</option>
                                  <option value="Côte d'Ivoire" title="Côte d'Ivoire">Côte d'Ivoire</option>
                                  <option value="Croatia" title="Croatia">Croatia</option>
                                  <option value="Cuba" title="Cuba">Cuba</option>
                                  <option value="Curaçao" title="Curaçao">Curaçao</option>
                                  <option value="Cyprus" title="Cyprus">Cyprus</option>
                                  <option value="Czech Republic" title="Czech Republic">Czech Republic</option>
                                  <option value="Denmark" title="Denmark">Denmark</option>
                                  <option value="Djibouti" title="Djibouti">Djibouti</option>
                                  <option value="Dominica" title="Dominica">Dominica</option>
                                  <option value="Dominican Republic" title="Dominican Republic">Dominican Republic</option>
                                  <option value="Ecuador" title="Ecuador">Ecuador</option>
                                  <option value="Egypt" title="Egypt">Egypt</option>
                                  <option value="El Salvador" title="El Salvador">El Salvador</option>
                                  <option value="Equatorial Guinea" title="Equatorial Guinea">Equatorial Guinea</option>
                                  <option value="Eritrea" title="Eritrea">Eritrea</option>
                                  <option value="Estonia" title="Estonia">Estonia</option>
                                  <option value="Ethiopia" title="Ethiopia">Ethiopia</option>
                                  <option value="Falkland Islands (Malvinas)" title="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                  <option value="Faroe Islands" title="Faroe Islands">Faroe Islands</option>
                                  <option value="Fiji" title="Fiji">Fiji</option>
                                  <option value="Finland" title="Finland">Finland</option>
                                  <option value="France" title="France">France</option>
                                  <option value="French Guiana" title="French Guiana">French Guiana</option>
                                  <option value="French Polynesia" title="French Polynesia">French Polynesia</option>
                                  <option value="French Southern Territories" title="French Southern Territories">French Southern Territories</option>
                                  <option value="Gabon" title="Gabon">Gabon</option>
                                  <option value="Gambia" title="Gambia">Gambia</option>
                                  <option value="Georgia" title="Georgia">Georgia</option>
                                  <option value="Germany" title="Germany">Germany</option>
                                  <option value="Ghana" title="Ghana">Ghana</option>
                                  <option value="Gibraltar" title="Gibraltar">Gibraltar</option>
                                  <option value="Greece" title="Greece">Greece</option>
                                  <option value="Greenland" title="Greenland">Greenland</option>
                                  <option value="Grenada" title="Grenada">Grenada</option>
                                  <option value="Guadeloupe" title="Guadeloupe">Guadeloupe</option>
                                  <option value="Guam" title="Guam">Guam</option>
                                  <option value="Guatemala" title="Guatemala">Guatemala</option>
                                  <option value="Guernsey" title="Guernsey">Guernsey</option>
                                  <option value="Guinea" title="Guinea">Guinea</option>
                                  <option value="Guinea-Bissau" title="Guinea-Bissau">Guinea-Bissau</option>
                                  <option value="Guyana" title="Guyana">Guyana</option>
                                  <option value="Haiti" title="Haiti">Haiti</option>
                                  <option value="Heard Island and McDonald Islands" title="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
                                  <option value="Holy See (Vatican City State)" title="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                  <option value="Honduras" title="Honduras">Honduras</option>
                                  <option value="Hong Kong" title="Hong Kong">Hong Kong</option>
                                  <option value="Hungary" title="Hungary">Hungary</option>
                                  <option value="Iceland" title="Iceland">Iceland</option>
                                  <option value="India" title="India">India</option>
                                  <option value="Indonesia" title="Indonesia">Indonesia</option>
                                  <option value="Iran, Islamic Republic of" title="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                  <option value="Iraq" title="Iraq">Iraq</option>
                                  <option value="Ireland" title="Ireland">Ireland</option>
                                  <option value="Isle of Man" title="Isle of Man">Isle of Man</option>
                                  <option value="Israel" title="Israel">Israel</option>
                                  <option value="Italy" title="Italy">Italy</option>
                                  <option value="Jamaica" title="Jamaica">Jamaica</option>
                                  <option value="Japan" title="Japan">Japan</option>
                                  <option value="Jersey" title="Jersey">Jersey</option>
                                  <option value="Jordan" title="Jordan">Jordan</option>
                                  <option value="Kazakhstan" title="Kazakhstan">Kazakhstan</option>
                                  <option value="Kenya" title="Kenya">Kenya</option>
                                  <option value="Kiribati" title="Kiribati">Kiribati</option>
                                  <option value="Korea, Democratic People's Republic of" title="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                  <option value="Korea, Republic of" title="Korea, Republic of">Korea, Republic of</option>
                                  <option value="Kuwait" title="Kuwait">Kuwait</option>
                                  <option value="Kyrgyzstan" title="Kyrgyzstan">Kyrgyzstan</option>
                                  <option value="Lao People's Democratic Republic" title="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                  <option value="Latvia" title="Latvia">Latvia</option>
                                  <option value="Lebanon" title="Lebanon">Lebanon</option>
                                  <option value="Lesotho" title="Lesotho">Lesotho</option>
                                  <option value="Liberia" title="Liberia">Liberia</option>
                                  <option value="Libya" title="Libya">Libya</option>
                                  <option value="Liechtenstein" title="Liechtenstein">Liechtenstein</option>
                                  <option value="Lithuania" title="Lithuania">Lithuania</option>
                                  <option value="Luxembourg" title="Luxembourg">Luxembourg</option>
                                  <option value="Macao" title="Macao">Macao</option>
                                  <option value="Macedonia, the former Yugoslav Republic of" title="Macedonia, the former Yugoslav Republic of">Macedonia, the former Yugoslav Republic of</option>
                                  <option value="Madagascar" title="Madagascar">Madagascar</option>
                                  <option value="Malawi" title="Malawi">Malawi</option>
                                  <option value="Malaysia" title="Malaysia">Malaysia</option>
                                  <option value="Maldives" title="Maldives">Maldives</option>
                                  <option value="Mali" title="Mali">Mali</option>
                                  <option value="Malta" title="Malta">Malta</option>
                                  <option value="Marshall Islands" title="Marshall Islands">Marshall Islands</option>
                                  <option value="Martinique" title="Martinique">Martinique</option>
                                  <option value="Mauritania" title="Mauritania">Mauritania</option>
                                  <option value="Mauritius" title="Mauritius">Mauritius</option>
                                  <option value="Mayotte" title="Mayotte">Mayotte</option>
                                  <option value="Mexico" title="Mexico">Mexico</option>
                                  <option value="Micronesia, Federated States of" title="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                  <option value="Moldova, Republic of" title="Moldova, Republic of">Moldova, Republic of</option>
                                  <option value="Monaco" title="Monaco">Monaco</option>
                                  <option value="Mongolia" title="Mongolia">Mongolia</option>
                                  <option value="Montenegro" title="Montenegro">Montenegro</option>
                                  <option value="Montserrat" title="Montserrat">Montserrat</option>
                                  <option value="Morocco" title="Morocco">Morocco</option>
                                  <option value="Mozambique" title="Mozambique">Mozambique</option>
                                  <option value="Myanmar" title="Myanmar">Myanmar</option>
                                  <option value="Namibia" title="Namibia">Namibia</option>
                                  <option value="Nauru" title="Nauru">Nauru</option>
                                  <option value="Nepal" title="Nepal">Nepal</option>
                                  <option value="Netherlands" title="Netherlands">Netherlands</option>
                                  <option value="New Caledonia" title="New Caledonia">New Caledonia</option>
                                  <option value="New Zealand" title="New Zealand">New Zealand</option>
                                  <option value="Nicaragua" title="Nicaragua">Nicaragua</option>
                                  <option value="Niger" title="Niger">Niger</option>
                                  <option value="Nigeria" title="Nigeria">Nigeria</option>
                                  <option value="Niue" title="Niue">Niue</option>
                                  <option value="Norfolk Island" title="Norfolk Island">Norfolk Island</option>
                                  <option value="Northern Mariana Islands" title="Northern Mariana Islands">Northern Mariana Islands</option>
                                  <option value="Norway" title="Norway">Norway</option>
                                  <option value="Oman" title="Oman">Oman</option>
                                  <option value="Pakistan" title="Pakistan">Pakistan</option>
                                  <option value="Palau" title="Palau">Palau</option>
                                  <option value="Palestinian Territory, Occupied" title="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                  <option value="Panama" title="Panama">Panama</option>
                                  <option value="Papua New Guinea" title="Papua New Guinea">Papua New Guinea</option>
                                  <option value="Paraguay" title="Paraguay">Paraguay</option>
                                  <option value="Peru" title="Peru">Peru</option>
                                  <option value="Philippines" title="Philippines">Philippines</option>
                                  <option value="Pitcairn" title="Pitcairn">Pitcairn</option>
                                  <option value="Poland" title="Poland">Poland</option>
                                  <option value="Portugal" title="Portugal">Portugal</option>
                                  <option value="Puerto Rico" title="Puerto Rico">Puerto Rico</option>
                                  <option value="Qatar" title="Qatar">Qatar</option>
                                  <option value="Réunion" title="Réunion">Réunion</option>
                                  <option value="Romania" title="Romania">Romania</option>
                                  <option value="Russian Federation" title="Russian Federation">Russian Federation</option>
                                  <option value="Rwanda" title="Rwanda">Rwanda</option>
                                  <option value="Saint Barthélemy" title="Saint Barthélemy">Saint Barthélemy</option>
                                  <option value="Saint Helena, Ascension and Tristan da Cunha" title="Saint Helena, Ascension and Tristan da Cunha">Saint Helena, Ascension and Tristan da Cunha</option>
                                  <option value="Saint Kitts and Nevis" title="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                  <option value="Saint Lucia" title="Saint Lucia">Saint Lucia</option>
                                  <option value="Saint Martin (French part)" title="Saint Martin (French part)">Saint Martin (French part)</option>
                                  <option value="Saint Pierre and Miquelon" title="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                  <option value="Saint Vincent and the Grenadines" title="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                  <option value="Samoa" title="Samoa">Samoa</option>
                                  <option value="San Marino" title="San Marino">San Marino</option>
                                  <option value="Sao Tome and Principe" title="Sao Tome and Principe">Sao Tome and Principe</option>
                                  <option value="Saudi Arabia" title="Saudi Arabia">Saudi Arabia</option>
                                  <option value="Senegal" title="Senegal">Senegal</option>
                                  <option value="Serbia" title="Serbia">Serbia</option>
                                  <option value="Seychelles" title="Seychelles">Seychelles</option>
                                  <option value="Sierra Leone" title="Sierra Leone">Sierra Leone</option>
                                  <option value="Singapore" title="Singapore">Singapore</option>
                                  <option value="Sint Maarten (Dutch part)" title="Sint Maarten (Dutch part)">Sint Maarten (Dutch part)</option>
                                  <option value="Slovakia" title="Slovakia">Slovakia</option>
                                  <option value="Slovenia" title="Slovenia">Slovenia</option>
                                  <option value="Solomon Islands" title="Solomon Islands">Solomon Islands</option>
                                  <option value="Somalia" title="Somalia">Somalia</option>
                                  <option value="South Africa" title="South Africa">South Africa</option>
                                  <option value="South Georgia and the South Sandwich Islands" title="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
                                  <option value="South Sudan" title="South Sudan">South Sudan</option>
                                  <option value="Spain" title="Spain">Spain</option>
                                  <option value="Sri Lanka" title="Sri Lanka">Sri Lanka</option>
                                  <option value="Sudan" title="Sudan">Sudan</option>
                                  <option value="Suriname" title="Suriname">Suriname</option>
                                  <option value="Svalbard and Jan Mayen" title="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                  <option value="Swaziland" title="Swaziland">Swaziland</option>
                                  <option value="Sweden" title="Sweden">Sweden</option>
                                  <option value="Switzerland" title="Switzerland">Switzerland</option>
                                  <option value="Syrian Arab Republic" title="Syrian Arab Republic">Syrian Arab Republic</option>
                                  <option value="Taiwan, Province of China" title="Taiwan, Province of China">Taiwan, Province of China</option>
                                  <option value="Tajikistan" title="Tajikistan">Tajikistan</option>
                                  <option value="Tanzania, United Republic of" title="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                  <option value="Thailand" title="Thailand">Thailand</option>
                                  <option value="Timor-Leste" title="Timor-Leste">Timor-Leste</option>
                                  <option value="Togo" title="Togo">Togo</option>
                                  <option value="Tokelau" title="Tokelau">Tokelau</option>
                                  <option value="Tonga" title="Tonga">Tonga</option>
                                  <option value="Trinidad and Tobago" title="Trinidad and Tobago">Trinidad and Tobago</option>
                                  <option value="Tunisia" title="Tunisia">Tunisia</option>
                                  <option value="Turkey" title="Turkey">Turkey</option>
                                  <option value="Turkmenistan" title="Turkmenistan">Turkmenistan</option>
                                  <option value="Turks and Caicos Islands" title="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                  <option value="Tuvalu" title="Tuvalu">Tuvalu</option>
                                  <option value="Uganda" title="Uganda">Uganda</option>
                                  <option value="Ukraine" title="Ukraine">Ukraine</option>
                                  <option value="United Arab Emirates" title="United Arab Emirates">United Arab Emirates</option>
                                  <option value="United Kingdom" title="United Kingdom">United Kingdom</option>
                                  <option value="United States" title="United States">United States</option>
                                  <option value="United States Minor Outlying Islands" title="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                  <option value="Uruguay" title="Uruguay">Uruguay</option>
                                  <option value="Uzbekistan" title="Uzbekistan">Uzbekistan</option>
                                  <option value="Vanuatu" title="Vanuatu">Vanuatu</option>
                                  <option value="Venezuela, Bolivarian Republic of" title="Venezuela, Bolivarian Republic of">Venezuela, Bolivarian Republic of</option>
                                  <option value="Viet Nam" title="Viet Nam">Viet Nam</option>
                                  <option value="Virgin Islands, British" title="Virgin Islands, British">Virgin Islands, British</option>
                                  <option value="Virgin Islands, U.S." title="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                  <option value="Wallis and Futuna" title="Wallis and Futuna">Wallis and Futuna</option>
                                  <option value="Western Sahara" title="Western Sahara">Western Sahara</option>
                                  <option value="Yemen" title="Yemen">Yemen</option>
                                  <option value="Zambia" title="Zambia">Zambia</option>
                                  <option value="Zimbabwe" title="Zimbabwe">Zimbabwe</option>
                                </select>
                         </p>
                        </div>
                   </div>
               </div>

               

                  <div class="row">
                        <div class="col-md-4"><p><input id="chiros_btn" type="button" value="Chiros" ></p></div>
                        <div class="col-md-4"><p><input id="crius_btn" type="button" value="Crius" ></p></div> 
                        <div class="col-md-4"><p><input id="chimak_btn" type="button" value="Chimak" ></p></div>
                  </div>

                

                


                    <div class="row" id="Chiros_options" style="display:none;"> 
                       
                        <div class="col-md-6">
                                <label>Select the Products you are interested in:</label>
                                        
                                      <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="prod[]" value="med1">Chiros med 1<br>
                                            </label>
                                          </div>
                                     <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" name="prod[]" value="med2">Chiros med 2<br>
                                                </label>
                                     </div>

                                     <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="prod[]" value="med3">Chiros med 3<br>
                                            </label>
                                     </div>

                                     <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="prod[]" value="med4">Chiros med 4<br>
                                            </label>
                                    </div>

                                    <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="prod[]" value="med5">Chiros med 5<br>
                                            </label>
                                          </div>
                                     <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" name="prod[]" value="med6">Chiros med 6<br>
                                                </label>
                                     </div>

                                     <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="prod[]" value="med7">Chiros med 7<br>
                                            </label>
                                     </div>

                                     <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="prod[]" value="med8">Chiros med 8<br>
                                            </label>
                                    </div>


                                    <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="prod[]" value="med9">Chiros med 9<br>
                                            </label>
                                          </div>
                                     <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" name="prod[]" value="med10">Chiros med 10<br>
                                                </label>
                                     </div>
                                    </div>
                                     <div class="col-md-6">
                                            <label><br></label>

                                     <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="prod[]" value="med11">Chiros med 11<br>
                                            </label>
                                     </div>

                                     <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="prod[]" value="med12">Chiros med 12<br>
                                            </label>
                                    </div>

                                    <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="prod[]" value="med13">Chiros med 13<br>
                                            </label>
                                          </div>
                                     <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" name="prod[]" value="med14">Chiros med 14<br>
                                                </label>
                                     </div>

                                     <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="prod[]" value="med15">Chiros med 15<br>
                                            </label>
                                     </div>

                                     <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="prod[]" value="med16">Chiros med 16<br>
                                            </label>
                                    </div>

                                    <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="prod[]" value="med17">Chiros med 17<br>
                                            </label>
                                          </div>
                                     <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" name="prod[]" value="med18">Chiros med 18<br>
                                                </label>
                                     </div>

                                     <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="prod[]" value="med19">Chiros med 19<br>
                                            </label>
                                     </div>

                                     <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="prod[]" value="med20">Chiros med 20<br>
                                            </label>
                                    </div>
                                    <input type="button" onclick="alert(getCheckedCheckboxesFor('prod'));" value="Get Values" />

                            
                                          
                        </div>
                    </div>
  
                    <div class="row" id="Chimak_options" style ="display: none;" >
                             
                        <div class="col-md-6">
                                    
                                <label>Select the Products you are interested in:</label>
                                
                                          <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" name="prod1[]" value="med1">Chimak med 1<br>
                                                </label>
                                              </div>
                                         <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="prod1[]" value="med2">Chimak med 2<br>
                                                    </label>
                                         </div>
    
                                         <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" name="prod1[]" value="med3">Chimak med 3<br>
                                                </label>
                                         </div>
    
                                         <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" name="prod1[]" value="med4">Chimak med 4<br>
                                                </label>
                                        </div>
    
                                        <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" name="prod1[]" value="med5">Chimak med 5<br>
                                                </label>
                                              </div>
                                         <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="prod1[]" value="med6">Chimak med 6<br>
                                                    </label>
                                         </div>
    
                                         <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" name="prod1[]" value="med7">Chimak med 7<br>
                                                </label>
                                         </div>
    
                                         <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" name="prod1[]" value="med8">Chimak med 8<br>
                                                </label>
                                        </div>
    
    
                                        <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" name="prod1[]" value="med9">Chimak med 9<br>
                                                </label>
                                              </div>
                                         <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="prod1[]" value="med10">Chimak med 10<br>
                                                    </label>
                                         </div>
                                        </div>
                                         <div class="col-md-6">
                                                <label>
                                                    <br>
                                                </label>
                                              
    
                                         <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" name="prod1[]" value="med11">Chimak med 11<br>
                                                </label>
                                         </div>
    
                                         <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" name="prod1[]" value="med12">Chimak med 12<br>
                                                </label>
                                        </div>
    
                                        <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" name="prod1[]" value="med13">Chimak med 13<br>
                                                </label>
                                              </div>
                                         <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="prod1[]" value="med14">Chimak med 14<br>
                                                    </label>
                                         </div>
    
                                         <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" name="prod1[]" value="med15">Chimak med 15<br>
                                                </label>
                                         </div>
    
                                         <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" name="prod1[]" value="med16">Chimak med 16<br>
                                                </label>
                                        </div>
    
                                        <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" name="prod1[]" value="med17">Chimak med 17<br>
                                                </label>
                                              </div>
                                         <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="prod1[]" value="med18">Chimak med 18<br>
                                                    </label>
                                         </div>
    
                                         <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" name="prod1[]" value="med19">Chimak med 19<br>
                                                </label>
                                         </div>
    
                                         <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" name="prod1[]" value="med20">Chimak med 20<br>
                                                </label>
                                        </div>
    
                                
                                              
                            </div>
                        </div>
                        <div class="row" id="Crius_options" style="display:none;" >
                                   
                            <div class="col-md-6">

                                    <label>Select the Products you are interested in:</label>
                                       
                                    
                                    
                                              <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="prod2[]" value="med1">Crius med 1<br>
                                                    </label>
                                                  </div>
                                             <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="checkbox" name="prod2[]" value="med2">Crius med 2<br>
                                                        </label>
                                             </div>
        
                                             <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="prod2[]" value="med3">Crius med 3<br>
                                                    </label>
                                             </div>
        
                                             <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="prod2[]" value="med4">Crius med 4<br>
                                                    </label>
                                            </div>
        
                                            <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="prod2[]" value="med5">Crius med 5<br>
                                                    </label>
                                                  </div>
                                             <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="checkbox" name="prod2[]" value="med6">Crius med 6<br>
                                                        </label>
                                             </div>
        
                                             <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="prod2[]" value="med7">Crius med 7<br>
                                                    </label>
                                             </div>
        
                                             <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="prod2[]" value="med8">Crius med 8<br>
                                                    </label>
                                            </div>
        
        
                                            <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="prod2[]" value="med9">Crius med 9<br>
                                                    </label>
                                                  </div>
                                             <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="checkbox" name="prod2[]" value="med10">Crius med 10<br>
                                                        </label>
                                             </div>
                                            </div>
                                             <div class="col-md-6">
                                                    <label><br></label>
        
                                             <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="prod2[]" value="med11">Crius med 11<br>
                                                    </label>
                                             </div>
        
                                             <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="prod2[]" value="med12">Crius med 12<br>
                                                    </label>
                                            </div>
        
                                            <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="prod2[]" value="med13">Crius med 13<br>
                                                    </label>
                                                  </div>
                                             <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="checkbox" name="prod2[]" value="med14">Crius med 14<br>
                                                        </label>
                                             </div>
        
                                             <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="prod2[]" value="med15">Crius med 15<br>
                                                    </label>
                                             </div>
        
                                             <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="prod2[]" value="med16">Crius med 16<br>
                                                    </label>
                                            </div>
        
                                            <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="prod2[]" value="med17">Crius med 17<br>
                                                    </label>
                                                  </div>
                                             <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="checkbox" name="prod2[]" value="med18">Crius med 18<br>
                                                        </label>
                                             </div>
        
                                             <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="prod2[]" value="med19">Crius med 19<br>
                                                    </label>
                                             </div>
        
                                             <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="prod2[]" value="med20">Crius med 20<br>
                                                    </label>
                                            </div>
        
                                    
                                                  
                                </div>
                            </div>


                        

               <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">  
                          <p>
                              <label>Comments</label>
                              <textarea name="message" rows="7" id="message"></textarea>
                         </p>
                        </div>
                   </div>
               </div>




               <div class="row">
                   <div class="col-md-6">
                       <div class="form-group">
                            <p class="full">
                                    <label>Upload Visiting Card front</label>
                                    <input type="file" value="upload" id="vis1" name="vis1">
                                    <progress value="0" max="100" id="up1"></progress>
                                  </p>
                       </div>
                       <div class="form-group">
                            <p class="full">
                                    <label>Upload Visiting Card back</label>
                                    <input type="file" value="upload" id="vis2" name="vis2">
                                    <progress value="0" max="100" id="up2"></progress>
                                  </p>
                       </div>
                   </div>
                   <div class = "col-md-6">
                        <div class="form-group">
                                <p class="full">
                                        <label>Photo</label>
                                         <input type="file" value="upload" id="vis3" name="vis3">
                                         <progress value="0" max="100" id="up3"></progress>
                                      </p>
                           </div>
                   </div>
               </div>

               <div class="row">
                   <div class="col-md-12">
                <p class="full">  
                <button type="submit">Submit</button>
            </p>  
               </div>
            </div>




           </form>
        </div>
      </div>
  </div>

  <script src="index.js"></script>
 </body>
</html>