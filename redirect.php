<?php 
include "conn.php";
?>
<?php
if(isset($_GET["id"])) {
    $dotaz = $pdo->prepare("SELECT original_link 
    FROM link WHERE short_link = ?");
    $requestedLink = $_GET["id"];
    $dotaz->execute(array($requestedLink));
    $link = $dotaz->fetch();
    
    $original_link = $link[0];
    header("HTTP/1.1 301 Move Permanently");
    header('Location: http://' . $original_link);
} 
?>