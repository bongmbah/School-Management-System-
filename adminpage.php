
<?php
  error_reporting(0);
  require_once "databaseconect.php";
  require_once("Dbfunctions.php");
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
    <link rel="stylesheet" href="css/aside.css">
    <link rel="stylesheet" href="css/content.css">
   <style>
     .open-close{
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding-top: 7%;
        padding-bottom: 7%;
        padding-left: 4%;
        padding-right: 4%;
        text-align: center;
        border:1px solid rgba(58, 52, 52,0.1);
        box-shadow: 3px 3px 5px 5px rgba(58, 52, 52,0.1);
     }
     .r-btns{
           border: none;
           padding: 10%;
           border-radius: 4px;
           background-color: transparent;
     }
     .r-btns:hover{
        background-color: rgb(235, 233, 233);
     }
   </style>
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
        <div class="content-grid">
            <a href="department.php" id="add-stud-btn" class="grid">
                <button class="btn">
                    <img src="images/departlogo.png" class="btn-icon"><br>
                    <span class="btn-title">Department</span>
                </button>
             </a>

            <a href="registerLect.php" id="add-lect-btn" class="grid">
                <button class="btn">
                    <img src="images/lectlogo.jpg" class="btn-icon"><br>
                    <span class="btn-title">Add Lecturer</span>
                </button> 
            </a>
            <a href="addCourse.php" id="add-cour-btn" class="grid">
                <button class="btn">
                    <img src="images/courselogo.jpg" class="btn-icon"><br>
                    <span class="btn-title">Courses</span>
                </button>
            </a>
            <a href="schedule.php" id="sch-btn" class="grid">
                <button class="btn" >
                    <img src="images/schedulelogo.png" class="btn-icon"><br>
                    <span class="btn-title">Schedule Lecturers</span>
                </button>
            </a>
            <a href="printresultpage.php" id="print-btn" class="grid">
                <button class="btn">
                    <img src="images/printlogo.png" class="btn-icon"><br>
                    <span class="btn-title">Print Result</span>
                </button>
            </a>
            <a href="" id="view-btn" class="grid">
                <button class="btn ">
                    <img src="images/statslogo.jpg" class="btn-icon"><br>
                    <span class="btn-title">Result Statistics</span>
                </button>
            </a>
            <a href="applicantsPage.php" id="view-btn" class="grid">
                <button class="btn ">
                    <img src="images/studentlogo2.png" class="btn-icon"><br>
                    <span class="btn-title">Pre Rgistration Students</span>
                </button>
            </a>
            <a href="adminFillScorePage.php" id="view-btn" class="grid">
                <button class="btn ">
                    <img src="images/score.png" class="btn-icon"><br>
                    <span class="btn-title">Fill Scores</span>
                </button>
            </a>
            <form action="#"  method="POST" id="r-section" class="grid open-close">
                <div><input type="submit" class="r-btns" name = "open" value="Open Registration"></div>
                <div><input type="submit" class="r-btns" name = "close" value="Close Registration"></div>
           </form>
           <?php
              if($_POST['open']){
                $update = "UPDATE registration_window SET STATUS = 1 WHERE ID = 1";
                $result = $connect->query($update);
              }
              if($_POST['close']){
                $update = "UPDATE registration_window SET STATUS = 0 WHERE ID = 1";
                $result = $connect->query($update);
              }

          ?>
        </div>
    </main>

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