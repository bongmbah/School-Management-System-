<?php
   error_reporting(0);
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
         <div class="admin-title">Admin Provide the following credentials</div>
         <form action="" method="POST">
                <input type="text" placeholder="username" class="A-username" name="A-username"><br>
                <input type="password" placeholder="password" id="A-password" class="A-password"name="A-password" >
                <div class="message">
                    <?php
                       require_once "databaseconect.php";
                       require_once "Dbfunctions.php";
                       $connect = new mysqli($hostname,$username,$password,$database);
                       $username = strtoupper($_POST['A-username']);
                       $password = $_POST['A-password'];
        
   
                        $query = "select ADMIN_PASSWORD,A_FNAME from administrator WHERE A_FNAME='$username'";
                        $result = $connect->query($query);
                        $row = $result->fetch_assoc();
                        if($_POST['submit']){
                            Aunthenticate($row,$username,$password,$row['A_FNAME'],$row['ADMIN_PASSWORD']);
                        }
                       
                    ?>
                </div> 
                <input type="submit" name="submit" class="A-submit" >
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
    </footer>
   <script>
      
       var submit = document.querySelector('.A-submit');
       var message = document.querySelector('.message');
       var password = document.querySelector('.A-password');

       password.addEventListener('keydown',()=>{
         if(password.value.length < 7){
             message.innerHTML = "Paasword must be 8 characters long or more";
         }else{
            message.innerHTML = "";
         }
       });
       
      
      
   </script>

</body>
</html>