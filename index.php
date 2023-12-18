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

    <div class="wrapper">
        <h1>Zkracovač</h1>
        <form action="shorten.php" method="post" class="shortener">
            <input type="url" name="link" required>
            <input type="submit" name="submit" value="Zkrátit">
        </form>
        <?php
        handleAddedLink();
        ?>
    </div>
</body>

</html>

<?php




function message($content)
{
    return "<div class='message'>$content</div>";
}
function handleAddedLink()
{
    if (isset($_GET["id"])) {
        $link = $_GET["id"];
        echo message("Děkujeme za využití zkracovače! Odkaz je <a href='http://localhost/zkracovac/@$link'>WWW/$link</a>");
    } else if (isset($_GET["error"])) {
        echo message("Vámi zaslaný text není odkaz, nebyl tedy přidán do zkracovače!");
    }

}
?>