<?php
include("./inc/dbconnect.php");
session_start();
include("./inc/datacheck.php");

?>

<?php

if (isset($_GET["search"])) {
    $search = $_GET["search"];

    $query = "SELECT * FROM wards WHERE wardname LIKE '%{$search}'";

    $result = mysqli_query($conn, $query);

    query_check($result);

    $table = "";

    if (mysqli_num_rows($result) >= 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            $table .= "<tr>";
            $table .= "<td>{$row['wardname']}</td>";
            $table .= "<td>{$row['warddes']}</td>";
            $table .= "<td>{$row['wardstatus']}</td>";
            $table .= "<td><a href=\"editward.php?wardid={$row['wardid']}\">Edit Wards</a></td>";
            $table .= "<td><a href=\"deleteward.php?wardid={$row['wardid']}\">Delete Wards</a></td>";
            $table .= "</tr>";
        }
    } else {
        $notava = "Data Not Avaliable";

        $query = "SELECT * FROM wards";

        $result = mysqli_query($conn, $query);

        query_check($result);

        $table = "";

        while ($row = mysqli_fetch_assoc($result)) {
            $table .= "<tr>";
            $table .= "<td>{$row['wardname']}</td>";
            $table .= "<td>{$row['warddes']}</td>";
            $table .= "<td>{$row['wardstatus']}</td>";
            $table .= "<td><a href=\"editward.php?wardid={$row['wardid']}\">Edit Wards</a></td>";
            $table .= "<td><a href=\"deleteward.php?wardid={$row['wardid']}\">Delete Wards</a></td>";
            $table .= "</tr>";
        }
    }
} else {
    $query = "SELECT * FROM wards";

    $result = mysqli_query($conn, $query);

    query_check($result);

    $table = "";

    while ($row = mysqli_fetch_assoc($result)) {
        $table .= "<tr>";
        $table .= "<td>{$row['wardname']}</td>";
        $table .= "<td>{$row['warddes']}</td>";
        $table .= "<td>{$row['wardstatus']}</td>";
        $table .= "<td><a href=\"editward.php?wardid={$row['wardid']}\">Edit Wards</a></td>";
        $table .= "<td><a href=\"deleteward.php?wardid={$row['wardid']}\">Delete Wards</a></td>";
        $table .= "</tr>";
    }
}







?>

<?php include("./inc/managerheader.php") ?>


<div class="container">
    <div class="row mt-4">
        <h2>Manageward Page <span><a href="addwards.php">+Add wards</a></span></h2>
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
                    <th scope="col">Ward Name</th>
                    <th scope="col">Ward Description</th>
                    <th scope="col">Ward Status</th>
                    <th scope="col">Edit ward</th>
                    <th scope="col">Delete ward</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $table ?>
            </tbody>
        </table>
    </div>
</div>

</body>