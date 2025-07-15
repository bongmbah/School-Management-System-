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
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/content.css">
    <link rel="stylesheet" href="css/adminLecLogin.css">
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
        <div class="admin-title">Lect Provide the following credentials</div>
        <form action="#" method="POST">
                <input type="text" placeholder="username" class="L-username" name="username" required><br>
                <input type="password" placeholder="password" class="L-password" name="password" required>
                <div class="message">
                <?php
                    if($_POST['submit']){
                        $username = filter_input(INPUT_POST,"username",FILTER_SANITIZE_SPECIAL_CHARS);
                        $password = filter_input(INPUT_POST,"password",FILTER_SANITIZE_SPECIAL_CHARS);

                        $get_cred = "SELECT USERNAME,LECT_PASSWORD FROM lecturer";
                        $result = $connect->query($get_cred);

                        $found =0;

                        while($row = $result->fetch_assoc()){
                            if($username == $row['USERNAME']){
                                if($password == $row['LECT_PASSWORD']){
                                    $found = 1;
                                    break;
                                }
                                 
                            }
                        }  
                        
                        if($found == 1){
                            $send_name = "SELECT LECT_FNAME, LECT_LNAME,LECT_CODE FROM lecturer WHERE USERNAME = '$username' AND LECT_PASSWORD = '$password'";
                            $name_result = $connect->query($send_name);
                            $name_record = $name_result->fetch_assoc();

                            $_SESSION['lect_name'] = $name_record['LECT_FNAME'].' '.$name_record['LECT_LNAME'];
                            $_SESSION['code'] = $name_record['LECT_CODE'];
                             header("Location: http://localhost/MainProject/lectpage.php");
                        }else{
                            echo "Either your username or password is wrong!";
                        }
        
                    }
                ?>
            </div> 
                </div> 
                <input type="submit" class="L-submit" value="Login" name="submit">
        </form>
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
          <script>
            if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
            }
        </script>
    </footer>
</body>
</html>