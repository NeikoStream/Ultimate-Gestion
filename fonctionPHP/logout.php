<?php
  session_start();
  session_destroy();  
  header('Location: ../index.php'); // Renvoie vers -> la page de login a savoir l'index
?>