<?php session_start() ?>
<?php include("./inc/dbconnect.php") ?>

<?php


if (isset($_GET["mediid"])) {
    $mediid = $_GET["mediid"];
    $query = "UPDATE medicine SET isdeleted= 1 WHERE mediid = '{$mediid}'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: managemedicines.php?userdeleted=true");
    } else {
        header("Location: managemedicines.php?userdeleted=false");
    }
} else {
    header("Location: managemedicines.php?userid=notfound");
}


?>