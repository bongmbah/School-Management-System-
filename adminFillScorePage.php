<?php
  session_start();
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
    <link rel="stylesheet" href="css/recordmark.css">
    <link rel="stylesheet" href="css/lect_aside.css">
    <script>
          //location.reload();
    </script>
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
       <div>
            <?php
                //$lect_code = $_SESSION['code'];
               //get courses lecturer teaches for HND1 semester 1
                $sem1_course_query = "SELECT C_NAME FROM departmentcourses WHERE Course_Level = 'HND1' AND SEMESTER = 1 UNION
                                      SELECT C_NAME FROM generalcourses WHERE Course_Level = 'HND1' AND SEMESTER = 1";
                $sem1_course_result = $connect->query($sem1_course_query);
                $hnd1sem1_courses = array();        
                 $i = 0;
                while($sem1_course_rows = $sem1_course_result->fetch_assoc()){
                     $hnd1sem1_courses[$i] = $sem1_course_rows['C_NAME'];
                     $i =$i + 1;
                }

                //get courses lecturer teaches for HND1 semester 2
                $sem2_course_query = "SELECT C_NAME FROM departmentcourses WHERE Course_Level = 'HND1' AND SEMESTER = 2 UNION
                                      SELECT C_NAME FROM generalcourses WHERE Course_Level = 'HND1' AND SEMESTER = 2";
                $sem2_course_result = $connect->query($sem2_course_query);
                $hnd1sem2_courses = array();        
                 $i = 0;
                while($sem2_course_rows = $sem2_course_result->fetch_assoc()){
                     $hnd1sem2_courses[$i] = $sem2_course_rows['C_NAME'];
                     $i =$i + 1;
                }

                //get courses lecturer teaches for HND2 semester 1
                $sem3_course_query =  "SELECT C_NAME FROM departmentcourses WHERE Course_Level = 'HND2' AND SEMESTER = 1 UNION
                                       SELECT C_NAME FROM generalcourses WHERE Course_Level = 'HND2' AND SEMESTER = 1";
                $sem3_course_result = $connect->query($sem3_course_query);
                $hnd2sem1_courses = array();        
                 $i = 0;
                while($sem3_course_rows = $sem3_course_result->fetch_assoc()){
                     $hnd2sem1_courses[$i] = $sem3_course_rows['C_NAME'];
                     $i =$i + 1;
                }
                //get courses lecturer teaches for HND2 semester 2
                $sem4_course_query =  "SELECT C_NAME FROM departmentcourses WHERE Course_Level = 'HND2' AND SEMESTER = 2 UNION
                                       SELECT C_NAME FROM generalcourses WHERE Course_Level = 'HND2' AND SEMESTER = 2";
                $sem4_course_result = $connect->query($sem4_course_query);
                $hnd2sem2_courses = array();        
                 $i = 0;
                while($sem4_course_rows = $sem4_course_result->fetch_assoc()){
                     $hnd2sem2_courses[$i] = $sem4_course_rows['C_NAME'];
                     $i =$i + 1;
                }

                //get courses lecturer teaches for Degree semester 1
                $sem5_course_query =  "SELECT C_NAME FROM departmentcourses WHERE Course_Level = 'DEGREE' AND SEMESTER = 1 UNION
                                       SELECT C_NAME FROM generalcourses WHERE Course_Level = 'DEGREE' AND SEMESTER = 1";
                $sem5_course_result = $connect->query($sem5_course_query);
                $degreesem1_courses = array();        
                 $i = 0;
                while($sem5_course_rows = $sem5_course_result->fetch_assoc()){
                     $degreesem1_courses[$i] = $sem5_course_rows['C_NAME'];
                     $i =$i + 1;
                }

                //get courses lecturer teaches for Degree semester 2
                $sem6_course_query =  "SELECT C_NAME FROM departmentcourses WHERE Course_Level = 'DEGREE' AND SEMESTER = 2 UNION
                                       SELECT C_NAME FROM generalcourses WHERE Course_Level = 'DEGREE' AND SEMESTER = 2";
                $sem6_course_result = $connect->query($sem6_course_query);
                $degreesem2_courses = array();        
                 $i = 0;
                while($sem6_course_rows = $sem6_course_result->fetch_assoc()){
                     $degreesem2_courses[$i] = $sem6_course_rows['C_NAME'];
                     $i =$i + 1;
                }

                 //get courses lecturer teaches for HND2 semester 4
                //  $sem4_course_query =  "SELECT departmentcourses.C_NAME FROM departmentcourses INNER JOIN semester4_schedule   
                //                         ON(departmentcourses.C_CODE = semester4_schedule.C_CODE) WHERE semester4_schedule.LECT_CODE = '$lect_code' UNION
                //                         SELECT generalcourses.C_NAME FROM generalcourses INNER JOIN semester4_schedule   
                //                         ON(generalcourses.C_CODE = semester4_schedule.C_CODE) WHERE semester4_schedule.LECT_CODE  = '$lect_code'";
                //  $sem4_course_result = $connect->query($sem4_course_query);
                //  $sem4_courses = array();        
                //   $i = 0;
                //  while($sem4_course_rows = $sem4_course_result->fetch_assoc()){
                //       $sem4_courses[$i] = $sem4_course_rows['C_NAME'];
                //       $i =$i + 1;
                //  }
                 
           ?>
        </div><br>
        <form action="" class="heading" method="POST">
            <div class="table-title">EXAM\CA SCORE FILL SHEET</div>
            <div class="table-credentials">
                <div>
                    <label>Exam type</label>
                    <select class="type" name="examtype">
                        <option>CA</option>
                        <option>Exam</option>
                    </select>
                </div>
                <div>
                    <label>Level</label>
                    <select class="level" name="level">
                       <option>select</option>
                    <?php 


        /*
                             $getsem_depart = "SELECT departmentcourses.SEMESTER FROM departmentcourses INNER JOIN semester1_schedule ON
                              (departmentcourses.C_CODE = semester1_schedule.C_CODE) WHERE semester1_schedule.LECT_CODE='$lect_code' UNION 
                              SELECT departmentcourses.SEMESTER FROM departmentcourses INNER JOIN semester2_schedule ON 
                              (departmentcourses.C_CODE = semester2_schedule.C_CODE) WHERE semester2_schedule.LECT_CODE='$lect_code' UNION 
                             SELECT departmentcourses.SEMESTER FROM departmentcourses INNER JOIN semester3_schedule ON 
                             (departmentcourses.C_CODE = semester3_schedule.C_CODE) WHERE semester3_schedule.LECT_CODE='$lect_code'UNION 
                             SELECT departmentcourses.SEMESTER FROM departmentcourses INNER JOIN semester4_schedule ON
                              (departmentcourses.C_CODE = semester4_schedule.C_CODE) WHERE semester4_schedule.LECT_CODE='$lect_code' GROUP BY departmentcourses.SEMESTER ";
                            
                             $getsem_gen = "SELECT generalcourses.SEMESTER FROM generalcourses INNER JOIN semester1_schedule ON
                             (generalcourses.C_CODE = semester1_schedule.C_CODE) WHERE semester1_schedule.LECT_CODE='$lect_code' UNION 
                             SELECT generalcourses.SEMESTER  FROM generalcourses  INNER JOIN semester2_schedule ON 
                             (generalcourses.C_CODE = semester2_schedule.C_CODE) WHERE semester2_schedule.LECT_CODE='$lect_code' UNION 
                            SELECT generalcourses.SEMESTER FROM generalcourses  INNER JOIN semester3_schedule ON 
                            (generalcourses.C_CODE= semester3_schedule.C_CODE) WHERE semester3_schedule.LECT_CODE='$lect_code'UNION 
                            SELECT generalcourses.SEMESTER FROM generalcourses  INNER JOIN semester4_schedule ON
                             (generalcourses.C_CODE = semester4_schedule.C_CODE) WHERE semester4_schedule.LECT_CODE='$lect_code' GROUP BY generalcourses.SEMESTER ";
                            
                            $semesters = array();
                            $j=0;
                            $getsem_depart_result = $connect->query($getsem_depart);
                            while($rows = $getsem_depart_result->fetch_assoc()){
                                $semesters[$j] = $rows['SEMESTER'];
                                $j = $j + 1;
                            }

                            $getsem_gen_result = $connect->query($getsem_gen);
                            while($rows = $getsem_gen_result->fetch_assoc()){
                                if(!in_array($rows['SEMESTER'],$semesters)){
                                    $semesters[$j] = $rows['SEMESTER'];
                                }
                                
                                $j = $j + 1;
                            }
                    ?>
                    <?php
                        $m = 0;
                       while($value = $semesters[$m]){
                         $c_level;
                        if($value == 1){
                           $c_level = "HND 1 semester 1";
                        }
                        else if($value == 2){
                            $c_level = "HND 1 semester 2";
                        }
                        else if($value == 3){
                            $c_level = "HND 2 semester 1";
                        }
                        else if($value == 4){
                            $c_level = "HND 2 semester 2";
                        }
                        else if($value == 5){
                            $c_level = "DEGREE semester 1";
                        }
                        else if($value == 6){
                            $c_level = "DEGREE semester 2";
                        }
                    */




                    
                    ?>
                      <option>HND 1 semester 1</option>
                      <option>HND 1 semester 2</option>
                      <option>HND 2 semester 1</option>
                      <option>HND 2 semester 2</option>
                      <option>DEGREE semester 1</option>
                      <option>DEGREE semester 2</option>
                      
                    </select>
                </div>
                <div>
                    <label>Course</label>
                    <select class="course" name="course">
                        
                    </select>
                    <div class="error-message" style="color:red"></div>
                </div>
                <div>
                    <label>Year</label>
                    <select>
                        <option>2022/2023</option>
                        <option>2023/2024</option>
                    </select>
                </div>
            </div>
            <div class="print-button">
                <input type="submit" class="fillscore print" name="fillscore" value="Fill Score">
            </div>
        </form>
        <form action="" method="POST" class="table-content">
            <table>
                <tr class="table-h">
                    <th class="name">Name</th>
                    <th class="score">Score</th>
                    <th class="remark">Remark</th>
                </tr>
                     <?php
                        // values could not be gotten through button, click so i used session to the values
                        if($_POST['fillscore']){
                            $level = $_POST['level'];
                            $course = $_POST['course'];
                            $_SESSION['course'] = $course;
                            $_SESSION['level'] = $level;
                            $_SESSION['examtype'] = $_POST['examtype'];
                            $_SESSION['fnames'] = array();
                            $_SESSION['lnames'] = array();

                            if($level == "HND 1 semester 1" || $level == "HND 1 semester 2" ){
                                  
                                  $checkgen = "SELECT C_NAME,FIELD_LEVEL FROM generalcourses WHERE C_NAME = '$course'";
                                  $checkgen_result = $connect->query($checkgen);
                                  $checkgen_record = $checkgen_result->fetch_assoc();
                                  $level1 = $level;
                                  if(!empty($checkgen_record['C_NAME'])){
                                    if($checkgen_record['FIELD_LEVEL'] == "GENERAL"){
                                        $get_stud = "SELECT STUD_FNAME,STUD_LNAME FROM s_students WHERE STUD_LEVEL ='HND1'";
                                        $get_stud_result = $connect->query($get_stud);
                                        $i =0;
                                        while($rows = $get_stud_result->fetch_assoc()){
                                             $_SESSION['fnames'][$i] =  $rows['STUD_FNAME'];
                                             $_SESSION['lnames'][$i] = $rows['STUD_LNAME'];
                                             $i++;
                                            ?>  
                                              <tr class="td">
                                                      <td class="name">    
                                                         <label class="Fname" name="fnames[]"><?php echo $rows['STUD_FNAME'].' '?></label>
                                                         <label class="Lname" name="lnames[]"><?php echo $rows['STUD_LNAME']?></label>
                                                      </td>
                                                      <td class="score-value"><input type="number" class="score-input" name="score[]"></td>
                                                      <td class="remark-td">---</td>
                                             </tr>
                                             <?php }
                                    }
                                    else{
                                        $get_stud = "SELECT STUD_FNAME,STUD_LNAME FROM s_students WHERE STUD_LEVEL ='HND1' AND STUD_FIELD = '{$checkgen_record['FIELD_LEVEL']}'";
                                        $get_stud_result = $connect->query($get_stud);
                                        
                                        $i =0;
                                        while($rows = $get_stud_result->fetch_assoc()){
                                            $_SESSION['fnames'][$i] =  $rows['STUD_FNAME'];
                                            $_SESSION['lnames'][$i] = $rows['STUD_LNAME'];
                                             $i++;
                                            ?>  
                                              <tr class="td">
                                                      <td class="name">    
                                                         <label class="Fname" name="fnames[]"><?php echo $rows['STUD_FNAME'].' '?></label>
                                                         <label class="Lname" name="lnames[]"><?php echo $rows['STUD_LNAME']?></label>
                                                      </td>
                                                      <td class="score-value"><input type="number" class="score-input" name="score[]"></td>
                                                      <td class="remark-td">---</td>
                                             </tr>
                                             <?php  }

                                    }
                                  }
                                  else{
                                        $getdepart = "SELECT C_NAME,DEPART_CODE FROM departmentcourses WHERE C_NAME = '$course'";
                                        $getdepart_result = $connect->query($getdepart);
                                        $getdepart_record = $getdepart_result->fetch_assoc();


                                        $get_stud = "SELECT STUD_FNAME,STUD_LNAME FROM s_students WHERE STUD_LEVEL ='HND1' AND DEPART_CODE = '{$getdepart_record['DEPART_CODE']}'";
                                        $get_stud_result = $connect->query($get_stud);
                                        
                                        $i =0;
                                        while($rows = $get_stud_result->fetch_assoc()){
                                            $_SESSION['fnames'][$i] =  $rows['STUD_FNAME'];
                                            $_SESSION['lnames'][$i] = $rows['STUD_LNAME'];
                                             $i++;
                                            ?>  
                                              <tr class="td">
                                                      <td class="name">    
                                                         <label class="Fname" name="fnames[]"><?php echo $rows['STUD_FNAME'].' '?></label>
                                                         <label class="Lname" name="lnames[]"><?php echo $rows['STUD_LNAME']?></label>
                                                      </td>
                                                      <td class="score-value"><input type="number" class="score-input" name="score[]"></td>
                                                      <td class="remark-td">---</td>
                                             </tr>   
                                             <?php }

                                  }
                            }
                            else if($level == "HND 2 semester 1" || $level == "HND 2 semester 2"){
                                $checkgen = "SELECT C_NAME,FIELD_LEVEL FROM generalcourses WHERE C_NAME = '$course'";
                                $checkgen_result = $connect->query($checkgen);
                                $checkgen_record = $checkgen_result->fetch_assoc();

                                if(!empty($checkgen_record['C_NAME'])){
                                  if($checkgen_record['FIELD_LEVEL'] == "GENERAL"){
                                      $get_stud = "SELECT STUD_FNAME,STUD_LNAME FROM s_students WHERE STUD_LEVEL ='HND2'";
                                      $get_stud_result = $connect->query($get_stud);
                                      $i =0;
                                      while($rows = $get_stud_result->fetch_assoc()){
                                        $_SESSION['fnames'][$i] =  $rows['STUD_FNAME'];
                                        $_SESSION['lnames'][$i] = $rows['STUD_LNAME'];
                                           $i++;
                                          ?>  
                                            <tr class="td">
                                                    <td class="name">    
                                                       <label class="Fname" name="fnames[]"><?php echo $rows['STUD_FNAME'].' '?></label>
                                                       <label class="Lname" name="lnames[]"><?php echo $rows['STUD_LNAME']?></label>
                                                    </td>
                                                    <td class="score-value"><input type="number" class="score-input" name="score[]"></td>
                                                    <td class="remark-td">---</td>
                                           </tr>
                                         <?php }
                                  }
                                  else{
                                      $get_stud = "SELECT STUD_FNAME,STUD_LNAME FROM s_students WHERE STUD_LEVEL ='HND2' AND STUD_FIELD = '{$checkgen_record['FIELD_LEVEL']}'";
                                      $get_stud_result = $connect->query($get_stud);
                                      
                                        $i =0;
                                        while($rows = $get_stud_result->fetch_assoc()){
                                            $_SESSION['fnames'][$i] =  $rows['STUD_FNAME'];
                                            $_SESSION['lnames'][$i] = $rows['STUD_LNAME'];
                                             $i++;
                                            ?>  
                                              <tr class="td">
                                                      <td class="name">    
                                                         <label class="Fname" name="fnames[]"><?php echo $rows['STUD_FNAME'].' '?></label>
                                                         <label class="Lname" name="lnames[]"><?php echo $rows['STUD_LNAME']?></label>
                                                      </td>
                                                      <td class="score-value"><input type="number" class="score-input" name="score[]"></td>
                                                      <td class="remark-td">---</td>
                                             </tr>
                                         <?php }

                                  }
                                }
                                else{
                                      $getdepart = "SELECT C_NAME,DEPART_CODE FROM departmentcourses WHERE C_NAME = '$course'";
                                      $getdepart_result = $connect->query($getdepart);
                                      $getdepart_record = $getdepart_result->fetch_assoc();


                                      $get_stud = "SELECT STUD_FNAME,STUD_LNAME FROM s_students WHERE STUD_LEVEL ='HND2' AND DEPART_CODE = '{$getdepart_record['DEPART_CODE']}'";
                                      $get_stud_result = $connect->query($get_stud);
                                      
                                      $i =0;
                                        while($rows = $get_stud_result->fetch_assoc()){
                                            $_SESSION['fnames'][$i] =  $rows['STUD_FNAME'];
                                            $_SESSION['lnames'][$i] = $rows['STUD_LNAME'];
                                             $i++;
                                            ?>  
                                              <tr class="td">
                                                      <td class="name">    
                                                         <label class="Fname" name="fnames[]"><?php echo $rows['STUD_FNAME'].' '?></label>
                                                         <label class="Lname" name="lnames[]"><?php echo $rows['STUD_LNAME']?></label>
                                                      </td>
                                                      <td class="score-value"><input type="number" class="score-input" name="score[]"></td>
                                                      <td class="remark-td">---</td>
                                             </tr>
                                   <?php   }

                                }

                            }
                            if($level == "DEGREE semester 1" || $level == "DEGREE semester 2" ){
                                  
                                  $checkgen = "SELECT C_NAME,FIELD_LEVEL FROM generalcourses WHERE C_NAME = '$course'";
                                  $checkgen_result = $connect->query($checkgen);
                                  $checkgen_record = $checkgen_result->fetch_assoc();
                                  $level1 = $level;
                                  if(!empty($checkgen_record['C_NAME'])){
                                    if($checkgen_record['FIELD_LEVEL'] == "GENERAL"){
                                        $get_stud = "SELECT STUD_FNAME,STUD_LNAME FROM s_students WHERE STUD_LEVEL ='DEGREE'";
                                        $get_stud_result = $connect->query($get_stud);
                                        $i =0;
                                        while($rows = $get_stud_result->fetch_assoc()){
                                             $_SESSION['fnames'][$i] =  $rows['STUD_FNAME'];
                                             $_SESSION['lnames'][$i] = $rows['STUD_LNAME'];
                                             $i++;
                                            ?>  
                                              <tr class="td">
                                                      <td class="name">    
                                                         <label class="Fname" name="fnames[]"><?php echo $rows['STUD_FNAME'].' '?></label>
                                                         <label class="Lname" name="lnames[]"><?php echo $rows['STUD_LNAME']?></label>
                                                      </td>
                                                      <td class="score-value"><input type="number" class="score-input" name="score[]"></td>
                                                      <td class="remark-td">---</td>
                                             </tr>
                                             <?php }
                                    }
                                    else{
                                        $get_stud = "SELECT STUD_FNAME,STUD_LNAME FROM s_students WHERE STUD_LEVEL ='DEGREE' AND STUD_FIELD = '{$checkgen_record['FIELD_LEVEL']}'";
                                        $get_stud_result = $connect->query($get_stud);
                                        
                                        $i =0;
                                        while($rows = $get_stud_result->fetch_assoc()){
                                            $_SESSION['fnames'][$i] =  $rows['STUD_FNAME'];
                                            $_SESSION['lnames'][$i] = $rows['STUD_LNAME'];
                                             $i++;
                                            ?>  
                                              <tr class="td">
                                                      <td class="name">    
                                                         <label class="Fname" name="fnames[]"><?php echo $rows['STUD_FNAME'].' '?></label>
                                                         <label class="Lname" name="lnames[]"><?php echo $rows['STUD_LNAME']?></label>
                                                      </td>
                                                      <td class="score-value"><input type="number" class="score-input" name="score[]"></td>
                                                      <td class="remark-td">---</td>
                                             </tr>
                                             <?php  }

                                    }
                                  }
                                  else{
                                        $getdepart = "SELECT C_NAME,DEPART_CODE FROM departmentcourses WHERE C_NAME = '$course'";
                                        $getdepart_result = $connect->query($getdepart);
                                        $getdepart_record = $getdepart_result->fetch_assoc();


                                        $get_stud = "SELECT STUD_FNAME,STUD_LNAME FROM s_students WHERE STUD_LEVEL ='DEGREE' AND DEPART_CODE = '{$getdepart_record['DEPART_CODE']}'";
                                        $get_stud_result = $connect->query($get_stud);
                                        
                                        $i =0;
                                        while($rows = $get_stud_result->fetch_assoc()){
                                            $_SESSION['fnames'][$i] =  $rows['STUD_FNAME'];
                                            $_SESSION['lnames'][$i] = $rows['STUD_LNAME'];
                                             $i++;
                                            ?>  
                                              <tr class="td">
                                                      <td class="name">    
                                                         <label class="Fname" name="fnames[]"><?php echo $rows['STUD_FNAME'].' '?></label>
                                                         <label class="Lname" name="lnames[]"><?php echo $rows['STUD_LNAME']?></label>
                                                      </td>
                                                      <td class="score-value"><input type="number" class="score-input" name="score[]"></td>
                                                      <td class="remark-td">---</td>
                                             </tr>   
                                             <?php }

                                  }
                            }
                        }else{
                            
                        }
                     ?>
            </table>
               <input type="submit" class="print save" value="Save" name="save" on>
         </form>
        <div class="save-message">
            <?php
                  
                  if($_POST['save']){
                        $score = $_POST['score'];
                        $level = $_SESSION['level'];
                        $course = $_SESSION['course'];
                        $fnames =   $_SESSION['fnames'] ;
                        $lnames =   $_SESSION['lnames'] ;
                        $exam_type = $_SESSION['examtype']; 
                        $status=0;
                        $date = date("Y-m-d");
                    
                      $get_course = "SELECT C_CODE FROM departmentcourses WHERE C_NAME = '$course' UNION SELECT C_CODE FROM generalcourses WHERE C_NAME = '$course'";
                      $get_course_result = $connect->query($get_course);
                      $get_course_row = $get_course_result->fetch_assoc();
                      $course = $get_course_row['C_CODE'];
                      
                      //GET LECT_CODE FORM DB
                     $get_lect_code ="";
                     if($level == "HND 1 semester 1"){
                        $get_lect_code = "SELECT LECT_CODE FROM semester1_schedule where C_CODE = '$course'";
                     } 
                     else if ($level == "HND 1 semester 2"){
                        $get_lect_code = "SELECT LECT_CODE FROM semester2_schedule where C_CODE = '$course'";
                     }
                     else if ($level == "HND 2 semester 1"){
                        $get_lect_code = "SELECT LECT_CODE FROM semester3_schedule where C_CODE = '$course'";
                     }
                     else if ($level == "HND 2 semester 2"){
                        $get_lect_code = "SELECT LECT_CODE FROM semester4_schedule where C_CODE = '$course'";
                     }
                     else if ($level == "DEGREE semester 1"){
                        $get_lect_code = "SELECT LECT_CODE FROM semester5_schedule where C_CODE = '$course'";
                     }
                     else if ($level == "DEGREE semester 2"){
                        $get_lect_code = "SELECT LECT_CODE FROM semester6_schedule where C_CODE = '$course'";
                     }
               
                      $get_lect_result = $connect->query($get_lect_code);
                      $lect_row = $get_lect_result->fetch_assoc();
                      $lectcode = $lect_row['LECT_CODE'];
                      

                    
                      if(empty($lect_row['LECT_CODE'])){
                         echo "Sorry this course has not been scheduled";
                      }
                      else{   
                               if($level == "HND 1 semester 1"){
                            $i = 0;
                            
                            while($value = $fnames[$i]){
                                 $get_stud = "SELECT STUD_MATRICULE FROM s_students WHERE STUD_FNAME = '{$fnames[$i]}' AND STUD_LNAME = '{$lnames[$i]}'";
                                 $get_stud_result = $connect->query($get_stud);
                                 $get_stud_row = $get_stud_result->fetch_assoc();
                                 //check if it has been registered already 
                                 $check = "SELECT STUD_MATRICULE FROM hnd1s1 WHERE STUD_MATRICULE = '{$get_stud_row['STUD_MATRICULE']}' 
                                          AND C_CODE='{$get_course_row['C_CODE']}' AND LECT_CODE='$lectcode' AND EXAM_TYPE = '$exam_type'"; 
                                 $check_result = $connect->query($check);
                                 $row = $check_result->fetch_assoc();
                                 if(empty($row['STUD_MATRICULE'])){
                                    $add_record = "INSERT INTO hnd1s1 VALUES ('{$get_stud_row['STUD_MATRICULE']}','{$get_course_row['C_CODE']}','$lectcode','{$score[$i]}','$date','$exam_type')";
                                    if($connect->query($add_record)){
                                        $status = 1;
                                    } 
                                 }
                                 else{
                                    echo "Value for ".$exam_type." has already been filled ";
                                 }  
                              $i++;
                            }
                            if($status == 1){
                                echo "Mark Registered";
                            }else{
                                echo "Sorry did not register";
                            }

                      }
                      else if($level == "HND 1 semester 2"){
                            $i = 0;
                            while($value = $fnames[$i]){
                                $get_stud = "SELECT STUD_MATRICULE FROM s_students WHERE STUD_FNAME = '{$fnames[$i]}' AND STUD_LNAME = '{$lnames[$i]}'";
                                 $get_stud_result = $connect->query($get_stud);
                                 $get_stud_row = $get_stud_result->fetch_assoc();
                                   //check if it has been registered already 
                                 $check = "SELECT STUD_MATRICULE FROM hnd1s2 WHERE STUD_MATRICULE = '{$get_stud_row['STUD_MATRICULE']}' 
                                          AND C_CODE='{$get_course_row['C_CODE']}' AND LECT_CODE='$lectcode' AND EXAM_TYPE = '$exam_type'"; 
                                 $check_result = $connect->query($check);
                                 $row = $check_result->fetch_assoc();
                                 if(empty($row['STUD_MATRICULE'])){
                                    $addrecord = "INSERT INTO hnd1s2 VALUES ('{$get_stud_row['STUD_MATRICULE']}','{$get_course_row['C_CODE']}','$lectcode','{$score[$i]}','$date','$exam_type')";
                                    if($connect->query($addrecord)){
                                        $status = 1;
                                    }
                                 }
                                 else{
                                    echo "Value for ".$exam_type." has already been filled ";
                                 }  
                              $i++;
                            }
                            if($status == 1){
                                echo "Mark Registered";
                            }else{
                                echo "Sorry did not register";
                            }

                      }
                      else if($level == "HND 2 semester 1"){
                            $i = 0;
                            while($value = $fnames[$i]){
                                $get_stud = "SELECT STUD_MATRICULE FROM s_students WHERE STUD_FNAME = '{$fnames[$i]}' AND STUD_LNAME = '{$lnames[$i]}'";
                                 $get_stud_result = $connect->query($get_stud);
                                 $get_stud_row = $get_stud_result->fetch_assoc();
                                  //check if it has been registered already 
                                 $check = "SELECT STUD_MATRICULE FROM hnd2s1 WHERE STUD_MATRICULE = '{$get_stud_row['STUD_MATRICULE']}' 
                                          AND C_CODE='{$get_course_row['C_CODE']}' AND LECT_CODE='$lectcode' AND EXAM_TYPE = '$exam_type'"; 
                                 $check_result = $connect->query($check);
                                 $row = $check_result->fetch_assoc();
                                 if(empty($row['STUD_MATRICULE'])){
                                    $addrecord = "INSERT INTO hnd2s1 VALUES ('{$get_stud_row['STUD_MATRICULE']}','{$get_course_row['C_CODE']}','$lectcode','{$score[$i]}','$date','$exam_type')";
                                    if($connect->query($addrecord)){
                                        $status = 1;
                                    }
                                 }
                                 else{
                                    echo "Value for ".$exam_type." has already been filled ";
                                 }  
                              $i++;
                            }
                            if($status == 1){
                                echo "Mark Registered";
                            }else{
                                echo "Sorry did not register";
                            }
                      }
                      else if($level == "HND 2 semester 2"){
                            $i = 0;
                            while($value = $fnames[$i]){
                                $get_stud = "SELECT STUD_MATRICULE FROM s_students WHERE STUD_FNAME = '{$fnames[$i]}' AND STUD_LNAME = '{$lnames[$i]}'";
                                 $get_stud_result = $connect->query($get_stud);
                                 $get_stud_row = $get_stud_result->fetch_assoc();
                                  //check if it has been registered already 
                                 $check = "SELECT STUD_MATRICULE FROM hnd2s2 WHERE STUD_MATRICULE = '{$get_stud_row['STUD_MATRICULE']}' 
                                          AND C_CODE='{$get_course_row['C_CODE']}' AND LECT_CODE='$lectcode' AND EXAM_TYPE = '$exam_type'"; 
                                 $check_result = $connect->query($check);
                                 $row = $check_result->fetch_assoc();
                                 if(empty($row['STUD_MATRICULE'])){
                                    $addrecord = "INSERT INTO hnd2s2 VALUES ('{$get_stud_row['STUD_MATRICULE']}','{$get_course_row['C_CODE']}','$lectcode','{$score[$i]}','$date','$exam_type')";
                                    if($connect->query($addrecord)){
                                        $status = 1;
                                    } 
                                 }
                                 else{
                                    echo "Value for ".$exam_type." has already been filled ";
                                 }   
                              $i++;
                            }
                            if($status == 1){
                                echo "Mark Registered";
                            }else{
                                echo "Sorry did not register";
                            }
                      }
                      else if($level == "DEGREE semester 1"){
                            $i = 0;
                            while($value = $fnames[$i]){
                                $get_stud = "SELECT STUD_MATRICULE FROM s_students WHERE STUD_FNAME = '{$fnames[$i]}' AND STUD_LNAME = '{$lnames[$i]}'";
                                 $get_stud_result = $connect->query($get_stud);
                                 $get_stud_row = $get_stud_result->fetch_assoc();
                                  //check if it has been registered already 
                                 $check = "SELECT STUD_MATRICULE FROM degrees1 WHERE STUD_MATRICULE = '{$get_stud_row['STUD_MATRICULE']}' 
                                          AND C_CODE='{$get_course_row['C_CODE']}' AND LECT_CODE='$lectcode' AND EXAM_TYPE = '$exam_type'"; 
                                 $check_result = $connect->query($check);
                                 $row = $check_result->fetch_assoc();
                                 if(empty($row['STUD_MATRICULE'])){
                                    $addrecord = "INSERT INTO degrees1 VALUES ('{$get_stud_row['STUD_MATRICULE']}','{$get_course_row['C_CODE']}','$lectcode','{$score[$i]}','$date','$exam_type')";
                                    if($connect->query($addrecord)){
                                        $status = 1;
                                    } 
                                 }
                                 else{
                                    echo "Value for ".$exam_type." has already been filled ";
                                 }   
                              $i++;
                            }
                            if($status == 1){
                                echo "Mark Registered";
                            }else{
                                echo "Sorry did not register";
                            }
                      }
                      else if($level == "DEGREE semester 2"){
                            $i = 0;
                            while($value = $fnames[$i]){
                                $get_stud = "SELECT STUD_MATRICULE FROM s_students WHERE STUD_FNAME = '{$fnames[$i]}' AND STUD_LNAME = '{$lnames[$i]}'";
                                 $get_stud_result = $connect->query($get_stud);
                                 $get_stud_row = $get_stud_result->fetch_assoc();
                                  //check if it has been registered already 
                                 $check = "SELECT STUD_MATRICULE FROM degrees2 WHERE STUD_MATRICULE = '{$get_stud_row['STUD_MATRICULE']}' 
                                          AND C_CODE='{$get_course_row['C_CODE']}' AND LECT_CODE='$lectcode' AND EXAM_TYPE = '$exam_type'"; 
                                 $check_result = $connect->query($check);
                                 $row = $check_result->fetch_assoc();
                                 if(empty($row['STUD_MATRICULE'])){
                                    $addrecord = "INSERT INTO degrees2 VALUES ('{$get_stud_row['STUD_MATRICULE']}','{$get_course_row['C_CODE']}','$lectcode','{$score[$i]}','$date','$exam_type')";
                                    if($connect->query($addrecord)){
                                        $status = 1;
                                    } 
                                 }
                                 else{
                                    echo "Value for ".$exam_type." has already been filled ";
                                 }   
                              $i++;
                            }
                            if($status == 1){
                                echo "Mark Registered";
                            }else{
                                echo "Sorry did not register";
                            }
                      }
                            

                      }
                     
                 
                  }

            ?>
        </div>
        <script>
            var level = document.querySelector('.level');
            var course = document.querySelector('.course'); 
            var  message = document.querySelector('.error-message');
            
            var hnd1sem1courses = <?php echo json_encode($hnd1sem1_courses); ?>;
            var hnd1sem2courses = <?php echo json_encode($hnd1sem2_courses); ?>;

            var hnd2sem1courses = <?php echo json_encode($hnd2sem1_courses); ?>;
            var hnd2sem2courses = <?php echo json_encode($hnd2sem2_courses); ?>;

            var degreesem1courses = <?php echo json_encode($degreesem1_courses); ?>;
            var degreesem2courses = <?php echo json_encode($degreesem2_courses); ?>;
           
            level.addEventListener('change',()=>{
                if(level.value == "HND 1 semester 1"){
                    course.innerHTML = ``;
                    for(i=0;i< hnd1sem1courses.length;i++){
                        course.innerHTML +=`<option>${hnd1sem1courses[i]}</option>`;
                    }

                }
                else if(level.value == "HND 1 semester 2"){
                    course.innerHTML = ``;
                    for(i=0;i< hnd1sem2courses.length;i++){
                        course.innerHTML +=`<option>${hnd1sem2courses[i]}</option>`;
                    }
                }
                else if(level.value == "HND 2 semester 1"){
                    course.innerHTML = ``;
                    for(i=0;i< hnd2sem1courses.length;i++){
                        course.innerHTML +=`<option>${hnd2sem1courses[i]}</option>`;
                    }
                }
                else if(level.value == "HND 2 semester 2"){
                    course.innerHTML = ``;
                    for(i=0;i< hnd2sem2courses.length;i++){
                        course.innerHTML +=`<option>${hnd2sem2courses[i]}</option>`;
                    }
                }
                 else if(level.value == "DEGREE semester 1"){
                    course.innerHTML = ``;
                    for(i=0;i< degreesem1courses.length;i++){
                        course.innerHTML +=`<option>${degreesem1courses[i]}</option>`;
                    }
                }
                else if(level.value == "DEGREE semester 2"){
                    course.innerHTML = ``;
                    for(i=0;i< degreesem2courses.length;i++){
                        course.innerHTML +=`<option>${degreesem2courses[i]}</option>`;
                    }
                }
                else{
                    course.innerHTML = ``;
                }
            });

            course.addEventListener('mouseover',()=>{
                 if(level.value == 'select'){
                     message.textContent =  message.textContent + "Please select the level First";
                 }else{
                    course.addEventListener('change',()=>{
                          
                    });
                 }
            });

            course.addEventListener('mouseout',()=>{
                message.textContent ="";
            });
        </script>
        <script>
            var score = document.querySelectorAll('.score-input');
            var remark = document.querySelectorAll('.remark-td');
            var examtype = document.querySelector('.type');

            for(let i=0;i<score.length;i++){
                score[i].addEventListener('mouseleave',()=>{

                    if(examtype.value == "CA"){
                        if(score[i].value >= 0 && score[i].value < 10){
                        remark[i].textContent = "Weak";
                        remark[i].style.color = " red";
                        }
                        else if(score[i].value >= 10 && score[i].value < 14){
                            remark[i].textContent = "B.Avg";
                            remark[i].style.color = "red";
                        }
                        else if(score[i].value >= 15 && score[i].value < 20){
                            remark[i].textContent = "Avg";
                            remark[i].style.color = "gray";
                        }
                        else if(score[i].value >= 20 && score[i].value < 24){
                            remark[i].textContent = "Good";
                            remark[i].style.color = "green";
                        }
                        else if(score[i].value >= 24 && score[i].value < 27){
                            remark[i].textContent = "V.Good";
                            remark[i].style.color = "green";
                        }
                        else if(score[i].value >= 27 && score[i].value <= 30){
                            remark[i].textContent = "Excell.";
                            remark[i].style.color = "green";
                        }else {
                            score[i].value = '--';
                            remark[i].textContent = "invalid";
                            remark[i].style.color = "black";
                        }

                    }
                    else{
                        if(score[i].value >= 0 && score[i].value < 20){
                        remark[i].textContent = "Weak";
                        remark[i].style.color = " red";
                        }
                        else if(score[i].value >= 20 && score[i].value < 35){
                            remark[i].textContent = "B.Avg";
                            remark[i].style.color = "red";
                        }
                        else if(score[i].value >= 35 && score[i].value < 45){
                            remark[i].textContent = "Avg";
                            remark[i].style.color = "gray";
                        }
                        else if(score[i].value >= 45 && score[i].value < 55){
                            remark[i].textContent = "Good";
                            remark[i].style.color = "green";
                        }
                        else if(score[i].value >= 55 && score[i].value < 65){
                            remark[i].textContent = "V.Good";
                            remark[i].style.color = "green";
                        }
                        else if(score[i].value >= 65 && score[i].value <= 70){
                            remark[i].textContent = "Excell.";
                            remark[i].style.color = "green";
                        }else {
                            score[i].value = '--';
                            remark[i].textContent = "invalid";
                            remark[i].style.color = "black";
                        }
                    }
                     
                });
            }
            
        </script>
    </main>
    <aside id="aside" class="aside-action">
                <a href="registerscorepage.php" id="A-print-btn" class="lect-score-btn flex">
                    <button class="A-btn">
                        <img src="images/score.png" class="A-btn-icon"><br>
                        <span class="A-btn-title">Fill Scores</span>
                    </button>
                </a>
                <a href=""  id="A-view-btn" class="lect-stat-btn flex">
                    <button class="A-btn">
                        <img src="images/statslogo.jpg" class="A-btn-icon"><br>
                        <span class="A-btn-title">Course Statistics</span>
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