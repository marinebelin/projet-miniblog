<?php

$servername = "localhost"; 
$username = "bmarine";
$password = "bmarine@2017";
$dbname = "bmarine";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // prepare sql and bind parameters
            $stmt = $conn->prepare("INSERT INTO articles (titre, auteur, soustitre, contenu) 
            VALUES (:titre, :auteur, :soustitre, :contenu)");  
            $stmt->bindParam(':titre', $titre);
            $stmt->bindParam(':auteur', $auteur);
            $stmt->bindParam(':soustitre', $soustitre);
            $stmt->bindParam(':contenu', $contenu);
            // insert a row
            $titre = $_POST["titre"];
            $auteur = $_POST["auteur"];
            $soustitre = $_POST["soustitre"];
            $contenu = $_POST["contenu"];
            $stmt->execute();
            
            }

        catch(PDOException $e)
            {
             $error["bdd"] =  "Error: " . $e->getMessage();
            }

$conn = null;
   
?>
