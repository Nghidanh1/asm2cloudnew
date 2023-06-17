<?php
    include_once("Connection.php");
    if(isset($_GET["function"]) && $_GET["function"]=="del"){
        if(isset($_GET["id"])){
            $id = $_GET["id"];
            $sq = "select * from staff WHERE StaffID='$id'";
            $res = mysqli_query($conn, $sq);
            $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
            // $filePic = $row['Pro_image'];
            // unlink("product-imgs/".$filePic);
            mysqli_query($conn, "DELETE FROM staff WHERE StaffID='$id'");
        }
    }
?>

<!-- Bootstrap -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<script language="javascript">
    function deleteConfirm(){
        if(confirm("Are you sure to delete!")){
            return true;
        }
        else{
            return false;
        }
    }
</script>

<form name="frm" method="post" action="">
    <h1>Staff Management</h1>
    <p>
        <img src="images/add.png" alt="Add new" width="16" height="16" border="0"/> <a href="Add_Staff.php"> Add New </a>
    </p>
    <table id="tableproduct" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th><strong></strong></th>
                <th><strong>Staff ID</strong></th>
                <th><strong>Name</strong></th>
                <th><strong>Address</strong></th>
                <th><strong>Position</strong></th>
                <th><strong>Edit</strong></th>
                <th><strong>Delete</strong></th>
            </tr>
         </thead>
         <tbody>
            <?php
            $No = 1;
            $result = mysqli_query($conn, "SELECT * FROM staff");
            While($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
            ?>
            <tr>
                <td><?php echo $No; ?></td>
                <td><?php echo $row["StaffID"]; ?></td>
                <td><?php echo $row["Name"]; ?></td>
                <td><?php echo $row["Address"]; ?></td>
                <td><?php echo $row["Position"]; ?></td>
                <td align='center'>
                    <a href="?page=update_staff&id=<?php echo $row["StaffID"];?>">
                    <img src='images/edit.png' border='0'/></a>
                </td>
                <td align='center'>
                    <a href="?page=staff_management&function=del&id=<?php echo $row["StaffID"]; ?>"
                    onclick="return deleteConfirm()">
                    <img src='images/delete.png' border='0' />
                    </a>
                </td>
            </tr>
            <?php
                $No++;
            }
            ?>
        </tbody>
    </table>
</form>