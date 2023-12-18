<?php
include "conn.php";

function fetchLastInsertedRow($pdo, $last)
{
    $sql = $pdo->prepare("SELECT short_link FROM link WHERE id = ?");
    $sql->execute(array($last));
    return $sql->fetch();
}


function testLink($test_link)
{
    if (preg_match("/^http:\/\//i", $test_link) || preg_match("/^https:\/\//i", $test_link)) {
        return true;
    } else {
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (testLink($_POST["link"])) {
        $originalLink = $_POST["link"];
        $sql = $pdo->prepare("INSERT into link (original_link) VALUES (?)");
        $result = $sql->execute(array($originalLink));
        // Get the last inserted ID
        $last = $pdo->lastInsertId();
        // Retrieve link that just have been inserted
        $lastInsertedLink = fetchLastInsertedRow($pdo, $last);
        // Redirect to the homepage
        header("Location: index.php?id=" . $lastInsertedLink[0]);
    } else {
        header("Location: index.php?error=t");
    }
}
?>