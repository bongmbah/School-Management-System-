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
    <link rel="stylesheet" href="css/courses.css">
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
         <div class="admin-title">Add Course</div>
         <form action="" method="POST">
                <input type="text" placeholder="Course title" class="Fname" name="title" required><br>
                <input type="text" placeholder="Course Code" class="Lname" name="code" required>
                <input type="number" placeholder="Credit" class="email credit" name="credit" onke required>
                <input type="number" placeholder="Hour Duration" class="email" name="hours" required>


                <br><label class="h-cef">Semester</label><br>
                <div class="radio-value">
                    <span class="phd"><input type="radio" value="1" name="level" class="high-cet">1</span>
                    <span class="master"><input type="radio" value="2" name="level" class="high-cet">2</span>
                </div>
                <div class="select">
                    <label class="speciality">Field</label><br>
                    <select name="field" class="speciality-value">
                        <option>General</option>
                         <?php
                          $query = "SELECT DEPART_FIELD FROM department GROUP BY DEPART_FIELD";
                          $result = $connect->query($query);
                          while($row = $result->fetch_assoc()){
                          ?>
                           <option><?php echo $row['DEPART_FIELD'] ?></option>
                          <?php
                          }
                          ?>
                        
                    </select> <br>
                </div>
                <div class="select">
                    <label class="speciality">Course Level</label><br>
                    <select name="Courselevel" class="speciality-value">
                        <option>HND1</option>
                        <option>HND2</option>
                        <option>DEGREE</option>
                    </select> <br>
                </div>
                <div class="select">
                    <label class="speciality">Option</label><br>
                    <select name="option" class="speciality-value">
                        <option>General</option>
                         <?php
                          $query = "SELECT DEPART_CODE FROM department";
                          $result = $connect->query($query);
                          while($row = $result->fetch_assoc()){
                          ?>
                           <option><?php echo $row['DEPART_CODE'] ?></option>
                          <?php
                          }
                          ?>
                        ?>
                    </select> <br>
                </div>
                <div class="message">
                    <?php

                       $title = strtoupper(filter_input(INPUT_POST,"title",FILTER_SANITIZE_SPECIAL_CHARS));
                       $code = strtoupper(filter_input(INPUT_POST,"code",FILTER_SANITIZE_SPECIAL_CHARS));
                       $credit = filter_input(INPUT_POST,"credit",FILTER_VALIDATE_INT);
                       $hours = filter_input(INPUT_POST,"hours",FILTER_VALIDATE_INT);
                       $field = strtoupper($_POST['field']);
                       $option = strtoupper($_POST['option']);
                       $level = $_POST['level'];
                       $courseLevel = strtoupper($_POST['Courselevel']);
                       
                       $query2 = "SELECT C_CODE,C_NAME FROM departmentcourses";
                       $query3 = "SELECT C_CODE,C_NAME FROM generalcourses";

                       $titleExist = 0;
                       $codeExist = 0;
                       if($_POST['submit']){
                        if(!empty($option)){
                            if($option == "GENERAL"){
                                 $result1 = $connect->query($query3);
                                 while($row1 = $result1->fetch_assoc()){
                                      if($title == $row1['C_NAME']){
                                          $titleExist = 1;
                                      }
                                      if($code == $row1['C_CODE']){
                                          $codeExist = 1;
                                      }
                                 }
                                 if($titleExist !=0){
                                     echo "This course already exist in the system";
                                 }else{
                                     if($codeExist != 0){
                                         echo "This code has already been assigned to a course";
                                     }else{
                                         $query4 = "INSERT INTO generalcourses VALUES('$code','$title','$credit','$hours','$field','$level','$courseLevel')";
                                         if($connect->query($query4)){
                                            echo "Course Added successfully";
                                         }
                                         else{
                                            echo "Course not Added";
                                         }
  
                                     }
                                 }
                            }
                            else{
                              $result1 = $connect->query($query2);
                              while($row1 = $result1->fetch_assoc()){
                                   if($title == $row1['C_NAME']){
                                       $titleExist = 1;
                                   }
                                   if($code == $row1['C_CODE']){
                                       $codeExist = 1;
                                   }
                              }
                              if($titleExist !=0){
                                  echo "This code already exist in the system";
                              }else{
                                  if($codeExist != 0){
                                      echo "This code has already been assigned to a course";
                                  }else{
                                      $query4 = "INSERT INTO departmentcourses VALUES('$code','$title','$option','$credit','$hours','$level','$courseLevel')";
                                      if($connect->query($query4)){
                                         echo "Course Added successfully";
                                      }
                                      else{
                                         echo "Course not Added";
                                      }
  
                                  }
                              }
  
  
                            }
                         }
     

                       }
                     

                    ?>
                </div> 
                <script>
                    var credit = document.querySelector('.credit');
                    credit.addEventListener('mouseout', ()=>{
                         if(credit.value < 0 || credit.value > 5){
                             credit.value = 0;
                         }
                    });

                </script>
                <form action="submit" method="POST">
                   <input type="submit" class="submit" name="submit">
                </form>
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