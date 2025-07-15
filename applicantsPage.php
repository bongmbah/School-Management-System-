<?php
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
    <link rel="stylesheet" href="css/applicants.css">
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
        <div class="pre-title">
            Pre-registraton List
        </div>
            <form action="" method="POST" class="table-content">
                    <table>
                        <tr class="table-h">
                            <th class="score-t">NAME</th>
                            <th class="course">PHOTO</th>
                            <th class="credit">FIELD</th>
                            <th class="date">RECEIVED-DATE</th>
                            <th class="credit-e">NATIONALITY</th>
                            <th class="grade-p">VALIDATE</th>
                        </tr>
                        <?php
                          $query = "SELECT STUD_MATRICULE,STUD_FNAME,STUD_LNAME,PHOTO,STUD_FIELD,STUD_LEVEL,CERTIFICATE,DATE_REGISTERD,EMAIL,NATIONALITY,DEPART_CODE FROM studentrequest";
                          $list = $connect->query($query);
                          $name= array();
                          $level = array();
                          $email = array();
                          $certificates = array();
                          $matricule = array();
                          $option = array();
                          $i =0;
                          while($row = $list->fetch_assoc()){
                             $certificates[$i] = $row['CERTIFICATE'];
                             $name[$i] = $row['STUD_FNAME'].' '.$row['STUD_LNAME']; 
                             $level[$i] = $row['STUD_LEVEL'];
                             $email[$i] = $row['EMAIL'];
                             $matricule[$i] = $row['STUD_MATRICULE'];
                             $query2 = "SELECT DEPART_OPTION FROM department WHERE DEPART_CODE = '{$row['DEPART_CODE']}'";
                             $result2 = $connect->query($query2);
                             $row2 = $result2->fetch_assoc();
                             $option[$i] = $row2['DEPART_OPTION'];
                       ?>
                          <tr>
                            <td><?php echo $name[$i];?></td>
                            <td><button class="photo-btn"><img src="studentPhotos/<?=removeSpace($row['PHOTO'])?>" class="stud-photo"></button></td>
                            <td class="view"><?PHP echo $row['STUD_FIELD'] ?></td>
                            <td><?php echo $row['DATE_REGISTERD'] ?></td>
                            <td><?php echo $row['NATIONALITY'] ;?></td>
                            <td><a href="studValidatePage.php" class="accept">Validate</a></td>
                        </tr>
                  
                       <?php  
                             $i++;
                         
                        }
                        
                        ?>
                    </table>
                    <?php  
                        
                    ?>
            </form>
    </main>
    <script> 

            
             var certificate = <?php echo json_encode($certificates)?>;
             var emails =  <?php echo json_encode($email)?>;
             var names =  <?php echo json_encode($name)?>;
             var level =  <?php echo json_encode($level)?>;
             var matricule  =   <?php echo json_encode($matricule)?>;
             var option = <?php echo json_encode($option)?>;
             var stud = {};

             var accept_btn =document.querySelectorAll('.accept');

             accept_btn.forEach((btn,index)=>{
                btn.addEventListener('click',()=>{
                     stud.name = names[index];
                     stud.certificate = certificate[index];
                     stud.email = emails[index];
                     stud.level = level[index];
                     stud.mat = matricule[index];
                     stud.option = option[index];
                     localStorage.setItem('stud',JSON.stringify(stud));
                     
                });
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
        <a href="" id="A-view-btn" class="flex">
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