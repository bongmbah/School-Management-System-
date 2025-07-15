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
    <link rel="stylesheet" href="css/depart.css">
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
         <div class="admin-title">Add Department</div>
         <form action="#" method="POST">
            <label class="semester-h">Field</label><br>
            <input type="text" placeholder="Field" class="code" name="field" required><br>
            <label class="semester-h">Option</label><br>
            <input type="text" placeholder="option" class="name" name="option" required>    
            <br><label class="semester-h">Department Code</label><br>
            <input type="text" placeholder="DepartCode" class="code" name="code" required>
            <div class="select">
                <label class="lecturer-h">HOD</label><br>
                <select name="hod" class="lect-value">
                  <?php
                    $querylect = "SELECT LECT_FNAME,LECT_LNAME FROM lecturer";
                    $lectresult = $connect->query($querylect);

                    while( $rows = $lectresult->fetch_assoc()){
                        echo '<option>'.$rows['LECT_FNAME'].' '.$rows['LECT_LNAME'].'</option>';
                    } 
                  ?>
                </select> 
            </div>    
            <div class="message">
            <?php
                if($_POST['submit']){
                    if($connect){
                        $query = "SELECT DEPART_CODE,DEPART_OPTION FROM department";
                        $result = $connect->query($query);
                        ;
                    
                        $field = strtoupper(filter_input(INPUT_POST,"field",FILTER_SANITIZE_SPECIAL_CHARS));
                        $option = strtoupper(filter_input(INPUT_POST,"option",FILTER_SANITIZE_SPECIAL_CHARS));
                        $code = strtoupper(filter_input(INPUT_POST,"code",FILTER_SANITIZE_SPECIAL_CHARS));
                        $hod = $_POST['hod'];
                        
                        $query = "INSERT INTO department VALUES ('$code','$hod','$field','$option')"; 
                        $codeExist =  0;
                        $optionExist = 0;

                       
                        while($row = $result->fetch_assoc()){
                            if($row['DEPART_OPTION'] == $option){
                                 $optionExist = 1;
                            }
                            if($row['DEPART_CODE'] == $code){
                                $codeExist = 1;
                            }
                        }

                        if($optionExist == 0){
                            if($codeExist == 0){
                                if($connect->query($query)){
                                    echo "Record added sucessfully";   
                                } 
                                else{
                                    echo "Record not successfully added";
                                }
                            }else{
                                echo "This code is already assigned to another option";
                            }
                        }else{
                            echo "This option already exist";
                        }
        
                }
                }
                   
                ?>
            </div> 
            <input type="submit" class="submit" value="Submit" name="submit">
            
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