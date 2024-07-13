<?php
include("./inc/dbconnect.php");
session_start();
include("./inc/datacheck.php");

?>




<?php

$query = "SELECT * from wards";

$result = mysqli_query($conn, $query);

$rowcount = 0;

$avWardCount = 0;

if ($result) {
    $rowcount = mysqli_num_rows($result);
}

$query = "SELECT * from wards WHERE wardstatus='Yes'";

$result = mysqli_query($conn, $query);

if ($result) {
    $avWardCount = mysqli_num_rows($result);
}

$rowofdoc = 0;

$query = "SELECT * from doctors";

$result = mysqli_query($conn, $query);

if ($result) {
    $rowofdoc = mysqli_num_rows($result);
}

$avdocCount = 0;

$query = "SELECT * from doctors WHERE docstatus='Yes'";

$result = mysqli_query($conn, $query);

if ($result) {
    $avdocCount = mysqli_num_rows($result);
}

$allmedicount  = 0;

$query = "SELECT * from medicine";

$result = mysqli_query($conn, $query);

if ($result) {
    $allmedicount = mysqli_num_rows($result);
}

$avmediCount = 0;

$query = "SELECT * from medicine WHERE medistatus='Yes'";

$result = mysqli_query($conn, $query);

if ($result) {
    $avmediCount = mysqli_num_rows($result);
}
?>


<?php

$query = "SELECT wd.wardid,wardname,wardstatus,wd.docid,docname,docstatus FROM wards_doctors wd 
             INNER JOIN wards ON wd.wardid = wards.wardid
             INNER JOIN doctors ON wd.docid = doctors.docid;";

$result = mysqli_query($conn, $query);

query_check($result);

$table = "";

while ($row = mysqli_fetch_assoc($result)) {
    $table .= "<tr>";
    $table .= "<td>{$row['wardid']}</td>";
    $table .= "<td>{$row['wardname']}</td>";
    $table .= "<td>{$row['wardstatus']}</td>";
    $table .= "<td>Dr. {$row['docname']}</td>";
    $table .= "<td>{$row['docstatus']}</td>";
    $table .= "</tr>";
}


?>


<?php include("./inc/managerheader.php") ?>

<div class="container">
    <style>
        .status-item {
            padding-left: 20px;
        }

        .welcome {
            padding-left: 0;
        }

        .sc-row {
            padding: 12px;
        }

        .item {
            padding: 0 0px 10px 10px;
        }
    </style>
    <div class="row  mt-5">
        <div class="col-6 d-flex align-items-center ">
            <h2 class="welcome">Welcome <?php echo $_SESSION['username'] ?> to Hospital MS!</h2>

        </div>

        <div class="col-6">

        </div>
    </div>
    <div class="row sc-row mt-1">
        <div class="col-md-4 col-12 mt-3 ">
            <div class="st-head row">
                Wards Status
            </div>
            <div class="row">
                <div class="row">
                    <div class="col-6 status-item">No of All wards:</div>
                    <div class="col-6 status-item"><?php if (isset($rowcount)) {
                                                        echo $rowcount;
                                                    } else {
                                                        echo "##";
                                                    } ?></div>
                </div>
                <div class="row">
                    <div class="col-6 status-item">No of Open wards:</div>
                    <div class="col-6 status-item"><?php if (isset($avWardCount)) {
                                                        echo $avWardCount;
                                                    } else {
                                                        echo "##";
                                                    } ?></div>
                </div>
                <div class="row">
                    <div class="col-6 status-item">No of close wards:</div>
                    <div class="col-6 status-item"><?php echo $rowcount - $avWardCount ?></div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12 mt-3">
            <div class="st-head row">
                Doctors Status
            </div>
            <div class="row">
                <div class="row">
                    <div class="col-6 status-item">No of All Doctors:</div>
                    <div class="col-6 status-item"><?php if (isset($rowofdoc)) {
                                                        echo $rowofdoc;
                                                    } else {
                                                        echo "##";
                                                    } ?></div>
                </div>
                <div class="row">
                    <div class="col-6 status-item">No of Avaliable Doctors:</div>
                    <div class="col-6 status-item"><?php if (isset($avdocCount)) {
                                                        echo $avdocCount;
                                                    } else {
                                                        echo "##";
                                                    } ?></div>
                </div>
                <div class="row">
                    <div class="col-6 status-item">Not Avaliable Doctors:</div>
                    <div class="col-6 status-item"><?php echo $rowofdoc - $avdocCount ?></div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12 mt-3 ">
            <div class="st-head">
                Medicine Status
            </div>

            <div class="row">
                <div class="row">
                    <div class="col-6 status-item">No of All Medicine:</div>
                    <div class="col-6 status-item"><?php if (isset($allmedicount)) {
                                                        echo $allmedicount;
                                                    } else {
                                                        echo "##";
                                                    } ?></div>
                </div>
                <div class="row">
                    <div class="col-6 status-item">Avaliable Medicine:</div>
                    <div class="col-6 status-item"><?php if (isset($avmediCount)) {
                                                        echo $avmediCount;
                                                    } else {
                                                        echo "##";
                                                    } ?></div>
                </div>
                <div class="row">
                    <div class="col-6 status-item">Not Avaliable Medicine:</div>
                    <div class="col-6 status-item"><?php echo $avmediCount - $allmedicount  ?></div>
                </div>
            </div>
        </div>
    </div><!--  div class="row sc-row mt-1 -->

    <div class="row mt-4">
        <div class="d-flex flex-column ">
            <h2>Manager Functions</h2>
            <div class="item"><a href="./addwards.php">Add Wards</a></div>
            <div class="item"><a href="./adddoctor.php">Add Doctor</a></div>
            <div class="item"><a href="./addmedicine.php">Add Medicine</a></div>
            <div class="item"><a href="./managewards.php">Manage Wards</a></div>
            <div class="item"><a href="./managedoctors.php">Manage Doctors</a></div>
            <div class="item"><a href="./managemedicines.php">Manage Medicines</a></div>
            <div class="item"><a href="./wardassign.php">Assign Doctor to Wards</a></div>
        </div>
    </div>


    <div class="row mt-4">
        <h2>Overall Details</h2>
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Ward ID</th>
                        <th>Ward Name</th>
                        <th>Ward Status</th>
                        <th>Doctor Name</th>
                        <th>Doctor Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($table)) {
                        echo $table;
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
</div>