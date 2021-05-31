<?php
session_start();
session_destroy();

// on se redirige vers la page index:
header('location:../index/index.php?msg= Merci de votre visite.');
exit;