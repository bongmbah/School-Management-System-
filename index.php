<?php
  session_start();
  //error_reporting(0);
  require_once "databaseconect.php";
  require_once "Dbfunctions.php";
  $connect = new mysqli($hostname,$username,$password,$database);
  $query = "select STATUS FROM registration_window WHERE ID = 1";
  $result = $connect->query($query);
  $row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEVIC-HITM REPORT CARD SYSTEM </title>
    <link rel="icon" type="" href="images/sevic-logo.png" />
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/index.css">
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
     <section id="benit-header">
        <div class="sevicti-title">SEVIC-HITM</div>
        <div class="nav-section">
            <nav class="nav">
            <?php
               if($row['STATUS'] == 1){
                ?>
                  <a href="registerStud.php">Apply</a>
                <?php
               }
            ?>
                <a>Visit</a>
                <a href="loginpage.php">Login</a>
            </nav>
            <nav class="nav-but">
            <?php
               if($row['STATUS'] == 1){
                ?>
                  <a href="registerStud.php">Apply</a>
                <?php
               }
            ?>
                <a>Visit</a>
                <a href="loginpage.php">Login</a>
            </nav>
            <div class="sevicti-img"><img src="images/listlogo2.jpg"></div>
            <div class="sevicti-color"></div>
        </div>
     </section>
     <section id="home-text">
        CREATE THE WORLD YOU WANT TO LIVE IN.
     </section>
     <div id="apply-info">
        <?php
          if($row['STATUS'] == 1){
            echo "Registration ongoing...";
          }
        ?>
            
     </div>
     <aside class="aside">
        
     </aside>
     <section class="link">
        <a href="programs.php" class="links">EXPLORE PROGRAMS</a>
        <a class="links">REQUEST INFO</a>
        <a href="loginpage.php" class="links">LOGIN</a>
     </section>
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
        var list = document.querySelector('.sevicti-img');
        var nav = document.querySelector('.nav-but');
        var status = 0;

        list.addEventListener('click',()=>{
           if(status == 0){
               nav.style.visibility = "visible";
               status = 1;
           } else{
               nav.style.visibility = "hidden";
               status =0;
           }
        });
    </script>
    <script>
            var container = document.getElementById("home-text");
            var text = ["WELCOME TO ALKEBULAN THE LAND OF KNOWLEDGE.","STUDY MEETS SUCCESS"," CREATE THE WORLD YOU WANT TO LIVE IN."];
            var i=0;
            setInterval(() => {
                container.textContent = text[i];
                if(i == 2){
                    i = 0;
                }else{
                    i++;
                }
            }, 10000);

    </script>
</body>
</html>