<?php
  error_reporting(0);
  require_once "databaseconect.php";
  $connect = new mysqli($hostname,$username,$password,$database);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEVIC-HITM REPORT CARD SYSTEM </title>
    <link rel="icon" type="" href="images/sevic-logo.png" />
    <link rel="stylesheet" href="css/homepage.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/registerStud.css">
    <link rel="stylesheet" href="css/aside.css">
</head>
<body oncontextmenu="return true;" class="body-js body1">
   
    <header id="header" class="header">
        <div class="logo">
            <img src="images/sevic-logo.png"/>
        </div>
        <div class="title">
            <div class="h1">SEE VISION COMPUTERIZED HIGHER INSTITUTE OF TECHNOLOGY & MANAGEMENT</div>
            <div class="h3">SEVIC-HITM ONLINE REPORT CARD SYSTEM</div>
            <div class="h3 welcome">WELCOME TO THE ALKEBULAN</div>
        </div>
        <div class="logo">
           <img src="images/minesup-logo.jpg"/>
        </div>
    </header>
    <section id="login-form" class="admin-login-form show1">
         <div class="admin-title">Student credentials</div>
         <form action="" method="POST" enctype="multipart/form-data">
                <input type="text" placeholder="First Name" class="Fname" name="Fname" required><br>
                <input type="text" placeholder="Last name" class="Lname" name="Lname" required>
                <input type="email" placeholder="Email" class="email" name="email" required>
                <input type="phone" placeholder="Phone" class="phone" name="phone" required>
                <input type="text" placeholder="Nationality" class="phone" name="nationality" required>
                <input type="text" placeholder="Region" class="phone" name="region" required>
                <input type="text" placeholder="Place of Birth" class="email" name="pbirth" required>
                
                <br><label class="level-h">Date of Birth</label><br>
                <input type="date" placeholder="Date of Birth" class="email" name="dbirth" required>
                <div class="select">
                    <label class="speciality">Field of study</label><br>
                    <select name="field" class="speciality-value">
                        <?php
                          $query1 = "SELECT DEPART_FIELD FROM department GROUP BY DEPART_FIELD";
                          $result1 = $connect->query($query1);
                          while($row = $result1->fetch_assoc()){
                        ?>
                          <option><?php echo $row['DEPART_FIELD'] ?></option>
                        <?php      
                          }
                        ?>
                    </select> <br>
                </div>
                <div class="select">
                    <label class="speciality">Option</label><br>
                    <select name="option" class="speciality-value">
                        <?php
                          $query1 = "SELECT DEPART_OPTION FROM department";
                          $result1 = $connect->query($query1);
                          while($row = $result1->fetch_assoc()){
                        ?>
                          <option><?php echo $row['DEPART_OPTION'] ?></option>
                        <?php      
                          }
                        ?>
                    </select> <br>
                </div>
                <br><label class="level-h">Gender</label><br>
                <div class="radio-value">
                    <span class="phd"><input type="radio" value="M" name="gen" class="level">Male</span>
                    <span class="master"><input type="radio" value="F" name="gen" class="level">Female</span>
                </div>
                <label class="level-h">Level</label><br>
                <div class="radio-value">
                    <span class="phd"><input type="radio" value="HND1" name="level" class="level">HND 1</span>
                    <span class="master"><input type="radio" value="HND2" name="level" class="level">HND 2</span>
                    <span class="degree"><input type="radio" value="DEGREE" name="level" class="level">Degree</span>
                </div>

                <div>
                    <label class="file">A Level Certificate</label><br>
                    <input type="file" name="cet-file" class="filename" >
                </div>
                <div>
                    <label class="file">Photo</label><br>
                    <input type="file" name="photo" class="filename" >
                </div>

                <div class="message">
                <?php
                       $fname = strtoupper(filter_input(INPUT_POST,"Fname",FILTER_SANITIZE_SPECIAL_CHARS));
                       $lname = strtoupper(filter_input(INPUT_POST,"Lname",FILTER_SANITIZE_SPECIAL_CHARS));
                       $email = filter_input(INPUT_POST,"email",FILTER_VALIDATE_EMAIL);
                       $phone = strtoupper(filter_input(INPUT_POST,"phone",FILTER_VALIDATE_INT));
                       $nation = strtoupper(filter_input(INPUT_POST,"nationality",FILTER_SANITIZE_SPECIAL_CHARS));
                       $region = strtoupper(filter_input(INPUT_POST,"region",FILTER_SANITIZE_SPECIAL_CHARS));
                       $p_birth = strtoupper(filter_input(INPUT_POST,"pbirth",FILTER_SANITIZE_SPECIAL_CHARS));
                       $gen = $_POST['gen'];
                       $d_birth = strtoupper(filter_input(INPUT_POST,"dbirth",FILTER_SANITIZE_SPECIAL_CHARS));
                       $option = $_POST['option'];
                       $level = $_POST['level'];
                       $field = $_POST['field'];
                       $date = date("Y-m-d");

                       $cef_name = $_FILES['cet-file']['name'];
                       $cef_tmp_name = $_FILES['cet-file']['tmp_name'];
                       $cef_size = $_FILES['cet-file']['size'];
                       $cef_error = $_FILES['cet-file']['error'];

                       $photo_name = $_FILES['photo']['name'];
                       $photo_tmp_name = $_FILES['photo']['tmp_name'];
                       $photo_size = $_FILES['photo']['size'];
                       $photo_error = $_FILES['photo']['error'];
                      
                       if(isset($_POST['submit'])){
                          if(isset($_POST['level'])){
                                    if($cef_error !== 4){
                                        if($cef_size <= 1048576){
                                            $cef_ex = pathinfo($cef_name, PATHINFO_EXTENSION);
                                            $cef_ex = strtolower($cef_ex);
                                            $cef_valid_ex = array("pdf");
                                            if(in_array($cef_ex,$cef_valid_ex)){
                                                $cef_new_name = uniqid("PDF-",true).'.'.$cef_ex;
                                                $cef_path = 'StudCetificates/'.$cef_new_name;
                                                move_uploaded_file($cef_tmp_name,$cef_path);

                                                    if($photo_error !== 4){
                                                        if($photo_size <= 1048576){
                                                            $photo_ex = pathinfo($photo_name, PATHINFO_EXTENSION);
                                                            $photo_ex = strtolower($photo_ex);
                                                            $photo_valid_ex = array("tiff","png","jpg","jpeg");
                                                            if(in_array($photo_ex,$photo_valid_ex)){
                                                                $photo_new_name = uniqid("IMG-",true).'.'.$photo_ex;
                                                                $photo_path = 'studentPhotos/'.$photo_new_name;
                                                                move_uploaded_file($photo_tmp_name,$photo_path);

                                                                //get the department code
                                                                $get_Option_code = "SELECT DEPART_CODE FROM department WHERE DEPART_OPTION = '$option'";
                                                                $code_result = $connect->query($get_Option_code);
                                                                $code_record = $code_result->fetch_assoc();

                                                                //get last matricule
                                                                $get_matricule = "SELECT MAX(STUD_MATRICULE) AS MATRICULE FROM studentrequest";
                                                                $matricule_result = $connect->query($get_matricule);
                                                                $matricule_record = $matricule_result->fetch_assoc();
                                                                $matricule =  $matricule_record['MATRICULE'];
                                        
                                                                if ( $matricule == ""){$matricule = 1;}
                                                                else{$matricule = intval($matricule) + 1;}
                                                                
                                                                $code = $code_record['DEPART_CODE'];
                                                                // query to insert
                                                                $insert_info = "INSERT INTO studentrequest VALUES ('$matricule','$fname','$lname','$level',
                                                                             '$code','$phone','$email','$date','$cef_new_name', ' $photo_new_name','$field','$region','$p_birth','$d_birth','$nation','$gen')";
                                                                if($connect->query($insert_info)){
                                                                    echo "Student sucessfully regstered";
                                                                }
                                                                else {
                                                                    echo "Error in adding ";
                                                                }

                                                            }else{
                                                                echo "Please enter an image file ";
                                                            }
                        
                                                        }else{
                                                            echo "The file size of the photo is too large!";
                                                        }
                                                    } else{
                                                    echo "Please upload your photo";
                                                    }
                                            }
                                            else{
                                                echo "The certificate has to be a pdf file";
                                            }

                                        }else{
                                            echo "The file size of file is too large!";
                                        }
                                    } else{
                                    echo "Please upload the highest certificate you have";
                                    }


                                }
                                else{
                                     echo "Please check an  entry level";
                                }
  
                    }
                    
                ?>
                </div> 
                <input type="submit" class="submit" name="submit">
         </form>
        
    </section>
    <footer id= "footer" class="footer">
          <div class="contact">
             <div><span class="contact-color">Contact</span>: +(237) 653 462 818/679 256 797/694 907 536</div>
          </div>
          <div class="sevic-link">
              <a href="http://www.sevic-hitm.com">www.sevic-hitm.com</a>
          </div>
          <div class="location">
              <div class="div"><span class="location-color">Location</span>: Balace Obili-Yaounde</div>
              <div class="campus"><span class="campus-color">Campus B</span>: Carrefour Nkomo(behind boulangerie Fontana)</div>
          </div>
          <script>
            if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
            }
        </script>
    </footer>
</body>
</html>