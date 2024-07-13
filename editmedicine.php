<?php
include("./inc/dbconnect.php");
session_start();
include("./inc/datacheck.php");

if (isset($_GET['mediid'])) {
    $mediid = $_GET['mediid'];

    $query = "SELECT * FROM medicine WHERE mediid = {$mediid} LIMIT 1";
    $result = mysqli_query($conn, $query);
    query_check($result);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $mediname = $row['mediname'];
        $medicatagory = $row['medicatagory'];
        $medistatus = $row['medistatus'];
        $mediid = $row['mediid'];
    } else {
        header("Location: managemedicines.php?userfound=false");
        exit();
    }
} else {
    header("Location: managemedicines.php?err=false");
    exit();
}

if (isset($_POST["submit"])) {
    $mediname = $_POST["mediname"];
    $medicatagory = $_POST["medicatagory"];
    $medistatus = $_POST["medistatus"];
    $mediid = $_POST['mediid'];

    $errors = array();
    $req_feild = array('mediname', 'medicatagory');
    $errors = array_merge($errors, required_feild($req_feild));
    $min_len = array("2" => "mediname", "3" => "medicatagory");
    $errors = array_merge($errors, min_len_check($min_len));

    if (empty($errors)) {
        $mediname = mysqli_real_escape_string($conn, $_POST["mediname"]);
        $medicatagory = mysqli_real_escape_string($conn, $_POST["medicatagory"]);
        $medistatus = mysqli_real_escape_string($conn, $_POST["medistatus"]);

        $query = "UPDATE medicine SET mediname='{$mediname}', medistatus='{$medistatus}', medicatagory='{$medicatagory}' WHERE mediid='{$mediid}' ";
        $result = mysqli_query($conn, $query);
        query_check($result);

        $success = "Medicine Updated!";
        header("refresh:2;url=managemedicines.php?mediup=success!");
        exit();
    }
}
?>

<?php include("./inc/managerheader.php") ?>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8 mt-5">
                <?php
                if (isset($errors) && !empty($errors)) {
                    echo "<h3>Errors:</h3>";
                    echo "<ul>";
                    foreach ($errors as $error) {
                        echo "<li>$error</li>";
                    }
                    echo "</ul>";
                }
                ?>
                <div class="row">
                    <h3><?php if (isset($success)) {
                            echo $success;
                        } ?></h3>
                </div>
                <form action="#" method="post">
                    <div class="row">
                        <h2>Edit Medicine<span><a href="managemedicines.php">+Manage wards</a></span></h2>
                    </div>
                    <input type="hidden" name="mediid" <?php if (isset($mediid)) {
                                                            echo "value='{$mediid}'";
                                                        } ?>>
                    <div class="inputs mt-4">
                        <div class="mb-3 row">
                            <label for="mediname" class="col-sm-2 col-form-label">Medi Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="mediname" <?php if (isset($mediname)) {
                                                                        echo "value='{$mediname}'";
                                                                    } ?> class="form-control" id="mediname">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="medicatagory" class="col-sm-2 col-form-label">Medi Catagory</label>
                            <div class="col-sm-10">
                                <input type="text" name="medicatagory" <?php if (isset($medicatagory)) {
                                                                            echo "value='{$medicatagory}'";
                                                                        } ?> class="form-control" id="medicatagory">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="medistatus" class="col-sm-2 col-form-label">Medi Status</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="medistatus" aria-label="">
                                    <option id="Yes" value="Yes">Yes</option>
                                    <option id="No" value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn" name="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    echo "<script>";
    echo "document.getElementById(\"{$medistatus}\").setAttribute(\"selected\", \"\");";
    echo "</script>";
    ?>
</body>

</html>