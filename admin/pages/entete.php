<header>
    <div class="logo">
        <img src="../images/logo.png"/>
    </div>

    <?php 
        if(isset($_SESSION['user_data'])) {
    ?>
    <div class="information-user">
        
    <span> Bonjour, <b>
            <?php if($_SESSION['user_data']){               
             echo $_SESSION['user_data']['nom'].' ( '.$_SESSION['user_data']['name'].' )';
            }else {
             echo $_SESSION['user_data']['nom'].'-'.$_SESSION['user_data']['name'];
            }
            ?> 
        </span>
        <span class="btn-deconnexion"><a href="?pages=deconnexion">Me déconnecter? <img src="/<?= $document_root  ?>/admin/images/logout.png" title="Déconnexion" alt="Déconnexion"/></a></span>
    </div>
    <?php
    }
    ?>
    
    <div class="clear"></div>
</header>
</body>
</html>
   