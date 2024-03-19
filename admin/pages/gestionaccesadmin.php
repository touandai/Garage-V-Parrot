<?php

if(!in_array($userConnecte['roles_id'], [1])){
echo "Vous n'êtes pas l'administrateur";die;

}