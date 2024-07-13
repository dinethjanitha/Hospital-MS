<?php session_start() ?>
<?php include("./inc/header.php") ?>
<?php include("./inc/dbconnect.php") ?>

<?php


if (isset($_SESSION["username"]) && $_SESSION["userrole"] == "SystemAdmin") {

    $query = "SELECT * FROM users WHERE isdelete=0";

    $result = mysqli_query($conn, $query);

    $table = "";
    if ($result) {
        if (mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_assoc($result)) {

                $table .= "<tr>";
                $table .= "<td>{$row['userid']}</td>";
                $table .= "<td>{$row['username']}</td>";
                $table .= "<td>{$row['email']}</td>";
                $table .= "<td>{$row['userrole']}</td>";
                $table .= "<td><a href='manageuser.php?userid={$row['userid']}'>Edit User</a></td>";
                $table .= "<td><a onclick=\"return confirm('are you sure?')\" href='deleteuser.php?userid={$row['userid']}'>Delete User</a></td>";
                $table .= "</tr>";
            }
        }
    }
} else {
    header("Location: index.php?access=false");
}



?>


<div class="container">
    <h3 class="mt-4">System Users <span><a href="addusers.php">+Add user</a></span></h3>
    <table class="table mt-5">
        <thead>
            <th scope="col">User ID</th>
            <th scope="col">User Name</th>
            <th scope="col">Email</th>
            <th scope="col">User Roles</th>
            <th scope="col">Manage</th>
            <th scope="col">Delete</th>
        </thead>
        <tbody>

            <?php echo $table ?>
        </tbody>
    </table>
</div>

</body>