<?php session_start() ?>
<?php include("./inc/dbconnect.php") ?>

<?php


if (isset($_GET["docid"])) {
    $docid = $_GET["docid"];
    $query = "UPDATE doctors SET isdeleted= 1 WHERE docid = '{$docid}'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: managedoctors.php?userdeleted=true");
    } else {
        header("Location: managedoctors.php?userdeleted=false");
    }
} else {
    header("Location: managedoctors.php?userid=notfound");
}


?>