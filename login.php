<?php

if (isset($_POST['name']) && isset($_POST['pwd'])){
 
    function validate($data){
    $date = trim($data);
    $date = stripslashes($data);
    $date = htmlspecialchars($data);
    return $data;

   }
   $name = validate($_POST['name']);
   $password = validate($_post['password']);
   
        if (empty($name)){
          header("Location: compteperso.php?erreur=User Name is required");
          exit();
        }else if (empty($password)){
          header("Location: compteperso.php?erreur=Password Votre mot de pass est obligatoire");
        }else{
            echo "Valid input";
        }

}else{
    header("Location: compteperso.php");
exit();

}

?>