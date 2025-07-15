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
    <link rel="stylesheet" href="css/studAssignPage.css">

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
            <div class="table-title">ASSIGNMENTS</div>
            <div class="sem-title">Text Section</div>
            <form action="" method="POST" class="table-content">
                    <table>
                        <tr class="table-h">
                            <th class="score-t">LECT NAME</th>
                            <th class="course">Title</th>
                            <th class="credit-e">Latest Date</th>
                            <th class="grade-p">Action</th>
                        </tr>
                        <?php
                           //  get the stud field and 
                            $get_stud = "SELECT STUD_LEVEL,DEPART_CODE,STUD_FIELD FROM s_students WHERE STUD_MATRICULE = '{$_SESSION['matricule']}'";
                            $get_stud_result = $connect->query($get_stud);
                            $stud_row = $get_stud_result->fetch_assoc();
                           //Determine the semesters
                           $sem1;
                           $sem2;
                            if($stud_row['STUD_LEVEL'] == "HND1"){$sem1=1;$sem2=2;}
                            else if($stud_row['STUD_LEVEL'] == "HND2"){$sem1=3;$sem2=4;}
                          //get the student courses and store in an array
                            $courses = array();
                            $get_gen_depart_courses = "SELECT C_CODE FROM departmentcourses WHERE DEPART_CODE = '{$stud_row['DEPART_CODE']}' AND (SEMESTER = '$sem1' OR SEMESTER = '$sem2')
                                                  UNION SELECT C_CODE FROM generalcourses WHERE (FIELD_LEVEL='{$stud_row['STUD_FIELD']}' OR FIELD_LEVEL='GENERAL')  AND (SEMESTER = '$sem1' OR SEMESTER = '$sem2')";
                            $result = $connect->query($get_gen_depart_courses);
                            $j =0;
                            while($row = $result->fetch_assoc()){
                                $courses[$j] = $row['C_CODE'];
                                $j++;
                            }
                          
                          //get the assignmwnt table
                           $date = date('Y-m-d');
                           $querytext = "SELECT TILLE,LECT_CODE,LATEST_DATE,INSTRUCTIONS,C_CODE FROM text_assignments";
                           $querytext_result = $connect->query($querytext);
                           $instuctions = array();
                           $i=0;

                           while($row = $querytext_result->fetch_assoc()){
                            if($row['LATEST_DATE'] >= $date){
                                if(in_array($row['C_CODE'],$courses))
                                {

                                    $getlect = "SELECT LECT_FNAME, LECT_LNAME FROM lecturer where LECT_CODE = '{$row['LECT_CODE']}'";
                                    $lect_result = $connect->query($getlect);
                                    $lectrow = $lect_result->fetch_assoc();
                                    $instuctions[$i] = $row['INSTRUCTIONS'];
                                    $i++;
                        ?>
                        <tr>
                                <td><?php echo $lectrow['LECT_FNAME'].' '.$lectrow['LECT_LNAME'] ?></td>
                                <td><?php echo $row['TILLE']?></td>
                                <td><?php echo $row['LATEST_DATE']?></td>
                                <td><a href="" class="view" >View</a></td>
                        </tr>
                        <?php
                              }
                          } 
                       }
                    
                    ?>
                </table> 
            </form>
            <p class="instructions"><span></span></p>
            <div class="sem-title">Document Section</div>
            <form action="" method="POST" class="table-content">
                    <table>
                        <tr class="table-h">
                            <th class="score-t">LECT NAME</th>
                            <th class="course">Title</th>
                            <th class="credit-e">Latest Date</th>
                            <th class="grade-p">Action</th>
                        </tr>
                        <?php 
                           $date = date('Y-m-d');
                           $querydoc = "SELECT TILLE,LECT_CODE,LATEST_DATE,FILE_DOCUMENT,C_CODE,IMAGE FROM doc_assignments";
                           $querydoc_result = $connect->query($querydoc);
                
                           while($row = $querydoc_result->fetch_assoc()){
                                if($row['LATEST_DATE'] >= $date){
                                    if(in_array($row['C_CODE'],$courses))
                                    {
                                        $getlect = "SELECT LECT_FNAME, LECT_LNAME FROM lecturer where LECT_CODE = '{$row['LECT_CODE']}'";
                                        $lect_result = $connect->query($getlect);
                                        $lectrow = $lect_result->fetch_assoc();
                             
                        ?>
                        <tr>
                            <td><?php echo $lectrow['LECT_FNAME'].' '.$lectrow['LECT_LNAME'] ?></td>
                            <td><?php echo $row['TILLE']?></td>
                            <td><?php echo $row['LATEST_DATE']?></td>
                            <td><a href="Assignments/<?=$row['FILE_DOCUMENT']?>" class="download" download="<?=$row['IMAGE']?>">Download</a></td>
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
         var view = document.querySelectorAll('.view');
         var instructions = <?php echo json_encode($instuctions)?>;
         var instruct_sec = document.querySelector('.instructions');
         var text = `<br> Check`;

         view.forEach((btn,i)=>{

            view[i].addEventListener('mouseover',()=>{
                   instruct_sec.innerHTML ="";
                   instruct_sec.innerHTML =  instruct_sec.innerHTML +  instructions[i];
               });
         });
    </script>
</body>
</html>