<?php

$error = array( );
$titre =$_POST["titre"];
$contenu = $_POST["contenu"];
$soustitre = $_POST["soustitre"];
$auteur = $_POST["auteur"];


if (empty($titre)) {
    $error['titre'] = false; 
}else{
    $error['titre'] = true;
}

if (empty($_POST["contenu"])) {
    $error['contenu'] = false;
}else{
    $error['contenu'] = true;      
}

if (empty($_POST["soustitre"])) {
    $error['soustitre'] = false;
}else{
    $error['soustitre'] = true;      
}

if (empty($_POST["auteur"])) {
    $error['auteur'] = false;
}else{
    $error['auteur'] = true;      
}   

if ($error['titre'] == true  && $error['contenu'] == true && $error['soustitre'] == true && $error['auteur'] == true ){

    $servername = "localhost"; 
    $username = "bmarine";
    $password = "bmarine@2017";
    $dbname = "bmarine";

    

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // prepare sql and bind parameters
            $req = $conn->query("SELECT MAX(id) AS id FROM articles");
            $result = $req->fetch();
            $id = ($result['id']==NULL) ? 1 : $result['id']+1;
            $stmt = $conn->prepare("INSERT INTO articles (titre, auteur, soustitre, contenu, image) 
            VALUES (:titre, :auteur, :soustitre, :contenu, :image)");  
            $stmt->bindParam(':titre', $titre);
            $stmt->bindParam(':auteur', $auteur);
            $stmt->bindParam(':soustitre', $soustitre);
            $stmt->bindParam(':contenu', $contenu);
            $stmt->bindParam(':image', $image);
            // insert a row
            $titre = htmlspecialchars($_POST["titre"]);
            $auteur = htmlspecialchars($_POST["auteur"]);
            $soustitre = htmlspecialchars($_POST["soustitre"]);
            $contenu = htmlspecialchars($_POST["contenu"]);
            $image = "../imgpost/".$id."-".$_FILES["image"]["name"];
            $stmt->execute();
            
            $error['bdd'] =  "New records created successfully";
            
                if ($_FILES['image']['error'] == 0){
                    move_uploaded_file ( $_FILES["image"]["tmp_name"], "../imgpost/".$id."-".$_FILES["image"]["name"]);
                }

            
            }

        catch(PDOException $e)
            {
             $error["bdd"] =  "Error: " . $e->getMessage();
            }

    $conn = null;
                                                                                                    
}; 


    $phototable = array($_FILES['image']['name'], $_FILES['image']['tmp_name'], $_FILES['image']['type'], $_FILES['image']['size'], $_FILES['image']['error']);

    $table = array($titre, $soustitre, $contenu, $auteur, $phototable);

    echo json_encode($table);


?>