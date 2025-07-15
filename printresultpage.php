<?php
  session_start();
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
    <link rel="stylesheet" href="css/printresult.css">
    <link rel="stylesheet" href="css/aside.css">
</head>
<body oncontextmenu="return true;" >
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
     
    <main id="content" class="content">
    <form  action="" method="post" class="heading">
            <div class="table-title">PRINT RESULT SHEET</div>
            <div action="" method="POST" class="table-credentials">
                <div>
                    <label>Level</label>
                    <select class="level" name="level">
                        <option>HND1</option>
                        <option>HND2</option>
                        <option>DEGREE</option>
                    </select>
                </div>
                <div>
                    <label>Department</label>
                    <select class="depart" name="departcode">
                        <option></option>
                        <?php
                            $get_departs = "SELECT DEPART_CODE FROM department";
                            $get_result = $connect->query($get_departs);
                            while($row= $get_result->fetch_assoc()){
                        ?>
                         <option><?php echo $row['DEPART_CODE'] ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div>
                    <label>Student</label>
                    <select class="students" name="student">
                    </select>
                </div>
                <div>
                    <label>Year</label>
                    <select>
                        <option>2022/2023</option>
                        <option>2023/2024</option>
                    </select>
                </div>
        </div>
        <?php
                           $studFNames = array();
                           $studLNames = array();
                           $studLevels = array();
                           $department = array();
                            $i =0;
                           $get_stud_fields = "SELECT STUD_LEVEL,STUD_FNAME,STUD_LNAME,DEPART_CODE FROM s_students";
                           $get_result = $connect->query($get_stud_fields);
                           while($row= $get_result->fetch_assoc()){
                             $studLevels[$i] = $row['STUD_LEVEL'];
                             $studFNames[$i] = $row['STUD_FNAME'];
                             $studLNames[$i] = $row['STUD_LNAME'];
                             $department[$i]  = $row['DEPART_CODE'];
                             $i++;
                           }
                           $i =0;

        ?>
        <div><input type="submit" class="preview" name="preview" value="Preview"></div>
    </form>
    <script>
           var fnames = <?=json_encode($studFNames)?>;
           var lnames = <?=json_encode($studLNames)?>;
           var levels = <?=json_encode($studLevels)?>;
           var department = <?=json_encode($department)?>;
           
           var depart = document.querySelector('.depart');
           var level = document.querySelector('.level');
           var students = document.querySelector('.students');

           depart.addEventListener('change',()=>{
            students.innerHTML = "";
              for(i=0;i<fnames.length;i++){
                   if(level.value !="" && depart.value != ""){
                        if(levels[i] == level.value && department[i] == depart.value){
                        students.innerHTML = students.innerHTML + '<option>' + fnames[i] +' '+ lnames[i] +'<option>';
                    }
                   }
               }  
           });
           level.addEventListener('change',()=>{
            students.innerHTML = "";
              for(i=0;i<fnames.length;i++){
                   if(level.value !="" && depart.value != ""){
                        if(levels[i] == level.value && department[i] == depart.value){
                        students.innerHTML = students.innerHTML + '<option>' + fnames[i] +' '+ lnames[i] +'<option>';
                    }
                   }
               }  
           });
    </script>
        <div class="print-logo">
             <div class="ministry-text">
                  <div>REPUBLIC DU CAMEROUN</div>
                  <div>********</div>
                  <div>Peace-Work-Fatherland</div>
                  <div>MINISTRE DE L'EMPLOI ET DE LA FORMATION <br>PROFESSIONELLES</div>
                  <div>SEE VISION COMPUTER VOCATIONAL HIGHER<br>
                       INSTITUTE OF TECHNOLOGY AND MANAGEMENT<br>(SEVICTI)
                  </div>
             </div>
             <div class="sevic-logo">
                 <img src="images/sevic-logo.png">
             </div>
             <div class="ministry-text">
                  <div>REPUBLIC OF CAMEROON</div>
                  <div>********</div>
                  <div>Peace-Work-Fatherland</div>
                  <div>MINISTRY OF EMPOYMENT AAND VOCATIONAL <br>TRAINING</div>
                  <div>SEE VISION COMPUTER VOCATIONAL HIGHER<br>
                       INSTITUTE OF TECHNOLOGY AND MANAGEMENT<br>(SEVICTI)
                  </div>
             </div>
        </div>
        <div class="minefob">
            ORDER &#8470 281/MINEFOP/SG/DFOP/SDGSF/SACD of 05 SEPT 2018<br>
            Email <span>sevicinstitude@gmail.com/sevicti@tech-center.com</span>
            Tel: (+237) 670692618/651657918/678444148/694526769
        </div>
        <div id="stud-info">
             <?php 
                  if($_POST['preview']){
                    $stud_name = $_POST['student'];
                    $j =0;
                    $fname = getfname($stud_name,$j);
                    $j = strlen($fname) + 1;
                    $lname = getlname($stud_name,$j);
                    $get_stud_fields = "SELECT * FROM s_students WHERE STUD_FNAME = '$fname' AND STUD_LNAME= '$lname'";
                    $get_result = $connect->query($get_stud_fields);
                    $row = $get_result->fetch_assoc();
                   
                    $get_stud_depart = "SELECT DEPART_OPTION FROM department WHERE DEPART_CODE = '{$row['DEPART_CODE']}'";
                    $depart_result = $connect->query($get_stud_depart);
                    $row_depart = $depart_result->fetch_assoc();
                    $matricule = $row['STUD_MATRICULE'];
                    $stud_field = $row['STUD_FIELD'];
                  }
             ?>
            <div class="stud-info1">
                <div class="flex1">
                    <strong>Discipline: <?php echo $row['STUD_FIELD']?></strong><br>
                    <span>Filliere: </span>
                </div>
                <div class="flex2">
                    <strong>Speciality: <?php echo $row['STUD_FIELD']?></strong><br>
                    <span>Specialite: </span>
                </div>
            </div>
            <div class="stud-info1">
                <div class="flex1">
                    <strong>Surname and Name: <?php echo $fname.' '.$lname?></strong><br>
                    <span>Nom et Prenoms: </span>
                </div>
                <div class="fle2">
                    <strong>Region: <?php echo $row['REGION']?></strong><br>
                    <span>Region d'origine: </span>
                </div>
                <div class="fle3">
                    <strong>Option: <?php echo $row_depart['DEPART_OPTION']?></strong><br>
                    <span>Gender: <?php echo $row['GENDER']?></span>
                </div>
            </div>
            <div class="stud-info1">
                <div class="flex1">
                    <strong>Date of Birth: <?php echo $row['DATE_OF_BIRTH']?></strong><br>
                    <span>Date de Naissance: </span>
                </div>
                <div class="flex2">
                    <strong>Nationality:<?php echo $row['NATIONALITY']?></strong><br>
                    <span>Nationalit&#233: </span>
                </div>
                <div class="flex3">
                    <strong>Place Of Birth: <?php echo $row['PLACE_OF_BIRTH']?></strong><br>
                    <span>Lieu De Naissance: </span>
                </div>
            </div>
            <div class="stud-info1">
                <div class="flex1">
                    <strong>Reg Number: <?php echo $row['ADMIN_MATRICULE']?></strong><br>
                    <span>Matricule: </span>
                </div>
                <div class="flex2">
                    <strong>Academic Year: 2023-2024</strong><br>
                    <span>Anne Academique: </span>
                </div>
                <div class="flex3">
                    <strong>Level: <?php echo $row['STUD_LEVEL']?></strong><br>
                    <span>Niveau: </span>
                </div>
            </div>
        </div>

        <div class="sem-title">FIRST SEMESTER</div>
        <div class="table-content">
            <table>
                <tr class="table-h">
                    <th class="course">Title</th>
                    <th class="score-t">Code</th>
                    <th class="score">Credit</th>
                    <th class="score">Credit Earn</th>
                    <th class="remark">Grade</th>
                    <th class="grade">Grade Point</th>

                </tr>
                <?php
                      $grade;
                      $point;
                      $credit_earn;
                      $sem1_avg=0;
                      $sem1_cre_att = 0;
                      $sem1_cre_earn = 0;
                      if($_POST['preview']){
                        $total_score=0;
                          if($_POST['level'] == "HND1"){
                            $get_stud_courses = "SELECT C_NAME,C_CODE,CREDIT FROM departmentcourses WHERE DEPART_CODE ='{$_POST['departcode']}' AND SEMESTER = 1
                                                 UNION
                                                 SELECT C_NAME,C_CODE,CREDIT FROM generalcourses WHERE (FIELD_LEVEL = 'GENERAL' OR FIELD_LEVEL='$stud_field') AND SEMESTER = 1";
                            $course_result = $connect->query($get_stud_courses);
                        
                            while($course_row = $course_result->fetch_assoc()){
                                $get_ca_score = "SELECT SCORE,STUD_MATRICULE FROM hnd1s1 WHERE EXAM_TYPE = 'CA' AND C_CODE = '{$course_row['C_CODE']}'  AND STUD_MATRICULE = '$matricule'";
                                $ca_result = $connect->query($get_ca_score);
                                $ca_row = $ca_result->fetch_assoc();

                                $get_exam_score = "SELECT SCORE,STUD_MATRICULE FROM hnd1s1 WHERE EXAM_TYPE = 'EXAM' AND C_CODE = '{$course_row['C_CODE']}' AND STUD_MATRICULE = '$matricule'";
                                $exam_result = $connect->query($get_exam_score);
                                $exam_row = $exam_result->fetch_assoc();
                                $total_score = $ca_row['SCORE'] + $exam_row['SCORE'] ;
                                $grade = getCourseGrade($total_score);
                                $point = determineGradePoint($grade);
                                $credit_earn = creditEarned($course_row['CREDIT'],$total_score);
                                $sem1_cre_earn = $sem1_cre_earn + $credit_earn;
                                $sem1_avg = $sem1_avg + (($total_score/5) * $course_row['CREDIT']);
                                $sem1_cre_att = $sem1_cre_att + $course_row['CREDIT'];
                            ?>
                                <tr class="td">
                                    <td class="course"><?php echo $course_row['C_NAME']?></td>
                                    <td class="score"><?php echo $course_row['C_CODE']?></td>
                                    <td class="score"><?php echo $course_row['CREDIT']?></td>
                                    <td class="score-t"><?php echo $credit_earn ?></td>
                                    <td class="remark"><?php echo $grade ?></td>
                                    <td class="grade"><?php echo $point?></td>
                                </tr>
                            <?php
                            }
                             
                          }
                          else if($_POST['level'] == "HND2"){
                            $get_stud_courses = "SELECT C_NAME,C_CODE,CREDIT FROM departmentcourses WHERE DEPART_CODE ='{$_POST['departcode']}' AND SEMESTER = 3
                                                 UNION
                                                 SELECT C_NAME,C_CODE,CREDIT FROM generalcourses WHERE (FIELD_LEVEL = 'GENERAL' OR FIELD_LEVEL='$stud_field') AND SEMESTER = 3";
                            $course_result = $connect->query($get_stud_courses);
                            while($course_row = $course_result->fetch_assoc()){
                                $get_ca_score = "SELECT SCORE FROM hnd2s1 WHERE EXAM_TYPE = 'CA' AND STUD_MATRICULE = '$matricule' AND C_CODE = '{$course_row['C_CODE']}'";
                                $ca_result = $connect->query($get_ca_score);
                                $ca_row = $ca_result->fetch_assoc();

                                $get_exam_score = "SELECT SCORE FROM hnd2s1 WHERE EXAM_TYPE = 'EXAM' AND STUD_MATRICULE = '$matricule' AND C_CODE = '{$course_row['C_CODE']}'";
                                $exam_result = $connect->query($get_exam_score);
                                $exam_row = $exam_result->fetch_assoc();
                                $total_score = $ca_row['SCORE'] + $exam_row['SCORE'] ;
                                $grade = getCourseGrade($total_score);
                                $point = determineGradePoint($grade);
                                $credit_earn = creditEarned($course_row['CREDIT'],$total_score);
                                $sem1_cre_earn = $sem1_cre_earn + $credit_earn;
                                $sem1_avg = $sem1_avg + (($total_score/5) * $course_row['CREDIT']);
                                $sem1_cre_att = $sem1_cre_att + $course_row['CREDIT'];
                            ?>
                                <tr class="td">
                                    <td class="course"><?php echo $course_row['C_NAME']?></td>
                                    <td class="score"><?php echo $course_row['C_CODE']?></td>
                                    <td class="score"><?php echo $course_row['CREDIT']?></td>
                                    <td class="score-t"><?php echo $credit_earn ?></td>
                                    <td class="remark"><?php echo $grade ?></td>
                                    <td class="grade"><?php echo $point?></td>
                                </tr>
                            <?php
                            }
                          }
                          else{
                             
                          }

                      }
                ?>
        </table>
        </div>
        <div class="gpa-avg-sec">
            <div class="gpa">Semester GPA/4: <?php 
             if($sem1_cre_att != 0){
                 echo  ($sem1_avg/$sem1_cre_att)/5;
             }
            ?></div>
            <div class="avg">Semester Average/20: <?php if($sem1_cre_att != 0){
                echo $sem1_avg/$sem1_cre_att;
            }?></div>
        </div>
        <div class="sem-title">SECOND SEMESTER</div>
        <div class="table-content">
            <table>
                <tr class="table-h">
                    <th class="course">Title</th>
                    <th class="score-t">Code</th>
                    <th class="score">Credit</th>
                    <th class="score">Credit Earn</th>
                    <th class="remark">Grade</th>
                    <th class="grade">Grade Point</th>

                </tr>
                <?php
                     
                      $grade;
                      $point;
                      $credit_earn;
                      $sem2_avg = 0;
                      $sem2_cre_att;
                      $sem2_cre_earn =0;
                      if($_POST['preview']){
                          $sem2_avg = 0;
                          $total_score=0 ;
                          if($_POST['level'] == "HND1"){
                            $get_stud_courses = "SELECT C_NAME,C_CODE,CREDIT FROM departmentcourses WHERE DEPART_CODE ='{$_POST['departcode']}' AND SEMESTER = 2
                                                 UNION
                                                 SELECT C_NAME,C_CODE,CREDIT FROM generalcourses WHERE (FIELD_LEVEL = 'GENERAL' OR FIELD_LEVEL='$stud_field') AND SEMESTER = 2";
                            $course_result = $connect->query($get_stud_courses);
                        
                            while($course_row = $course_result->fetch_assoc()){
                                $get_ca_score = "SELECT SCORE,STUD_MATRICULE FROM hnd1s2 WHERE EXAM_TYPE = 'CA' AND C_CODE = '{$course_row['C_CODE']}'  AND STUD_MATRICULE = '$matricule'";
                                $ca_result = $connect->query($get_ca_score);
                                $ca_row = $ca_result->fetch_assoc();

                                $get_exam_score = "SELECT SCORE,STUD_MATRICULE FROM hnd1s2 WHERE EXAM_TYPE = 'EXAM' AND C_CODE = '{$course_row['C_CODE']}' AND STUD_MATRICULE = '$matricule'";
                                $exam_result = $connect->query($get_exam_score);
                                $exam_row = $exam_result->fetch_assoc();
                                $total_score = $ca_row['SCORE'] + $exam_row['SCORE'] ;
                                $grade = getCourseGrade($total_score);
                                $point = determineGradePoint($grade);
                                $credit_earn = creditEarned($course_row['CREDIT'],$total_score);
                                $sem2_cre_earn = $sem2_cre_earn + $credit_earn;
                                $sem2_avg = $sem2_avg + (($total_score/5) * $course_row['CREDIT']);
                                $sem2_cre_att = $sem2_cre_att + $course_row['CREDIT'];
                            ?>
                                <tr class="td">
                                    <td class="course"><?php echo $course_row['C_NAME']?></td>
                                    <td class="score"><?php echo $course_row['C_CODE']?></td>
                                    <td class="score"><?php echo $course_row['CREDIT']?></td>
                                    <td class="score-t"><?php echo $credit_earn ?></td>
                                    <td class="remark"><?php echo $grade ?></td>
                                    <td class="grade"><?php echo $point?></td>
                                </tr>
                            <?php
                            }
                             
                          }
                          else if($_POST['level'] == "HND2"){
                            $get_stud_courses = "SELECT C_NAME,C_CODE,CREDIT FROM departmentcourses WHERE DEPART_CODE ='{$_POST['departcode']}' AND SEMESTER = 4
                                                 UNION
                                                 SELECT C_NAME,C_CODE,CREDIT FROM generalcourses WHERE (FIELD_LEVEL = 'GENERAL' OR FIELD_LEVEL='$stud_field') AND SEMESTER = 4";
                            $course_result = $connect->query($get_stud_courses);
                            while($course_row = $course_result->fetch_assoc()){
                                $get_ca_score = "SELECT SCORE FROM hnd2s2 WHERE EXAM_TYPE = 'CA' AND STUD_MATRICULE = '$matricule' AND C_CODE = '{$course_row['C_CODE']}'";
                                $ca_result = $connect->query($get_ca_score);
                                $ca_row = $ca_result->fetch_assoc();

                                $get_exam_score = "SELECT SCORE FROM hnd2s2 WHERE EXAM_TYPE = 'EXAM' AND STUD_MATRICULE = '$matricule' AND C_CODE = '{$course_row['C_CODE']}'";
                                $exam_result = $connect->query($get_exam_score);
                                $exam_row = $exam_result->fetch_assoc();
                                $total_score = $ca_row['SCORE'] + $exam_row['SCORE'] ;
                                $grade = getCourseGrade($total_score);
                                $point = determineGradePoint($grade);
                                $credit_earn = creditEarned($course_row['CREDIT'],$total_score);
                                $sem2_cre_earn = $sem2_cre_earn + $credit_earn;
                                $sem2_avg = $sem2_avg + (($total_score/5) * $course_row['CREDIT']);
                                $sem2_cre_att = $sem2_cre_att + $course_row['CREDIT'];
                            ?>
                                <tr class="td">
                                    <td class="course"><?php echo $course_row['C_NAME']?></td>
                                    <td class="score"><?php echo $course_row['C_CODE']?></td>
                                    <td class="score"><?php echo $course_row['CREDIT']?></td>
                                    <td class="score-t"><?php echo $credit_earn ?></td>
                                    <td class="remark"><?php echo $grade ?></td>
                                    <td class="grade"><?php echo $point?></td>
                                </tr>
                            <?php
                            }
                          }
                          else{
                             
                          }

                      }
                ?>
        </table>
        </div>
        <div class="gpa-avg-sec">
        <div class="gpa">Semester GPA/4: <?php echo ($sem2_avg/$sem2_cre_att)/5 ?></div>
            <div class="avg">Semester Average/20: <?php echo $sem2_avg/$sem2_cre_att?></div>
        </div>
        <div class="gpa-avg-sec">
            <div class="gpa">Annual Cumulative</div>
            <div class="avg">Credit Earn: <?php echo  $sem1_cre_earn + $sem2_cre_earn?></div>
            <div class="gpa">Average/20:<?php echo (((($sem1_avg/$sem1_cre_att)/5) + (($sem2_avg/$sem2_cre_att)/5))/2)  * 5?> </div>
            <div class="avg">GPA/4: <?php echo ((($sem1_avg/$sem1_cre_att)/5) + (($sem2_avg/$sem2_cre_att)/5))/2?></div>
        </div>
        <div class="dir-reg-sec">
            <div class="reg">Director</div>
            <div class="reg">Register</div>
        </div>
        <div class="warning">This transcript is not valid without the seal and signatures of the Director and the signature of the Administrative Assistant</div>
        <div class="print-button">
            <button class="print">Print</button>
        </div>
    </main>
    <script>
        var btn = document.querySelector('.print');
        btn.addEventListener('click',()=>{
              window.print();
        });
    </script>
    <aside id="aside" class="aside-action">
        <a href="department.php" id="A-add-stud-btn" class="flex">
            <button class="A-btn">
                <img src="images/departlogo.png" class="A-btn-icon"><br>
                <span class="A-btn-title">Department</span>
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
    </footer>
</body>
</html>