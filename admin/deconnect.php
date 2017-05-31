<?php

session_start();
session_destroy();

setcookie('resterco','',time());

header('Location: http://vesoul.codeur.online/front/bmarine/miniblog/index.php');

exit();
?>