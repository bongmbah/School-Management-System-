<?php
  error_reporting(0);
  session_start();
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
    <link rel="stylesheet" href="css/lect_aside.css">
    <link rel="stylesheet" href="css/studresultpage.css">
    <link rel="stylesheet" href="css/printresult.css">

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
    <form action="" method="POST" class="heading">
        <div class="table-title"><?php echo  $_SESSION['stud_name'];?> RESULTS</div>
            <div class="table-credentials">
                <div>
                    <label>SEMESTER</label>
                    <select class="level" name="level">
                        <option>ALL</option>
                        <option>1</option>
                        <option>2</option>
                    </select>
                </div>
            </div>
            <input type="submit" class="print" value="Preview" name="preview">
     </form>
     <div class="sem-title"><?php 
               if($_POST['preview']){
                   if($_POST['level']== 1){
                       echo "SEMESTER 1 RESULTS";
                   }
                   else if($_POST['level']== 2){
                       echo "SEMESTER 2 RESULTS";
                   }else{
                       echo "ANNUAL RESULTS";
                   }
               }
     ?></div>
    <form action="" method="POST" class="table-content">
                    <table>
                        <tr class="table-h">
                            <th class="score-t">Course Name</th>
                            <th class="course">Course Code</th>
                            <th class="credit">Credits</th>
                            <th class="credit-e">CA/30</th>
                            <th class="grade-p">Exam/70</th>
                            <th class="grade-t">Total/100</th>
                            <th class="grade-p">Grade Point</th>
                            <th class="grade">Grade</th>

                        </tr>
                        <?php 
                           if($_POST['preview']){
                                    $matricule = $_SESSION['matricule'];
                                    //determine the stud level,depart and option
                                    $get_stud_info = "SELECT STUD_LEVEL,STUD_FIELD, DEPART_CODE FROM s_students WHERE STUD_MATRICULE = '$matricule'";
                                    $get_stud_result = $connect->query($get_stud_info);
                                    $row = $get_stud_result->fetch_assoc();

                                    //variables to determine the semster to be deleted
                                    $sem1;
                                    $sem2;
                                    if($row['STUD_LEVEL'] == "HND1"){$sem1 = 1; $sem2=2;}
                                    else{$sem1 = 3; $sem2=4;}
                                    
                            
                                    //check level to get data
                                    if($_POST['level'] == 1){
                                         // now get student courses for semester 1
                                        $get_stud_courses = "SELECT  C_NAME,C_CODE,CREDIT FROM departmentcourses WHERE DEPART_CODE = '{$row['DEPART_CODE']}' AND SEMESTER = '$sem1'
                                                             UNION
                                                             SELECT  C_NAME,C_CODE,CREDIT FROM generalcourses WHERE (FIELD_LEVEL = '{$row['STUD_FIELD']}' OR FIELD_LEVEL = 'GENERAL' ) AND SEMESTER = '$sem1'";
                                        $get_course_result = $connect->query($get_stud_courses);
                                        while($course = $get_course_result->fetch_assoc()){
                                            //get CA score
                                            $get_ca_score = "SELECT SCORE FROM hnd1s1 WHERE EXAM_TYPE = 'CA' AND C_CODE = '{$course['C_CODE']}' AND STUD_MATRICULE ='$matricule'";
                                            $get_ca_result = $connect->query($get_ca_score);
                                            $row_ca = $get_ca_result->fetch_assoc();
                                            
                                            //get  Exam score
                                            $get_exam_score = "SELECT SCORE FROM hnd1s1 WHERE EXAM_TYPE = 'Exam'  AND C_CODE = '{$course['C_CODE']}' AND STUD_MATRICULE ='$matricule'";
                                            $get_exam_result = $connect->query($get_exam_score);
                                            $row_exam = $get_exam_result->fetch_assoc();
    
                                            // some variables to hold data
                                            $ca = "-";
                                            $exam = "-";
                                            $total = "-";
                                            $point = "-";
                                            $grade = "-";
                                            //determine value for variables
                                            if(!empty($row_ca['SCORE'])){
                                                $ca = $row_ca['SCORE'];
                                                if(!empty($row_exam['SCORE'])){
                                                    $exam = $row_exam['SCORE'];
                                                    $total = intval($row_ca['SCORE']) + intval($row_exam['SCORE']);
                                                    $grade = getCourseGrade($total);
                                                    $point = determineGradePoint($grade);
                                                }
                                            }
    
                                ?>
                                            <tr>
                                                <td><?php echo $course['C_NAME']?></td>
                                                <td><?php echo $course['C_CODE']?></td>
                                                <td><?php echo $course['CREDIT']?></td>
                                                <td class="ca"><?php echo $ca?></td>
                                                <td class="exam"><?php echo $exam?></td>
                                                <td class="total"><?php echo $total?></td>
                                                <td class="point"><?php echo $point?></td>
                                                <td class="grad"><?php echo $grade?></td>
                                            </tr>
                                <?php
                                 } 

                                    }
                                    else if($_POST['level'] == 2){
                                         // now get student courses for semester 2
                                         $get_stud_courses = "SELECT  C_NAME,C_CODE,CREDIT FROM departmentcourses WHERE DEPART_CODE = '{$row['DEPART_CODE']}' AND SEMESTER = '$sem2'
                                                              UNION
                                                              SELECT  C_NAME,C_CODE,CREDIT FROM generalcourses WHERE (FIELD_LEVEL = '{$row['STUD_FIELD']}' OR FIELD_LEVEL = 'GENERAL' ) AND SEMESTER = '$sem2'";
                                         $get_course_result = $connect->query($get_stud_courses);

                                        while($course = $get_course_result->fetch_assoc()){
                                            //get CA score
                                            $get_ca_score = "SELECT SCORE FROM hnd1s2 WHERE EXAM_TYPE = 'CA' AND C_CODE = '{$course['C_CODE']}' AND STUD_MATRICULE ='$matricule'";
                                            $get_ca_result = $connect->query($get_ca_score);
                                            $row_ca = $get_ca_result->fetch_assoc();
                                            
                                            //get  Exam score
                                            $get_exam_score = "SELECT SCORE FROM hnd1s2 WHERE EXAM_TYPE = 'Exam'  AND C_CODE = '{$course['C_CODE']}' AND STUD_MATRICULE ='$matricule'";
                                            $get_exam_result = $connect->query($get_exam_score);
                                            $row_exam = $get_exam_result->fetch_assoc();
    
                                            // some variables to hold data
                                            $ca = "-";
                                            $exam = "-";
                                            $total = "-";
                                            $point = "-";
                                            $grade = "-";
                                            //determine value for variables
                                            if(!empty($row_ca['SCORE'])){
                                                $ca = $row_ca['SCORE'];
                                                if(!empty($row_exam['SCORE'])){
                                                    $exam = $row_exam['SCORE'];
                                                    $total = intval($row_ca['SCORE']) + intval($row_exam['SCORE']);
                                                    $grade = getCourseGrade($total);
                                                    $point = determineGradePoint($grade);
                                                }
                                            }
    
                                ?>
                                            <tr>
                                                <td><?php echo $course['C_NAME']?></td>
                                                <td><?php echo $course['C_CODE']?></td>
                                                <td><?php echo $course['CREDIT']?></td>
                                                <td class="ca"><?php echo $ca?></td>
                                                <td class="exam"><?php echo $exam?></td>
                                                <td class="total"><?php echo $total?></td>
                                                <td class="point"><?php echo $point?></td>
                                                <td class="grad"><?php echo $grade?></td>
                                            </tr>
                                <?php
                                 } 

                                    }
                                    else{
                                         // now get student courses for both semesters
                                         $get_stud_courses = "SELECT  C_NAME,C_CODE,CREDIT FROM departmentcourses WHERE DEPART_CODE = '{$row['DEPART_CODE']}' AND (SEMESTER = '$sem1' OR SEMESTER = '$sem2')
                                                              UNION
                                                              SELECT  C_NAME,C_CODE,CREDIT FROM generalcourses WHERE (FIELD_LEVEL = '{$row['STUD_FIELD']}' OR FIELD_LEVEL = 'GENERAL' ) AND (SEMESTER = '$sem1' OR SEMESTER = '$sem2')";
                                         $get_course_result = $connect->query($get_stud_courses);
                                        while($course = $get_course_result->fetch_assoc()){
                                            //get CA score
                                            $get_ca_score = "SELECT SCORE FROM hnd1s1 WHERE EXAM_TYPE = 'CA' AND C_CODE = '{$course['C_CODE']}' AND STUD_MATRICULE ='$matricule'
                                                            UNION SELECT SCORE FROM hnd1s2 WHERE EXAM_TYPE = 'CA' AND C_CODE = '{$course['C_CODE']}' AND STUD_MATRICULE ='$matricule'";
                                            $get_ca_result = $connect->query($get_ca_score);
                                            $row_ca = $get_ca_result->fetch_assoc();
                                            
                                            //get  Exam score
                                            $get_exam_score = "SELECT SCORE FROM hnd1s1 WHERE EXAM_TYPE = 'Exam'  AND C_CODE = '{$course['C_CODE']}' AND STUD_MATRICULE ='$matricule'
                                                            UNION SELECT SCORE FROM hnd1s2 WHERE EXAM_TYPE = 'Exam'  AND C_CODE = '{$course['C_CODE']}' AND STUD_MATRICULE ='$matricule'";
                                            $get_exam_result = $connect->query($get_exam_score);
                                            $row_exam = $get_exam_result->fetch_assoc();
    
                                            // some variables to hold data
                                            $ca = "-";
                                            $exam = "-";
                                            $total = "-";
                                            $point = "-";
                                            $grade = "-";
                                            //determine value for variables
                                            if(!empty($row_ca['SCORE'])){
                                                $ca = $row_ca['SCORE'];
                                                if(!empty($row_exam['SCORE'])){
                                                    $exam = $row_exam['SCORE'];
                                                    $total = intval($row_ca['SCORE']) + intval($row_exam['SCORE']);
                                                    $grade = getCourseGrade($total);
                                                    $point = determineGradePoint($grade);
                                                }
                                            }
    
                                ?>
                                            <tr>
                                                <td><?php echo $course['C_NAME']?></td>
                                                <td><?php echo $course['C_CODE']?></td>
                                                <td><?php echo $course['CREDIT']?></td>
                                                <td class="ca"><?php echo $ca?></td>
                                                <td class="exam"><?php echo $exam?></td>
                                                <td class="total"><?php echo $total?></td>
                                                <td class="point"><?php echo $point?></td>
                                                <td class="grad"><?php echo $grade?></td>
                                            </tr>
                                <?php
                                 } 

                                    }
                                   
                           
                                } 
                        ?>
                        
                    </table> 
            </form>
</main>

    <aside id="aside" class="aside-action">
                 <a href="studProfilePage.php" class="aside-stud-logo">
                        <!-- <img src="studentPhotos/<?php echo removeSpace($_SESSION['photo'])?>"> -->
                        <span class="A-btn-title"> <?php echo $_SESSION['stud_name']; ?></span>
                </a>
                 
                <a href="studResultPage.php" id="A-print-btn" class="lect-score-btn flex">
                    <button class="A-btn">
                        <img src="images/score.png" class="A-btn-icon"><br>
                        <span class="A-btn-title">View Results</span>
                    </button>
                </a>
                <a href="studAssignPage.php"  id="A-view-btn" class="lect-stat-btn flex">
                    <button class="A-btn">
                        <img src="images/aasignment.jpg" class="A-btn-icon"><br>
                        <span class="A-btn-title">Assigments</span>
                    </button>
                </a>  
    </aside>
    <script>
        var ca = document.querySelectorAll('.ca');
        var exam =document.querySelectorAll('.exam');
        var total =document.querySelectorAll('.total');
        var point = document.querySelectorAll('.point');
        var grad = document.querySelectorAll('.grad');
        var btn = document.querySelector('.print');
        btn.addEventListener('click',()=>{
            for(i=0;i<ca.length;i++){
               
           if(ca[i].value < 15){
              ca[i].style.color = "red";
           }
           else if(ca[i].value >= 15 && ca[i].value < 20){
              ca[i].style.color = "gray";
           }
           else if(ca[i].value > 75){
              ca[i].style.color = "green";
           }

           if(exam[i].value < 15){
              exam[i].style.color = "red";
           }
           else if(exam[i].value >= 15 && exam[i].value < 20){
              exam[i].style.color = "gray";
           }
           else if(exam[i].value > 75){
              exam[i].style.color = "green";
           }

           if(total[i].value < 15){
              total[i].style.color = "red";
           }
           else if(total[i].value >= 15 && total[i].value < 20){
              total[i].style.color = "gray";
           }
           else if(total[i].value > 75){
              total[i].style.color = "green";
           }
       }
        });
       
    </script>
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