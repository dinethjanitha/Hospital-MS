<?php
include("./inc/dbconnect.php");
session_start();
include("./inc/datacheck.php");

?>


<?php

if (isset($_GET["search"])) {
    $search = $_GET["search"];

    $query = "SELECT * FROM doctors WHERE isdeleted=0 AND docname LIKE '%{$search}%' ";

    $result = mysqli_query($conn, $query);

    query_check($result);

    $table = "";

    if (mysqli_num_rows($result) >= 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            $table .= "<tr>";
            $table .= "<td>{$row['docname']}</td>";
            $table .= "<td>{$row['doctype']}</td>";
            $table .= "<td>{$row['docstatus']}</td>";
            $table .= "<td><a href=\"editdoctor.php?docid={$row['docid']}\">Edit Doctor</a></td>";
            $table .= "<td><a onclick=\"return confirm('are you sure?')\" href=\"deletedoctor.php?docid={$row['docid']}\">Delete Doctor</a></td>";
            $table .= "</tr>";
        }
    } else {
        $notava = "Data Not Avaliable";

        $query = "SELECT * FROM doctors WHERE isdeleted=0";

        $result = mysqli_query($conn, $query);

        query_check($result);

        $table = "";

        while ($row = mysqli_fetch_assoc($result)) {
            $table .= "<tr>";
            $table .= "<td>{$row['docname']}</td>";
            $table .= "<td>{$row['doctype']}</td>";
            $table .= "<td>{$row['docstatus']}</td>";
            $table .= "<td><a href=\"editdoctor.php?docid={$row['docid']}\">Edit Doctor</a></td>";
            $table .= "<td><a onclick=\"return confirm('are you sure?')\" href=\"deletedoctor.php?docid={$row['docid']}\">Delete Doctor</a></td>";
            $table .= "</tr>";
        }
    }
} else {
    $query = "SELECT * FROM doctors WHERE isdeleted=0";

    $result = mysqli_query($conn, $query);

    query_check($result);

    $table = "";

    while ($row = mysqli_fetch_assoc($result)) {
        $table .= "<tr>";
        $table .= "<td>{$row['docname']}</td>";
        $table .= "<td>{$row['doctype']}</td>";
        $table .= "<td>{$row['docstatus']}</td>";
        $table .= "<td><a href=\"editdoctor.php?docid={$row['docid']}\">Edit Doctor</a></td>";
        $table .= "<td><a onclick=\"return confirm('are you sure?')\" href=\"deletedoctor.php?docid={$row['docid']}\">Delete Doctor</a></td>";
        $table .= "</tr>";
    }
}








?>

<?php include("./inc/managerheader.php") ?>

<div class="container">
    <div class="row mt-4">
        <h2>Manage Doctor Page<span><a href="adddoctor.php">+Add Doctor</a></span></h2>
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
                    <th scope="col">Doctor Name</th>
                    <th scope="col">Doctor Type</th>
                    <th scope="col">Doctor Status</th>
                    <th scope="col">Edit Doctor</th>
                    <th scope="col">Delete Doctor</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $table ?>
            </tbody>
        </table>
    </div>
</div>

</body>