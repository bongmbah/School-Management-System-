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
    <link rel="stylesheet" href="css/schedule.css">
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
         <div class="admin-title">Course and Lecturer Schedule</div>
         <form action="" method="POST">
             <label>Level</label>
            <select class="level" name="level">
                <option>select</option>
                <option>HND1</option>
                <option>HND2</option>
                <option>DEGREE</option>
            </select><br>
            <span class="levelmsg" style="color: red"></span><br>
            <label class="semester-h">Semester</label><br>
            <div class="semester-value">
                <span class="phd"><input type="radio" value="1" name="semester" class="level" >1</span>
                <span class="master"><input type="radio" value="2" name="semester" class="level">2</span>
            </div>
            <div class="select">
                <label class="course">Course Code</label><br>
                <select name="course" class="course-value">
                </select> 
            </div>
            <div class="select">
                <label class="lecturer-h">Lecturer</label><br>
                <select name="lect" class="lect-value">
                    <?php
                       $query = "SELECT LECT_FNAME, LECT_LNAME FROM lecturer";
                       $result = $connect->query($query);
                       while($row = $result->fetch_assoc()){
                         
                    ?>
                     <option><?php echo $row['LECT_FNAME'].' '.$row['LECT_LNAME']; ?></option>
                    <?php
                       }
                    ?>
                    ?>
                </select> 
            </div>    
                <div class="message">
                   <?php
                       $sem = $_POST['semester'];
                       $code = $_POST['course'];
                       $lect = $_POST['lect'];
                       $date = date('Y-m-d');
                       $lectCode = '';
                       
                      if($_POST['submit']){
                        $j =0;
                        $level = $_POST['level'];
                        $fname = getfname($lect,$j);
                        $j = strlen($fname) + 1;
                        $lname = getlname($lect,$j);
                        $getlect = "SELECT LECT_CODE,LECT_FNAME,LECT_LNAME FROM lecturer WHERE LECT_FNAME = '$fname' AND LECT_LNAME = '$lname'";
                        $lectResult = $connect->query($getlect);
                        $row1 = $lectResult->fetch_assoc();
                        
                        $lectCode = $row1['LECT_CODE'];
                        if(empty($sem)){
                            echo "Please make sure you check the semester!";
                        }
                        else if($sem == 1 && strcmp($level ,"HND1") == 0){
                             $query1 = "INSERT INTO semester1_schedule VALUES ('$code','$lectCode','$date')";
                             if($connect->query($query1)){
                                echo "Course Successfully scheduled";
                             }else{
                                echo "An error Scheduling the course";
                             }
                        }
                        else if($sem == 2 && strcmp($level ,"HND1") == 0){
                              $query1 = "INSERT INTO semester2_schedule VALUES ('$code','$lectCode','$date')";
                              if($connect->query($query1)){
                                  echo "Course Successfully scheduled";
                              }else{
                                  echo "An error Scheduling the course";
                              }
                        }
                        else if($sem == 1 && strcmp($level ,"HND2") == 0){
                              $query1 = "INSERT INTO semester3_schedule VALUES ('$code','$lectCode','$date')";
                              if($connect->query($query1)){
                              echo "Course Successfully scheduled";
                              }else{
                              echo "An error Scheduling the course";
                              }
                        }
                        else if($sem == 2 && strcmp($level ,"HND2") == 0){
                              $query1 = "INSERT INTO semester4_schedule VALUES ('$code','$lectCode','$date')";
                              if($connect->query($query1)){
                                  echo "Course Successfully scheduled";
                              }else{
                                  echo "An error Scheduling the course";
                              }
                        }
                        else if($sem == 1 && strcmp($level ,"DEGREE") == 0){
                              $query1 = "INSERT INTO semester5_schedule VALUES ('$code','$lectCode','$date')";
                              if($connect->query($query1)){
                                  echo "Course Successfully scheduled";
                              }else{
                                  echo "An error Scheduling the course";
                              }
                        }
                        else if($sem == 2 && strcmp($level ,"DEGREE") == 0){
                              $query1 = "INSERT INTO semester6_schedule VALUES ('$code','$lectCode','$date')";
                              if($connect->query($query1)){
                                  echo "Course Successfully scheduled";
                              }else{
                                  echo "An error Scheduling the course";
                              }
                        }



                      }
                     
                   ?>

                  <?php
                       $querysem1 = "SELECT C_CODE FROM generalcourses WHERE SEMESTER = 1 AND Course_Level ='HND1' UNION SELECT C_CODE FROM departmentcourses WHERE SEMESTER = 1 AND Course_Level ='HND1'";
                       $querysem2 = "SELECT C_CODE FROM generalcourses WHERE SEMESTER = 2 AND Course_Level ='HND1' UNION SELECT C_CODE FROM departmentcourses WHERE SEMESTER = 2 AND Course_Level ='HND1'";
                       $querysem3 = "SELECT C_CODE FROM generalcourses WHERE SEMESTER = 1 AND Course_Level ='HND2' UNION SELECT C_CODE FROM departmentcourses WHERE SEMESTER = 1 AND Course_Level ='HND2'";
                       $querysem4 = "SELECT C_CODE FROM generalcourses WHERE SEMESTER = 2 AND Course_Level ='HND2' UNION SELECT C_CODE FROM departmentcourses WHERE SEMESTER = 2 AND Course_Level ='HND2'";
                       $querysem5 = "SELECT C_CODE FROM generalcourses WHERE SEMESTER = 1 AND Course_Level ='DEGREE' UNION SELECT C_CODE FROM departmentcourses WHERE SEMESTER = 1 AND Course_Level ='DEGREE'";
                       $querysem6 = "SELECT C_CODE FROM generalcourses WHERE SEMESTER = 2 AND Course_Level ='DEGREE' UNION SELECT C_CODE FROM departmentcourses WHERE SEMESTER = 2 AND Course_Level ='DEGREE'";
                       
                       //code for semester 1
                       $result1 = $connect->query($querysem1);
                       $codes1 = array();
                       $i=0;
                       while($row = $result1->fetch_assoc()){
                          $codes1[$i] = $row['C_CODE'];
                          $i++;
                       }

                     // code for semester 2
                        $result2 = $connect->query($querysem2);
                        $codes2 = array();
                        $i=0;
                        while($row = $result2->fetch_assoc()){
                            $codes2[$i] = $row['C_CODE'];
                            $i++;
                        }
                    //code for semester 3
                        $result3 = $connect->query($querysem3);
                        $codes3 = array();
                        $i=0;
                        while($row = $result3->fetch_assoc()){
                            $codes3[$i] = $row['C_CODE'];
                            $i++;
                        }
                    //code for semester 4
                        $result4 = $connect->query($querysem4);
                        $codes4 = array();
                        $i=0;
                        while($row = $result4->fetch_assoc()){
                            $codes4[$i] = $row['C_CODE'];
                            $i++;
                        }
                    //code for semester 5
                        $result5 = $connect->query($querysem5);
                        $codes5 = array();
                        $i=0;
                        while($row = $result5->fetch_assoc()){
                            $codes5[$i] = $row['C_CODE'];
                            $i++;
                        }
                    //code for semester 6
                        $result6 = $connect->query($querysem6);
                        $codes6 = array();
                        $i=0;
                        while($row = $result6->fetch_assoc()){
                            $codes6[$i] = $row['C_CODE'];
                            $i++;
                        }
                  ?>

                 <script>
                    var sems = document.querySelectorAll("input[name='semester']");
                    var courseCode = document.querySelector('.course-value');
                    var msg = document.querySelector('.message');
                    


                    var codes1 = <?php echo json_encode($codes1)?>;
                    var codes2 = <?php echo json_encode($codes2)?>;
                    var codes3 = <?php echo json_encode($codes3)?>;
                    var codes4 = <?php echo json_encode($codes4)?>;
                    var codes5 = <?php echo json_encode($codes5)?>;
                    var codes6 = <?php echo json_encode($codes6)?>;
                   
                    sems.forEach(sem =>{
                        sem.addEventListener('change',()=>{
                           let selected = document.querySelector("input[name='semester']:checked").value;
                           let level = document.querySelector('.level');
                            if(selected == 1 && level.value == "HND1"){
                               courseCode.innerHTML = '';
                               for(let i= 0; i< codes1.length;i++){
                                   courseCode.innerHTML += `<option>${codes1[i]}</option>`;
                               }
                           }
                           else if(selected == 2 && level.value == "HND1"){
                               courseCode.innerHTML = '';
                               for(let i= 0; i< codes2.length;i++){
                                   courseCode.innerHTML += `<option>${codes2[i]}</option>`;
                               }
                           }
                           else if(selected == 1 && level.value == "HND2"){
                               courseCode.innerHTML = '';
                               for(let i= 0; i< codes3.length;i++){
                                   courseCode.innerHTML += `<option>${codes3[i]}</option>`;
                               }
                           }
                           else if(selected == 2 && level.value == "HND2"){
                               courseCode.innerHTML = '';
                               for(let i= 0; i< codes4.length;i++){
                                   courseCode.innerHTML += `<option>${codes4[i]}</option>`;
                               }
                           }
                           else if(selected == 1 && level.value == "DEGREE"){
                               courseCode.innerHTML = '';
                               for(let i= 0; i< codes5.length;i++){
                                   courseCode.innerHTML += `<option>${codes5[i]}</option>`;
                               }
                           }
                           else if(selected == 2 && level.value == "DEGREE"){
                               courseCode.innerHTML = '';
                               for(let i= 0; i< codes6.length;i++){
                                   courseCode.innerHTML += `<option>${codes6[i]}</option>`;
                               }
                           }
                        });
                    }); 


                 </script>
                </div> 
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