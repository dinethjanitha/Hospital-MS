<?php session_start() ?>
<?php include("./inc/dbconnect.php") ?>

<?php
if (!isset($_SESSION["username"]) && $_SESSION["userrole"] == "SystemAdmin") {
    header("Location: index.php?fromdelete");
}

if (isset($_GET["userid"])) {
    $userid = $_GET["userid"];
    if ($_SESSION["userid"] == $userid) {
        header("Location: adminpage.php?currentuserdelete=false");
    } else {
        $query = "UPDATE users SET isdelete= 1 WHERE userid = '{$userid}'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            header("Location: adminpage.php?userdeleted=true");
        } else {
            header("Location: adminpage.php?userdeleted=false");
        }
    }
} else {
    header("Location: adminpage.php?userid=notfound");
}


?>