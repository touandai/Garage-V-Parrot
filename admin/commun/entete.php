<header>
    <div class="logo">
        <img src="../images/logo.png"/>
    </div>
    
    <div class="information-user">
        <span> Bonjour <b>
            <?php if($_SESSION['user_data']){                
             echo $_SESSION['user_data']['nom'].'-'.$_SESSION['user_data']['name'];
            }else {
             echo $_SESSION['user_data']['nom'].'-'.$_SESSION['user_data']['name'];
            }
            ?>
        </span>
        <span class="btn-deconnexion"><a href="?include=deconnexion"><img src="../images/logout.png" alt="Déconnexion"/></a></span>
    </div>
    <div class="clear"></div>
</header>

</body>
</html>
   
