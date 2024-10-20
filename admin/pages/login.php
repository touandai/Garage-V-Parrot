<?php
$titre ='Espace Admin';

require 'header.php';
require 'entete.php';

if(isset($_SESSION['user_data'])) {
header("location:?pages=dashboard");
}

if(array_key_exists('connexion',$_POST)){
	
    if(isset($_POST['email']) && empty($_POST['email'])){
        header("location:?pages=login&email=1");
        exit();
    }
    if(isset($_POST['password']) && empty($_POST['password'])){
            header("location:?pages=login&pwd=1");
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
            $userconnecte = $user;
            header("location:?pages=dashboard");
        }  else{
            header("location:?pages=login&erreur=1");
        }
        $echec="ce compte n'existe pas, enregistrer-vous d'abord";
        if (empty($user)){
            $_SESSION['echec'] = $echec;
            header("location:?pages=login&nouveau=1");

        }
       
}

?>

              


     <h1 class="text-center titre">Administration</h1>

     <main class="container page-connexion">
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
                     Mot de passe oublié? <a href="#"> Réinitialisé </a>
                     <p style = color:red; id="erreur">
                </fieldset>
            </form>
              
     </main>
     <!--footer-->
     <?php require 'footer.php';

     ?>
          
     