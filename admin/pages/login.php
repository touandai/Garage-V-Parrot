<?php 
$titre ='Espace Admin';

require 'header.php';
require 'entete.php';

require '../connexion.php';

//romaric.nganas@gmail.com
//Romaric10

if(array_key_exists('connexion',$_POST)){
	
    if(isset($_POST['email']) && empty($_POST['email'])){
        header("location:?email=1");
        exit();
    }
    if(isset($_POST['password']) && empty($_POST['password'])){
            header("location:?pwd=1");
         exit();
    }
    
       $reqInsert = "SELECT u.*, r.name FROM  public.users u LEFT JOIN public.roles r ON r.id = u.roles_id WHERE email = :email AND password = :password";
       $tbr = $conn -> prepare($reqInsert);
       $tbr -> execute ([
         ":email"    =>$_POST['email'],
         ":password" =>$_POST['password'],
       ]);
       $user = $tbr ->fetch();
       if(!empty($user)){
            $_SESSION['user_data'] = $user;
            header("location:?pages=tableau-de-bord");die;
        }  else{
            header("location:?erreur=1");die;
        }
        $echec="ce compte n'existe pas, enregistrer-vous d'abord";
        if (empty($user)){
            $_SESSION['echec'] = $echec;
            header("location:?nouveau=1");die;

        }
}

?>


    <h1 class="text-center">Espace Admin </h1>

     <main id="connecter" class="container page-connexion">
            <form id="connecte" class="form" method="POST" action="">  
                <fieldset>
                    <legend>Espace Admin.</legend> 
                    <div class="input-row">
                     <label class="form-label" for="name">Nom / Email : *</label>
                     <input class="form-control form-control-sm" type="email" name="email" id="email" placeholder="Dupont">
                     <?php
                        if(isset($_GET['email']) && ($_GET['email']==1)){
                        echo '<span><font color="red">Votre email est obligatoire</font></span>';
                        }
                      ?>
                    </div>
                    <div class="input-row">
                     <label class="form-label" for="password">Password: *</label>
                     <input  class="form-control form-control-sm" type="password" name="password" id="password" placeholder="mot de pass">
                     <?php
                        if(isset($_GET['pwd']) && ($_GET['pwd']==1)){
                        echo '<span><font color="red">Le mot de pass est obligatoire</font></span>';
                        }
                        if(isset($_GET['nouveau']) && ($_GET['nouveau']==1)){
                            echo "<span><font color='red'>Vous n'êtes pas encore inscrit </font></span>";
                            }
                      ?>  
                      <?php    
                       if(isset($_GET['erreur']) && ($_GET['erreur']==1)){
                            echo "<span><font color='red'>Pseudo ou mot de pass incorrect</font></span>";
                            }
                            ?>             
                    </div>
                     <br>
                     <button class="btn btn-primary" name="connexion" type="submit" id="connect">Connexion</button>
                     Nouveau client? <a href="inscriptions.php">Inscrivez-vous d'abord</a>
                     <p style = color:red; id="erreur">
                </fieldset>
            </form> 
              
     </main>

     <!--footer-->
     <?php require 'footer.php'; ?> 
          
     