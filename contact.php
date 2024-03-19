<?php 
$title ='Contact, Garage V. Parrot entretien mécanique'; 
include 'header2.php';
include 'nav-apropos.php';  

include 'connexion.php';

/*$to ="vincentpp@gmail.com";
$subject="";
$nom = "";
$prenom= "";
$email = "";
$tel = "";
$message= "Bonjour";

$headers = "Content-Type: text/plain; charset=utf-8\r\n";
$headers .= "From: romaric.nganas@outlook.fr\r\n";

if (mail($to, $subject,  $headers))
 echo "votre message est bien envoyé";
 else 
echo "erreur envoi";
*/

        if(array_key_exists('envoyer',$_POST)){

            if(isset($_POST['nom']) && !empty($_POST['nom']) AND isset($_POST['nom']) && !empty($_POST['email']) AND isset($_POST['nom']) && !empty($_POST['message'])){
               
        
                //fonction pour valider les données et éviter les inections de type XSS

                function validation_donnees($donnees){

                $donnees = trim($donnees);
                $donnees = stripslashes($donnees);
                $donnees = htmlspecialchars($donnees);

                return $donnees;
                }
            
                $nom = validation_donnees($_POST['nom']);
                $prenom = validation_donnees($_POST['prenom']);
                $email = validation_donnees($_POST['email']);
                $telephone = validation_donnees($_POST['telephone']);
                $message = validation_donnees($_POST['message']);
                                         
              
                         $reqInsert ='INSERT INTO public.contact(nom, prenom, email, telephone, message, date_contact)
                          values (:nom, :prenom, :email, :telephone, :message, :date)';
         
                        $reqInsertion = $conn -> prepare ($reqInsert);
                        $enregister = $reqInsertion->execute([
                         
                         ":nom" => $nom,   
                         ":prenom" => $prenom,
                         ":email" => $email,
                         ":telephone" => $telephone,
                         ":message" => $message,
                         ":date" =>date('Y-m-d h:m:s'),
                         
                         ]);

                         header("location:confirmation.php");
            }


        }                


?>

<br>
<h2 class="text-center">Nous-contactez?</h2>

     <main class="container">
        <section>
            <form id="contact" class="form" method="POST" action="">  
                <fieldset>
                    <legend>Pour toutes vos remarques, merci de nous contacter.</legend>        
                    
                    <div class="input-row">
                     <label class="form-label" for="inputname">Nom : *</label>
                     <input class="form-control form-control-sm" type="texte" name="nom" placeholder="Dupont"/>
                     <?php 
                      $erreur='Le Nom est obligatoire ! ';
                       if(isset($_POST['message'])){ 
                       echo "<strong>  $erreur  </strong>";
                       }
                       ?>
                    </div>
                    <div class="input-row">
                     <label class="form-label" for="inputusername">Prenom : *</label>
                     <input class="form-control form-control-sm" type="texte" name="prenom" id="inputname"/>
                    </div>
                    
                    <div class="input-row">
                     <label class="form-label" for="inputemail">E-mail: *</label>
                     <input  class="form-control form-control-sm" type="email" name="email" id="email" placeholder="monadresse@....."/>
                     <?php 
                       $erreur='Votre email est obligatoire ! ';
                       if(isset($_POST['email'])){ 
                        echo "<strong>  $erreur  </strong>";
                       }
                       ?>
                    </div>
                    <div class="input-row">
                     <label class="form-label" for="phone">Telephone : </label>
                     <input class="form-control form-control-sm" type="texte" minlength="10" maxlength="10" name="telephone"/>
                    </div>
                    
                    <div class="input-row">
                     <label class="form-label" for="inputmessage">Message: * </label>
                     <textarea class="form-control" name="message" id="inputmessage" placeholder=" Ecrivez ici votre message..."></textarea>
                     <?php 
                      $erreur='Vous devez saisir obligatoirement votre message ! ';
                     if(isset($_POST['message'])){ 
                      echo "<strong>  $erreur  </strong>";
                     }
                     ?>
                    </div>
                     <br>
                     <button class="btn btn-primary" name="envoyer" type="submit">Envoyer</button>
                 
                </fieldset>
            </form> 
          </section>   
     </main>


     <!--footer-->
     <?php include 'footer.php'; ?>  
