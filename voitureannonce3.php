<?php
$title ="Annonce véhicules, Peugeot Garage Parrot";

require 'header3.php';
require 'connexion.php';


$req = "SELECT * FROM public.annonces  where id=16";
$tdr = $conn -> query($req);
$resultat = $tdr -> fetchAll();

foreach($resultat as $key => $value){

?>

    <h1 class="text-center">Fiat Evo</h1>
    
    <main class="container content">

        <div class="row row-cols-2">

         <div id="carrousel" class="col text-center">
            <div class="images-box">
                <img src="images/evo2.png" alt="voiture" id="slider_img" > 
            </div>
            <br>
            <button class="btn" id="btn1" onclick="prev()">Precedant </button>
            <button class="btn" id="btn2" onclick="next()">Suivant </button>
        </div>

         <div id="detail" class="col rounded">
            <div>Titre: <em>Occasion</em></div>
            <div>Marque: <em><?php echo $value['marque']; ?> </em></div>
            <div>Modele: <em><?php echo $value['modele'];  ?> </em></div>
            <div>Année: <em><?php echo $value['annee']; ?> </em></div>
            <div>Kilometrage:<em><?php echo $value['Kilometre']; ?> </em></div>
            <div>Prix: <em><?php echo $value['prix']; ?> </em></div>
            <div>Energie: <em><?php echo $value['energie']; ?> </em></div>
            <div><p>Date mise en circulation:<em><?php
                           setlocale(LC_TIME,'fr');
                           $date = strftime('%d/%m/%Y',strtotime($value['date_circulations']));
                           echo  $date ?> 
            </em></div>
            <div><p>Description:<em><?php echo $value['description']; ?> </em></div>
         </div>
         <?php
        }
        ?>
     </main>

     <aside id="aside" class="container">
     <p id="vehicules"><em><a href="contact.php">Nous-contacter?</a></em>
    </p>
     </aside>

<?php
include 'footer.php';
?>


        <script>
        var slider = document.getElementById("slider_img");
        var images = ['evo2.png', 'evo3.png', 'evo4.png'];
        var i = 0 ;
        
        function prev(){
            if (i <= 0) i = images.length;i--;
            return setimg();
        }
        function next(){
            if ( i >= images.length -1) i =-1;
            i++;
            return setimg();
        }
        function setimg(){
            return slider.setAttribute('src', 'images/' + images[i]);
        }
     </script>

 </body>
</html>    