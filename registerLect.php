<?php
  error_reporting(0);
  require_once "databaseconect.php";
  require_once "Dbfunctions.php";
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
    <link rel="stylesheet" href="css/registerLect.css">
    <link rel="stylesheet" href="css/aside.css">
</head>
<body oncontextmenu="return false;" class="body-js body1">
   
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
         <div class="admin-title">Lecturer credentials</div>
         <form action="" method="POST">
                <input type="text" placeholder="First Name" class="Fname" name="Fname" required><br>
                <input type="text" placeholder="Lname" class="Lname" name="Lname" required>
                <input type="email" placeholder="Email" class="email" name="email" required>
                <input type="phone" placeholder="Phone" class="phone" name="phone" required>
                <input type="text" placeholder="Lecturer access code" class="lect-code" name="lect-code" required>

                <br><label class="h-cef">Highest Certificate</label><br>
                <div class="radio-value">
                    <span class="phd"><input type="radio" value="PHD" name="high-cet" class="high-cet">Phd</span>
                    <span class="master"><input type="radio" value="Masters" name="high-cet" class="high-cet">Masters</span>
                    <span class="degree"><input type="radio" value="Degree" name="high-cet" class="high-cet">Degree</span>
                </div>
                <div class="select">
                    <label class="speciality">Speciality</label><br>
                    <select name="speciality" class="speciality-value">
                        <option>Programmer</option>
                        <option>Database Administrator</option>
                        <option>Project Manager</option>
                    </select> <br>
                </div>
                
                <div  class="select">
                    <label class="depart">Department</label><br>
                    <select name="depart-code" class="depart-value">
                            <?php
                               $query = "SELECT DEPART_CODE FROM department ";
                               $result = $connect->query($query);
                               while($row = $result->fetch_assoc()){
                                  echo '<option>'. $row['DEPART_CODE'].'</option>';
                               }
                            ?>
                    </select> 
                </div>
                <div class="message">
                     <?php
                            $getcode = "SELECT MAX(LECT_CODE) AS LAST_CODE FROM lecturer";
                            $getlect = "SELECT LECT_FNAME,LECT_LNAME,LECT_PASSWORD FROM lecturer";

                            $result2 = $connect->query($getcode);
                            $result3 = $connect->query($getlect);
                            $newcode;
                            $row = $result2->fetch_assoc();

                            $lastcode = $row['LAST_CODE'];
                            $newcode = intval($lastcode) + 1;
                     
                            $fname =  strtoupper(filter_input(INPUT_POST,"Fname",FILTER_SANITIZE_SPECIAL_CHARS));
                            $lname =  strtoupper(filter_input(INPUT_POST,"Lname",FILTER_SANITIZE_SPECIAL_CHARS));
                            $email =  filter_input(INPUT_POST,"email",FILTER_VALIDATE_EMAIL);
                            $phone = $_POST['phone'];
                            $pass = filter_input(INPUT_POST,"lect-code",FILTER_SANITIZE_SPECIAL_CHARS);
                            $cef = $_POST['high-cet'];
                            $spec = filter_input(INPUT_POST,"speciality",FILTER_SANITIZE_SPECIAL_CHARS);
                            $depart = filter_input(INPUT_POST,"depart-code",FILTER_SANITIZE_SPECIAL_CHARS);
                            $date = date("Y/m/d");
                            $lusername = strtolower($fname.$lname);
                            $queryinsert = "INSERT INTO lecturer VALUES ('$newcode','$fname','$lname','$spec','$depart','$phone','$email','$cef','$date','$pass','$lusername')"; 
                            $checklect = 0;
                            $checkpass = 0;

                            while( $row2 = $result3->fetch_assoc()){
                                if((strtoupper($row2['LECT_FNAME']) == $fname) && (strtoupper($row2['LECT_LNAME']) == $lname)){
                                    $checklect = 1;
                                }
                                if($row2['LECT_PASSWORD'] == $pass){
                                    $checkpass = 1;
                                }
                            }


                            if(empty($fname) || empty($lname) || empty($email) || empty($pass) || empty($phone) || empty($cef) || empty($spec) || empty($depart)){
                               
                            }else{
                                    if($checklect != 0){
                                         echo "Sorry this lecturer still exist in the system";
                                    }
                                    else{
                                        if($check != 0){
                                            echo "Yo've given this password to lecturer already";
                                        }else{
                                            if($connect->query($queryinsert)){
                                                echo "Successfully Registered";
                                            }
                                            else{
                                                echo "An Error your input fields";
                                            }
                                        }
                                    }
                            }
                     ?>
                </div> 
                <button class="submit">Submit</button>
         </form>
         
    </section>
    <aside id="aside" class="aside-action">
            <a href="department.php" id="A-add-stud-btn" class="flex">
                <button class="A-btn">
                    <img src="images/departlogo.png" class="A-btn-icon"><br>
                    <span class="A-btn-title">Depart<br>ment</span>
                </button>
            </a>

            <a href="registerLect.php" id="A-add-lect-btn" class="flex">
                <button class="A-btn">
                    <img src="images/lectlogo.jpg" class="A-btn-icon"><br>
                    <span class="A-btn-title">Add Lecturer</span>
                </button> 
            </a>
            <a href="addCourse.php" id="A-add-cour-btn" class="flex">
                <button class="A-btn">
                    <img src="images/courselogo.jpg" class="A-btn-icon"><br>
                    <span class="A-btn-title">Courses</span>
                </button>
            </a>
            <a href="schedule.php" id="A-sch-btn" class="flex">
                <button class="A-btn" >
                    <img src="images/schedulelogo.png" class="A-btn-icon"><br>
                    <span class="A-btn-title">Schedule Lecturers</span>
                </button>
            </a>
            <a href="printresultpage.php" id="A-print-btn" class="flex">
                <button class="A-btn">
                    <img src="images/printlogo.png" class="A-btn-icon"><br>
                    <span class="A-btn-title">Print Result</span>
                </button>
            </a>
            <a href="#" id="A-view-btn" class="flex">
                <button class="A-btn">
                    <img src="images/statslogo.jpg" class="A-btn-icon"><br>
                    <span class="A-btn-title">Result Statistics</span>
                </button>
            </a>
    </aside>
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