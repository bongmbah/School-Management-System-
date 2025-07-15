<?php
  function Aunthenticate($row,$username,$password,$Dbname,$Dbpass){
    if(isset($username) && isset($password)){
        if($row){
            if($Dbname == $username && $Dbpass == $password) {
                header("Location: http://localhost/MainProject/adminpage.php");
            }
            else {
                echo "Incorrect password or username";
            }
           
        } 
    }else{
        echo "kkkk";
    }
  }
  function getCourseGrade($score){
      if($score < 35){
         return "F";
      }
      else if($score >= 35 && $score < 40){
          return "D";
      } 
      else if($score >= 40 && $score < 45){
          return "D+";
      } 
      else if($score >= 45 && $score < 50){
          return "C-";
      } 
      else if($score >= 50 && $score < 55){
          return "C";
      } 
      else if($score >= 55 && $score < 60){
          return "C+";
      } 
      else if($score >= 60 && $score < 65){
          return "B-";
      } 
      else if($score >= 65 && $score < 70){
          return "B";
      }
      else if($score >= 70 && $score < 75){
          return "B+";
      }
      else if($score >= 75 && $score < 80){
         return "A-";
     } 
     else if($score >= 80 && $score <= 100){
        return "A";
     }
     else return "Invalid";
  }
 function determineGradePoint($grade){
     switch($grade){
        case "D": return 1;break;
        case "D+": return 1.5;break;
        case "C": return 2;break;
        case "C+": return 2.5;break;
        case "B-": return 3;break;
        case "B": return 3;break;
        case "B+": return 3.5;break;
        case "A": return 4;break;
        case "A-": return 4;break;
        default: return 0;
     }
 }

 function removeSpace($str){
    $newStr = "";
    for($i =1;$i<strlen($str);$i++){
        $newStr = $newStr.$str[$i];
    }
    return $newStr;
 }


 function getfname($string,$i){
    $fname = "";
    while($string[$i] != ' '){
       $fname = $fname.$string[$i];
       $i++;
    }
    return $fname;
 }


 function getlname($string,$i){
    $fname = "";
    while($i < strlen($string)){
       $fname = $fname.$string[$i];
       $i++;
    }
    return $fname;
 }

 function creditEarned($credit,$score){
     if($score >=50 ){
        return  $credit;
     }else{
        return 0;
     }
 }

?>