<?php include("./inc/managerheader.php") ?>

<?php
if (isset($_POST["submit"])) {

    $mediname = $_POST["mediname"];
    $medicatagory = $_POST["medicatagory"];

    $errors = array();

    $req_feild = array('mediname', 'medicatagory');

    $errors = array_merge($errors, required_feild($req_feild));

    $min_len = array("3" => "mediname", "2" => "medicatagory");

    $errors = array_merge($errors, min_len_check($min_len));

    if (empty($errors)) {
        $mediname = mysqli_real_escape_string($conn, $_POST["mediname"]);
        $medicatagory = mysqli_real_escape_string($conn, $_POST["medicatagory"]);
        $date = date('Y-m-d H:i:s');

        $query = "INSERT INTO medicine(mediname,medicatagory,addeddate,medistatus,isdeleted) VALUES('{$mediname}','{$medicatagory}','{$date}','Yes',0)";

        $result = mysqli_query($conn, $query);

        query_check($result);

        echo "Medinice Added";

        // header("refresh:2;url=managewards.php");
    }
}


?>

<div class="container">
    <div class="row justify-content-center ">
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
            <form action="addmedicine.php" method="post">
                <div class="row">
                    <h2>Add New Medicine<span><a href="managemedicines.php">+Manage Medicines</a></span></h2>
                </div>
                <div class="mb-3 row">
                    <label for="inputmedi" class="col-sm-2 col-form-label">Medicine Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="mediname" <?php if (isset($mediname)) {
                                                                echo "value='{$mediname}'";
                                                            } ?> class="form-control" id="inputmedi">
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
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">

                        <button type="submit" class="btn" name="submit">Submit</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>




</budy>