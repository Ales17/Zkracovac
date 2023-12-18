<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Zkracovač</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/main.css'>
</head>

<body>
    <h1>Zkracovač</h1>
    <form action="" method="post" class="shortener">
        <input type="text" name="link" required>
        <input type="submit" name="submit" value="Zkrátit">
    </form>
   
    <?php
    include "conn.php";
    function shortLinkElement($link)
    {
        return '<div>Děkujeme za použití zkracovače. Zkrácený odkaz najdete na adrese: ' . $link . '</div>';
    }

    function getShortLink($url)
    {
        return '<a href="http://' . $url . '">' . $url . '</a>';
    }


    if (isset($_POST["submit"])) {
        $random = rand(10000, 99999);
        $originalLink = $_POST["link"];
        $sql = $pdo->prepare("INSERT into link (original_link/* , short_link */) 
    VALUES (?/* , ? */)");
        $result = $sql->execute(array($originalLink /* , $random */));

        $last = $pdo->lastInsertId();

        $sql = $pdo->prepare("SELECT short_link FROM link WHERE id = ?");
        $sql->execute(array($last));

        $inserted = $sql->fetch();
        $serviceUrl = "localhost/zkracovac/@";
        $shortLink = $serviceUrl . $inserted[0];

        echo shortLinkElement(getShortLink($shortLink));

    }

    ?>

</body>

</html>