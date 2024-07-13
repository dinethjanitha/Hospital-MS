<?php
include("./inc/dbconnect.php");
session_start();
include("./inc/datacheck.php");

?>

<?php
$table = "";
if (isset($_GET["search"])) {
    $search = $_GET["search"];
    $query = "SELECT wd.wardid,wardname,wd.docid,docname FROM wards_doctors wd 
             INNER JOIN wards ON wd.wardid = wards.wardid
             INNER JOIN doctors ON wd.docid = doctors.docid WHERE docname LIKE '%{$search}%' ;";

    $result = mysqli_query($conn, $query);

    query_check($result);

    if (mysqli_num_rows($result) >= 1) {


        while ($row = mysqli_fetch_assoc($result)) {
            $table .= "<tr>";
            $table .= "<td>{$row['wardid']}</td>";
            $table .= "<td>{$row['wardname']}</td>";
            $table .= "<td>Dr. {$row['docname']}</td>";
            // $table .= "<td><a href=\"editwd.php?docid={$row['docid']}?wardid={$row['wardid']}\">Edit Doctor</a></td>";
            $table .= "<td><a onclick=\"return confirm('are you sure?')\" href=\"deletewd.php?docid={$row['docid']}&wardid={$row['wardid']}\">Delete Assign</a></td>";
            $table .= "</tr>";
        }
    } else {
        $notava = "Data Not Avaliable";
        $query = "SELECT wd.wardid,wardname,wd.docid,docname FROM wards_doctors wd 
             INNER JOIN wards ON wd.wardid = wards.wardid
             INNER JOIN doctors ON wd.docid = doctors.docid;";

        $result = mysqli_query($conn, $query);

        query_check($result);

        while ($row = mysqli_fetch_assoc($result)) {
            $table .= "<tr>";
            $table .= "<td>{$row['wardid']}</td>";
            $table .= "<td>{$row['wardname']}</td>";
            $table .= "<td>Dr. {$row['docname']}</td>";
            // $table .= "<td><a href=\"editwd.php?docid={$row['docid']}?wardid={$row['wardid']}\">Edit Doctor</a></td>";
            $table .= "<td><a onclick=\"return confirm('are you sure?')\" href=\"deletewd.php?docid={$row['docid']}&wardid={$row['wardid']}\">Delete Assign</a></td>";
            $table .= "</tr>";
        }
    }
} else {
    // echo "data not avaliable";
    $query = "SELECT wd.wardid,wardname,wd.docid,docname FROM wards_doctors wd 
             INNER JOIN wards ON wd.wardid = wards.wardid
             INNER JOIN doctors ON wd.docid = doctors.docid;";

    $result = mysqli_query($conn, $query);

    query_check($result);

    while ($row = mysqli_fetch_assoc($result)) {
        $table .= "<tr>";
        $table .= "<td>{$row['wardid']}</td>";
        $table .= "<td>{$row['wardname']}</td>";
        $table .= "<td>Dr. {$row['docname']}</td>";
        // $table .= "<td><a href=\"editwd.php?docid={$row['docid']}?wardid={$row['wardid']}\">Edit Doctor</a></td>";
        $table .= "<td><a onclick=\"return confirm('are you sure?')\" href=\"deletewd.php?docid={$row['docid']}&wardid={$row['wardid']}\">Delete Assign</a></td>";
        $table .= "</tr>";
    }
}



?>

<?php include("./inc/managerheader.php") ?>

<div class="container">
    <div class="row mt-4">
        <h2>Doctor's Wards Page<span><a href="./wardassign.php">+Add wards</a></span></h2>
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
                    <th scope="col">Ward ID</th>
                    <th scope="col">Ward Name</th>
                    <th scope="col">Doctor Name</th>
                    <!-- <th scope="col">Edit Status</th> -->
                    <th scope="col">Delete Assign</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $table ?>
            </tbody>
        </table>
    </div>
</div>

</body>