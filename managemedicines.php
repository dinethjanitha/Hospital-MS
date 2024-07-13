<?php
include("./inc/dbconnect.php");
session_start();
include("./inc/datacheck.php");

?>

<?php

if (isset($_GET["search"])) {
    $search = $_GET["search"];

    $query = "SELECT * FROM medicine WHERE isdeleted=0 AND mediname LIKE '%{$search}%'";

    $result = mysqli_query($conn, $query);

    query_check($result);

    $table = "";

    if (mysqli_num_rows($result) >= 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            $table .= "<tr>";
            $table .= "<td>{$row['mediname']}</td>";
            $table .= "<td>{$row['addeddate']}</td>";
            $table .= "<td>{$row['medicatagory']}</td>";
            $table .= "<td>{$row['medistatus']}</td>";
            $table .= "<td><a href=\"editmedicine.php?mediid={$row['mediid']}\">Edit Medicine</a></td>";
            $table .= "<td><a href=\"deletemedi.php?mediid={$row['mediid']}\">Delete Medicine</a></td>";
            $table .= "</tr>";
        }
    } else {
        $notava = "Data not Avaliable";
        $query = "SELECT * FROM medicine WHERE isdeleted=0";

        $result = mysqli_query($conn, $query);

        query_check($result);

        $table = "";

        while ($row = mysqli_fetch_assoc($result)) {
            $table .= "<tr>";
            $table .= "<td>{$row['mediname']}</td>";
            $table .= "<td>{$row['addeddate']}</td>";
            $table .= "<td>{$row['medicatagory']}</td>";
            $table .= "<td>{$row['medistatus']}</td>";
            $table .= "<td><a href=\"editmedicine.php?mediid={$row['mediid']}\">Edit Medicine</a></td>";
            $table .= "<td><a href=\"deletemedi.php?mediid={$row['mediid']}\">Delete Medicine</a></td>";
            $table .= "</tr>";
        }
    }
} else {
    $query = "SELECT * FROM medicine WHERE isdeleted=0";

    $result = mysqli_query($conn, $query);

    query_check($result);

    $table = "";

    while ($row = mysqli_fetch_assoc($result)) {
        $table .= "<tr>";
        $table .= "<td>{$row['mediname']}</td>";
        $table .= "<td>{$row['addeddate']}</td>";
        $table .= "<td>{$row['medicatagory']}</td>";
        $table .= "<td>{$row['medistatus']}</td>";
        $table .= "<td><a href=\"editmedicine.php?mediid={$row['mediid']}\">Edit Medicine</a></td>";
        $table .= "<td><a href=\"deletemedi.php?mediid={$row['mediid']}\">Delete Medicine</a></td>";
        $table .= "</tr>";
    }
}








?>

<?php include("./inc/managerheader.php") ?>


<div class="container">
    <div class="row mt-4">
        <h2>Manageward Page <span><a href="addmedicine.php">+Add wards</a></span></h2>
    </div>

    <div class="row mt-3 mb-3">
        <h4 style="color:red"><?php if (isset($notava)) {
                                    echo $notava;
                                } ?></h4>
    </div>

    <form action="viewwd.php" method="get">
        <div class="row align-items-center">
            <div class="col-8">

                <input type="text" placeholder="Search here" class="col-12 form-control" name="search">

            </div>
            <div class="col-4">
                <button class="btn bg-primary" type="submit">Search</button>
            </div>
        </div>
    </form>
    <div class="row mt-3">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Medicine Name</th>
                    <th scope="col">Medicine Added date</th>
                    <th scope="col">Medicine Catagory</th>
                    <th scope="col">Medicine Status</th>
                    <th scope="col">Edit Medicine</th>
                    <th scope="col">Delete Medicine</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $table ?>
            </tbody>
        </table>
    </div>
</div>

</body>