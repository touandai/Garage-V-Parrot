<!--header-2-->
<?php 
 $title ='Rendez-vous';

require 'header2.php'; 
require 'nav-apropos.php';
require 'connexion.php'; 
  

  if(array_key_exists('valider',$_POST)){
    
      if(isset($_POST['civilite']) && empty($_POST['civilite'])){
        header("location:?civilite=1");
        exit();
      }
      if(isset($_POST['nom']) && empty($_POST['nom'])){
        header("location:?nom=1");
        exit();
      }
      if(isset($_POST['telephone']) && empty($_POST['telephone'])){
        header("location:?telephone=1");
        exit();
      }
      if(isset($_POST['email']) && empty($_POST['email'])){
        header("location:?email=1");
        exit();
      }
      if(isset($_POST['prestation']) && empty($_POST['prestation'])){
        header("location:?prestation=1");
        exit();
      }
      if(isset($_POST['creneaux']) && empty($_POST['creneaux'])){
        header("location:?creneaux=1");
        exit();
      }

 

        function validationDonnees($donnees){

          $donnees = trim($donnees);
          $donnees = stripslashes($donnees);
          $donnees = htmlspecialchars($donnees);

          return $donnees;
          }
      
          $civilite = validationDonnees($_POST['civilite']);
          $immatriculation = validationDonnees($_POST['immatriculation']);
          $nom = validationDonnees($_POST['nom']);
          $prenom = validationDonnees($_POST['prenom']);
          $telephone = validationDonnees($_POST['telephone']);
          $email = validationDonnees($_POST['email']);
          $prestation = validationDonnees($_POST['prestation']);
          $creneaux = validationDonnees($_POST['creneaux']);
          $message = validationDonnees($_POST['message']);


          $reqInsert = "INSERT INTO public.rendez_vous (civilite, immatriculation, nom, prenom, telephone, email, prestation, creneaux, message, date_validation, statut)
          values (:civilite, :immatriculation, :nom, :prenom, :telephone, :email, :prestation, :creneaux, :message, :date, :statut)";
          
          $tbr = $conn -> prepare($reqInsert);
          $save = $tbr -> execute ([
              
              ":civilite"=> $_POST['civilite'],
              ":immatriculation"=> $_POST['immatriculation'],
              ":nom"=> $_POST['nom'],
              ":prenom"=> $_POST['prenom'],
              ":telephone"=> $_POST['telephone'],
              ":email"=> $_POST['email'],
              ":prestation"=> $_POST['prestation'],
              ":creneaux"=> $_POST['creneaux'],
              //":creneaux"=> $creneaux['creneaux'],//
              ":message"=> $_POST['message'],
              ":date" =>date('Y-m-d h:m:s'),
              ":statut"=> "En attente",
             // ":date" =>date('Y-m-d h:m:s'),
            
              ]);
              header("location:confirmation.php");die;

                /*if($save){
                  header("Location:?save=1");
                }else { 
                  header("Location:?save=0");
                }
                */
    }          

    /*
$req = "select * from public.roles";
    $tbr = $conn -> query($req);
    $result = $tbr ->fetchAll();
//controle affichage des roles//
*/
?>

<br>
<h2 class="text-center">Prise de rendez-vous </h2>

     <main class="container rdv">
      <section class="section">  
  
           <form class="form" method="POST" action="">

                <fieldset>
                    <legend>Les champs précédés d'astérix sont obligatoires.</legend>
                        
                      <div class="input-row">
                      <label>Civilité :* </label>
			                <select class="form-control" name="civilite">
                            <option value="">--Civilité--</option>
                            <option value="Monsieur">Monsieur</option>
                            <option value="Madame">Madame</option>
                      </select>      
                       <?php
                        if(isset($_GET['civilite']) && $_GET['civilite']==1){
                        echo "<strong> Merci d'indiquer la civilité !</strong>";
                        }
                       ?>
                        </div>
                        <br>

                        <div class="input-row">
                        <label for="immatriculation">Renseigner votre plaque d'immatriculation : </label>
                        <input class="form-control" type="text" name="immatriculation" minlength="7" maxlength="7">
                        </div>

                        <div class="input-row">
                        <label>Nom :* </label>
                        <input class="form-control" type="text" name="nom">
                        <?php
                        if(isset($_GET['nom']) && $_GET['nom']==1){
                        echo '<strong> Veuillez indiquer votre nom ! </strong>';
                        }
                       ?>
                        </div>

                        <div class="input-row">
                        <label>Prenom : </label>
                        <input class="form-control" type="text" name="prenom">
                        </div>

                        <div class="input-row">
                        <label>Telephone : </label>
                        <input class="form-control" type="text" name="telephone" maxlength="10">
                        <?php
                        if (isset($_GET['telephone']) && $_GET['telephone']==1){
                        echo '<strong>Veuillez indiquer un numero de telephone!</strong>';
                        }
                       ?>
                       </div>

                        <div class="input-row">
                        <label>E-mail :* </label>
                        <input class="form-control" type="text" name="email">
                        <?php
                        if(isset($_GET['email']) && $_GET['email']==1){
                        echo '<strong> Veuillez indiquer votre email ! </span>';
                        }
                       ?>
                        </div>

                        <div class="input-row">
                        <label>Prestation :* </label>
                        <select class="form-control" name="prestation">
                            <option value="">--Veuillez choisir une prestation</option>
                            <option value="Réparation Mécanique" name="mécanique" >Réparation Mécanique</option>
                            <option value="Réparation Carrosserie" name="carrosserie">Réparation Carrosserie</option>
                            <option value="Visite voiture d'occasion" name="occasionvehicule" >Visite voiture d'occasion</option>
                        </select>
                        <?php
                        if(isset($_GET['prestation']) && $_GET['prestation']==1){
                        echo '<strong> Merci de choisir une prestation!</strong>';
                        }
                       ?>
                        </div>
                        <br>

                        <div class="input-row">
                        <label> Date et créneaux disponibles :* </label>
                       <!-- <input type="date" name="date_rdv" min="<?php echo date('d/m/Y') ?>" max="2024-06-01" />
                        -->
                        <select class="form-control" name="creneaux">
                                <option value="">--Choisissez votre date--</option>
                                <option value="Lundi-05042024-10h00">Lundi-05-04-2024-10h00</option>
                                <option value="Lundi-05042024-11h00">Lundi-05-04-2024-11h00</option>
                                <option value="Mardi-06042024-11h00">Mardi 06-04-2024-11h00</option>
                                <option value="Mardi-06042024-11h00">Mardi 06-04-2024-11h00</option>
                                <option value="Mercredi-07042024-10h00">Mercredi 07-04-2024-10h00</option>
                                <option value="Mercredi-07042024-10h00">Mercredi 07-04-2024-10h00</option>
                                <option value="Jeudi-08042024-10h00">Jeudi 08-04-2024-10h00</option>
                                <option value="jeudi-08042024-10h00">jeudi 08-04-2024-10h00</option>
                                <option value="vendredi-09042024-10h00">vendredi 09-04-2024-10h00</option>
                                <option value="vendredi-09042024-10h00">vendredi 09-04-2024-10h00</option>
                                <option value="vendredi-10042024-10h00">vendredi 10-04-2024-10h00</option>
                        </select>
                        <?php
                        if(isset($_GET['creneaux']) && $_GET['creneaux']==1){
                        echo '<strong> Veuillez choisir un creneau ! </strong>';
                        }
                        ?>
                        </div>
                        <br>

                        <div class="input-row">
                        <label>Message :</label>
                        <textarea class="form-control" name="message" placeholder="votre message ici "></textarea>
                        </div>
                        <br>

                        <button class="btn btn-primary" type="submit" id="valider" name="valider">Valider</button>
                        <br>
                      </div>
                </fieldset>
            </form>
       </section>
     </main>




     <script>
     let Form = document.getElementById('valider');
     Form.addEventListener('click', function(e){
     alert('Un email de confirmation vous serez envoyé sous 48h, après validation de votre demande merci!')
     })
     </script>
<?php
require 'footer.php'; 

?>
     