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
    <link rel="stylesheet" href="css/lect_aside.css">
    <link rel="stylesheet" href="css/lect_content.css">
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
        </div>
        <div id="content-grid" class="content-grid content-link">
                    
                    <a href="registerscorepage.php" id="print-btn" class="grid1">
                        <button class="btn">
                            <img src="images/score.png" class="btn-icon"><br>
                            <span class="btn-title">Fill Scores</span>
                        </button>
                    </a>
                    <a href="lectAssignmentPage.php" id="view-btn" class="grid1">
                        <button class="btn ass-btn">
                            <img src="images/aasignment.jpg" class="btn-icon stat"><br>
                            <span class="btn-title">Assignment</span>
                        </button>
                    </a>         
                    <a href="#" id="view-btn" class="grid1">
                        <button class="btn ">
                            <img src="images/statslogo.jpg" class="btn-icon stat"><br>
                            <span class="btn-title">Statistics</span>
                        </button>
                    </a>     
        </div>
        <div id="ass-section">
       
        </div>
    </main>
    <aside id="aside" class="aside-action">
                <div class="lect-logo">
                    <img src="images/lectlogo.jpg">
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
    </script>
</body>
</html>