<?php

if(!$_SESSION["id_user"]){
    session_unset();
    header('Location: /');
}

?>