<?php
  session_start();
  error_reporting(0);
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
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/validateAside.css">
    <link rel="stylesheet" href="css/validatePage.css">
    
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
    <?php 
                    $query = "SELECT MAX(STUD_MATRICULE) AS LASTI FROM s_students";
                    $result = $connect->query($query);
                    $row = $result->fetch_assoc();
                    $query = "SELECT  ADMIN_MATRICULE FROM s_students WHERE STUD_MATRICULE = '{$row['LASTI']}'";
                    $result = $connect->query($query);
                    $row = $result->fetch_assoc();
                    $last = $row['ADMIN_MATRICULE'];
    ?>
    <main id="content" class="content">
           <div id="canvas-container">
                <canvas>
                       
                </canvas>
           </div>

           <form action="" method="post" id="validate-section">
              <div><input type="text" class="name1 name" name = "name" ></div>
              <div><input type="text" class="level name" name = "level" ></div>
              <div><input type="text" class="option name" name = "option"></div>
              <div><input type="text" class="matricule name" name = "matricule" ></div>
              <div class="accept-reject">
                    <div><input type="submit" class="accept" value="Accept" name="accept"></div>
                    <div><input type="submit" class="reject" value="Reject" name="reject"></div>
              </div>
              <div class="messsage">
                    <?php
                      if($_POST['register']){
                        $j =0;
                        $fname = getfname($_POST['name'],$j);
                        $j = strlen($fname) + 1;
                        $lname = getlname($_POST['name'],$j);
                        $found =0;
                         
                        $check_stud = "SELECT STUD_FNAME,STUD_LNAME FROM s_students WHERE STUD_FNAME = '$fname' AND STUD_LNAME = '$lname'";
                        $check_result = $connect->query($check_stud);
                        $row = $check_result->fetch_assoc();
                        if(empty($row['STUD_FNAME'])){
                           $get_stud_cre = "SELECT * FROM studentrequest WHERE STUD_FNAME = '$fname' AND STUD_LNAME = '$lname'";
                           $get_result = $connect->query($get_stud_cre);
                           $get_row = $get_result->fetch_assoc();

                           $matricul = filter_input(INPUT_POST,"matricule",FILTER_SANITIZE_SPECIAL_CHARS);
                           $username = filter_input(INPUT_POST,"username",FILTER_SANITIZE_SPECIAL_CHARS);
                           $password = filter_input(INPUT_POST,"password",FILTER_SANITIZE_SPECIAL_CHARS);

                           $get_matricule = "SELECT MAX(STUD_MATRICULE) AS MATRICULE FROM s_students";
                           $matricule_result = $connect->query($get_matricule);
                           $matricule_record = $matricule_result->fetch_assoc();
                           $matricule =  $matricule_record['MATRICULE'];

                           if ( $matricule == ""){$matricule = 1;}
                           else{$matricule = intval($matricule) + 1;}

                           $add_stud = "INSERT INTO s_students VALUES ('$matricule','$fname','$lname','{$get_row['STUD_LEVEL']}','{$get_row['PHONE']}','{$get_row['PHONE']}','{$get_row['EMAIL']}',
                           '{$get_row['DATE_REGISTERD']}','$password','{$get_row['CERTIFICATE']}','{$get_row['PHOTO']}','$username','{$get_row['STUD_FIELD']}','{$get_row['REGION']}',
                           '{$get_row['PLACE_OF_BIRTH']}','{$get_row['DATE_OF_BIRTH']}','{$get_row['NATIONALITY']}','{$get_row['GENDER']}','$matricul')";

                           if($connect->query($add_stud)){
                              echo " Student registered successfully";
                              $delete = "DELETE FROM studentrequest WHERE STUD_FNAME = '$fname' AND STUD_LNAME = '$lname'";
                              $connect->query($delete);
                           }

                        }else{
                            echo "Student is already registered";
                        }
 
                      } 
                    ?>
              </div>
           </form>
           
    </main>
    <script>
         var htmltoadd = `
              <div><input type="text" class="username" value="username" name="username"></div>
              <div><input type="text" class="username" value="password" name="password"></div>
              <div><input type="text" class="username" value="matricule" name="matricule"></div>
              <div><input type="submit" class="register" value="Register" name="register"></div>
         
         `;

         var form = document.getElementById("validate-section");
         
        var accept = document.querySelector('.accept');
        accept.addEventListener('click',()=>{
               form.innerHTML = form.innerHTML + htmltoadd; 
        });

    </script>
    <script>
        var stud = JSON.parse(localStorage.getItem('stud'));
         let cet =  document.querySelector('.cet_name');
         cet.value = stud.certificate;
         console.log(cet.value)
        document.querySelector('.name1').value = stud.name;
        document.querySelector('.level').value = stud.level;
        document.querySelector('.option').value = stud.option;
        document.querySelector('.matricule').value = <?=json_encode($last)?>;
        document.querySelector('.accept').addEventListener('click',()=>{
        document.querySelector('.name1').value = stud.name;
        document.querySelector('.level').value = stud.level;
        document.querySelector('.option').value = stud.option;
        document.querySelector('.matricule').value = <?=json_encode($last)?>;
       
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