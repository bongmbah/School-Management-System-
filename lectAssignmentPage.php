
<?php
  error_reporting(0);
  require_once "databaseconect.php";
  $connect = new mysqli($hostname,$username,$password,$database);
  session_start();
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
    <link rel="stylesheet" href="css/assignment.css">
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
            <div id="ass-container" class="ass-container">
                        <div class='ass-title'>Assignment Description</div>
                        <form action='#' method='POST' enctype='multipart/form-data' class='ass-form'>
                            <div class='ass-select'>
                                <label class='ass-course'>Course Code</label>
                                <select name='course' class='course-value'>
                                    <?php

                                    //get lecturer courses
                                       $lect_code = $_SESSION['code'];
                                       $query = "SELECT C_CODE FROM semester1_schedule WHERE LECT_CODE = '$lect_code'
                                                 UNION SELECT C_CODE FROM semester2_schedule WHERE LECT_CODE = '$lect_code'
                                                 UNION SELECT C_CODE FROM semester3_schedule WHERE LECT_CODE = '$lect_code'
                                                 UNION SELECT C_CODE FROM semester4_schedule WHERE LECT_CODE = '$lect_code'";
                                    $result = $connect->query($query);
                                    while($row = $result->fetch_assoc()){
                                    ?>
                                      <option><?php echo $row['C_CODE'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select> 
                            </div>
                            <div><input type='text' placeholder='Title/Topic' name='title' class='title-ass'></div>
                            <label class='ass-course'>Latest Submission Date</label>
                            <div><input type='date' name='late-date' class='title-ass'></div>
                            <div class='ass-select'>
                                <label class='ass-course'>Assignment Format</label>
                                <select id='format-type' name='format' class="course-value">
                                    <option>Document</option>
                                    <option>Type Text</option>
                                </select> 
                            </div>
                            <div class="extra-input">
                            </div>
                        </form>
            </div>
            <div class="message">
                 <?php  
                   if($_POST['submit']){
                       $course_code = $_POST['course'];
                       $title = filter_input(INPUT_POST,"title",FILTER_SANITIZE_SPECIAL_CHARS);
                       $late_date = $_POST['late-date'];

                      if($_POST['format'] == "Document"){
                         if(date("Y-m-d") > $late_date){
                            echo "Invalid Date chosen!";
                         }else{
                              
                                $fname = $_FILES['file-doc']['name'];
                                $tmp_name = $_FILES['file-doc']['tmp_name'];
                                $size = $_FILES['file-doc']['size'];
                                $error = $_FILES['file-doc']['error'];
                                $lcode = $_SESSION['code'];
                                $date = date("Y-m-d");
                                if($error != 4){
                                     $file_ex = pathinfo($fname,PATHINFO_EXTENSION);
                                     $file_ex = strtolower($file_ex);
                                     if($file_ex != "pdf"){
                                         echo "Please provide a pdf document";
                                     }
                                     else{
                                        $file_new_name = uniqid("PDF-",true).'.'.$file_ex;
                                         $file_path = 'Assignments/'.$file_new_name;
                                         move_uploaded_file($tmp_name, $file_path);

                                         //get assig id
                                         $query = "SELECT MAX(ASSIGN_ID) AS ID FROM doc_assignments";
                                         $result = $connect->query($query);
                                         $row = $result->fetch_assoc();
                                         $id;

                                         if($row['ID'] == ""){ $id = 1;}
                                         else { $id = intval($row['ID']) + 1;}

                                         $insert = "INSERT INTO doc_assignments VALUES ($id,'$title','$lcode','$date','$late_date','$course_code','$file_new_name',' $fname')";
                                         if($connect->query($insert)){
                                            
                                            $level;
                                            $get = "SELECT DEPART_CODE,SEMESTER FROM departmentcourses WHERE C_CODE = '$course_code'";
                                             $result = $connect->query($get);
                                             $row = $result->fetch_assoc();

                                             if($row['SEMESTER']== 1 || $row['SEMESTER']== 2){$level = "HND1";}
                                             else if($row['SEMESTER']== 3 || $row['SEMESTER']== 4){$level = "HND2";}

                                            $get = "SELECT EMAIL FROM s_students WHERE DEPART_CODE = '{$row['DEPART_CODE']}' AND STUD_LEVEL = '$level'";
                                            $result = $connect->query($get); 

                                            while($row = $result->fetch_assoc()){
                                                $email = $row['EMAIL'];
                                                $from = "bongmbahshey@gmail.com";
                                                $header = "From: $from";
                                                $subject = "SEVICT-HITM"; 
                                                $message = "You have an assignment from Mr/Mrs: $lectname\nON: $title\nVisit the paltform to see the assignment\nLatest Submision Date: $late_date";
                                                if(mail($email,$subject,$message,$header)){
                                                       // echo "\nNotified";
                                                }
                                             }

                                             
                                             echo "Saved and sent";
                                         }else{
                                            echo "Unable to save and send";
                                         }
                                     }


                                }else{
                                    echo " Sorry! was not able to load file";
                                }


                             
                         }
                      }  
                      else if ($_POST['format'] == "Type Text"){
                        if(date("Y-m-d") > $late_date){
                            echo "Invalid Date chosen!";
                         }else{
                            $lectname = $_SESSION['lect_name'];
                            if(strlen( $_POST['instruct']) == 22){
                                 echo "Please give sassignmnet description before submitting";
                            }else{
                                $instruct = $_POST['instruct'];
                                $date = date("Y-m-d");
                                $lcode = $_SESSION['code'];
                                $query = "SELECT MAX(ASSIGN_ID) AS ID FROM text_assignments";
                                $result = $connect->query($query);
                                $row = $result->fetch_assoc();
                                $id;
                                
                                if($row['ID'] == ""){ $id = 1;}
                                else { $id = intval($row['ID']) + 1;}

                                //$insert = "INSERT INTO text_assignments VALUES ($id,'$title','$lcode','$date','$late_date','$instruct','$course_code')";
                               // if($connect->query($insert)){
                                     $get = "SELECT DEPART_CODE,SEMESTER FROM departmentcourses WHERE C_CODE = '$course_code'";
                                     $result = $connect->query($get);
                                     if($row = $result->fetch_assoc()){
                                        $level;
                                        if($row['SEMESTER']== 1 || $row['SEMESTER']== 2){$level = "HND1";}
                                        else if($row['SEMESTER']== 3 || $row['SEMESTER']== 4){$level = "HND2";}

                                         $get = "SELECT EMAIL FROM s_students WHERE DEPART_CODE = '{$row['DEPART_CODE']}' AND STUD_LEVEL = '$level'";
                                         $result = $connect->query($get);
                                         //$row = $result->fetch_assoc();
                                    
                                         while($row = $result->fetch_assoc()){
                                            $email = $row['EMAIL'];
                                            $from = "bongmbahshey@gmail.com";
                                            $header = "From: $from";
                                            $subject = "SEVICT-HITM"; 
                                            $message = "You have an assignment from Mr/Mrs: $lectname\nON: $title\nVisit the paltform to see the assignment\nLatest Submision Date: $late_date";
                                            if(mail($email,$subject,$message,$header)){
                                                   // echo "\nNotified";
                                            }
                                         }
                                     }
                                     else{
                                            
                                            $get = "SELECT FIELD_LEVEL,SEMESTER FROM generalcourses WHERE C_CODE = '$course_code'";
                                            $result = $connect->query($get);
                                            $row = $result->fetch_assoc();
                                            $level;
                
                                            if($row['SEMESTER']== 1 || $row['SEMESTER']== 2){$level = "HND1";}
                                            else if($row['SEMESTER']== 3 || $row['SEMESTER']== 4){$level = "HND2";}

                                            
                                            if($row['FIELD_LEVEL'] == "GENERAL"){
                                                $get = "SELECT EMAIL FROM s_students WHERE STUD_LEVEL = '$level' ";
                                                $result = $connect->query($get);

                                                while($row = $result->fetch_assoc()){
                                                    $email = $row['EMAIL'];
                                                    $from = "bongmbahshey@gmail.com";
                                                    $header = "From: $from";
                                                    $subject = "SEVICT-HITM"; 
                                                    $message = "You have an assignment from Mr/Mrs: $lectname\nON: $title\nVisit the paltform to see the assignment\nLatest Submision Date: $late_date";
                                                    if(mail($email,$subject,$message,$header)){
                                                           // echo "\nNotified";
                                                    }
                                                 }
                                             

                                            }
                                            else{
                                                $get = "SELECT EMAIL FROM s_students WHERE STUD_LEVEL = '$level' AND STUD_FIELD = '{$row['FIELD_LEVEL']}'";
                                                $result = $connect->query($get);

                                                while($row = $result->fetch_assoc()){
                                                    $email = $row['EMAIL'];
                                                    $from = "bongmbahshey@gmail.com";
                                                    $header = "From: $from";
                                                    $subject = "SEVICT-HITM"; 
                                                    $message = "You have an assignment from Mr/Mrs: $lectname\nON: $title\nVisit the paltform to see the assignment\nLatest Submision Date: $late_date";
                                                    if(mail($email,$subject,$message,$header)){
                                                           // echo "\nNotified";
                                                    }
                                                 }

                                            }
                                           
                                     }


                                    //echo "Save and Send";
                               // }

                            }

                         }
                      }

                   }
                 
                 ?>
            </div>
    </main>

    <aside id="aside" class="aside-action">
                <div class="lect-logo">
                    <img src="images/userlogo.png">
                    <?php
                        $name = $_SESSION['lect_name']; 
                        echo "$name";
                    ?>
                </div>
                <a href="registerscorepage.php" id="A-print-btn" class="lect-score-btn flex">
                    <button class="A-btn">
                        <img src="images/score.png" class="A-btn-icon"><br>
                        <span class="A-btn-title">Fill Scores</span>
                    </button>
                </a>
                <a href="#"  id="A-view-btn" class="lect-stat-btn flex">
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
<script>
    var instructionformat = `
            <label class='ass-course'>Instructions</label>
            <div>
                <textarea class="intructions" name="instruct">    
                </textarea>
            </div>
            <div class='ass-btns'>
                <input type='submit' name='submit' class='ass-format' value='Save and Send'>
            </div>
    `;

    var fileformat = `
            <div>
                <input type='file' name='file-doc' class='ass-file'>
            </div>
            <div class='ass-btns'>
                <input type='submit' name='submit' class='ass-format' value='Save and Send'>
            </div>
    `;
     var format = document.getElementById("format-type");

     format.addEventListener('change',()=>{
        document.querySelector('.extra-input').innerHTML = "";
       if(format.value === "Document"){
           document.querySelector('.extra-input').innerHTML =  document.querySelector('.extra-input').innerHTML + fileformat;
       }  
       else{
        document.querySelector('.extra-input').innerHTML =  document.querySelector('.extra-input').innerHTML + instructionformat;
       }   
     });

     format.addEventListener('mousedown',()=>{
        document.querySelector('.extra-input').innerHTML = "";
        if(format.value === "Document"){
            document.querySelector('.extra-input').innerHTML =  document.querySelector('.extra-input').innerHTML + fileformat;
        }
     });
 </script>
</body>
</html>


