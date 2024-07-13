<?php
include("./inc/dbconnect.php");
session_start();
include("./inc/datacheck.php");

?>

<script>
    var option = {};
    var doctoroption = {};
</script>


<?php
$query = "SELECT * FROM wards WHERE wardstatus='yes'";

$result = mysqli_query($conn, $query);

query_check($result);

while ($row = mysqli_fetch_assoc($result)) {
    echo "<script>";
    echo "option[\"{$row['wardid']}\"] = \"{$row['wardname']}\" ";
    echo "</script>";
}

?>


<?php
$query = "SELECT * FROM doctors WHERE docstatus='yes' AND isdeleted=0 ";

$result = mysqli_query($conn, $query);

query_check($result);

while ($row = mysqli_fetch_assoc($result)) {
    echo "<script>";
    echo "doctoroption[\"{$row['docid']}\"] = \"{$row['docname']}\" ";
    echo "</script>";
}

?>


<?php

if (isset($_POST['submit'])) {
    $errors = array();

    echo "<pre>";
    echo print_r($_POST);
    echo "</pre>";

    $wardid = mysqli_real_escape_string($conn, $_POST['wardid']);
    $docid = mysqli_real_escape_string($conn, $_POST['doctorid']);

    if (!strlen(trim($wardid))) {
        $errors[] = "PLS SELECT ward !";
    }

    if (!strlen(trim($docid))) {
        $errors[] = "PLS SELECT ward !";
    }

    if (empty($errors)) {
        $query = "SELECT * FROM wards_doctors WHERE wardid='{$wardid}' AND docid='{$docid}'";

        $result = mysqli_query($conn, $query);

        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                echo "Doctor Already Assigned that ward or Invalid Data";
            } else {
                $query = "INSERT INTO wards_doctors(wardid,docid) VALUES('{$wardid}','{$docid}')";

                $result = mysqli_query($conn, $query);

                if ($result) {
                    echo "Doctor Assigned Success";
                } else {
                    die("Query faild");
                }
            }
        } else {
            die("Query faild");
        }
    }
}


?>

<?php include("./inc/managerheader.php") ?>

<div class="container">
    <div class="row mt-4">
        <h2>Assign Doctor to Wards <span><a href="./viewwd.php">+Manager Page</a></span></h2>
    </div>
    <div class="row">
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
        <form action="wardassign.php" method="post">

            <div class="mb-3 row">
                <label for="wards" class="col-sm-2 col-form-label">Ward Name</label>
                <div class="col-sm-10">
                    <select class="form-select" name="wardid" id="select-ward" aria-label="Default select example">

                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="warddescription" class="col-sm-2 col-form-label">Doctor Name:</label>
                <div class="col-sm-10">
                    <select class="form-select" name="doctorid" id="select-doctor" aria-label="Default select example">

                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">

                    <button type="submit" class="btn" name="submit">Submit</button>
                </div>

            </div>
        </form>


    </div>
</div>

<script>
    console.log(option);
    $(document).ready(() => {
        // option.forEach(element => {
        //     $('#select-ward').append("<option value=\"" + element + "\">" + element + "</option>")
        // });

        if (Object.keys(option).length >= 1) {
            Object.keys(option).forEach((key) => {
                console.log(key + " value is: " + option[key]);
                $('#select-ward').append("<option value=\"" + key + "\">" + option[key] + "</option>")
            });
        } else {
            $('#select-ward').append("<option value=\"\">Ward not avaliable</option>")
        }

    })

    $(document).ready(() => {

        if (Object.keys(doctoroption).length >= 1) {
            Object.keys(doctoroption).forEach((key) => {
                console.log(key + " value is: " + option[key]);
                $('#select-doctor').append("<option value=\"" + key + "\">" + doctoroption[key] + "</option>")
            });

        } else {
            $('#select-doctor').append("<option value=\"\">Doctors not avaliable</option>")
        }

    })
</script>


</body>