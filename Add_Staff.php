<!-- Bootstrap -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<script type="text/javascript" src="scripts/ckeditor/ckeditor.js"></script>

<?php
include_once("Connection.php");

function bind_Category_List($conn){
    $sqlstring = "SELECT StaffID, Name FROM staff";
    $result = mysqli_query($conn, $sqlstring);
    echo "<select name='StaffList' class='form-control'>
            <option value='0'>Choose category</option>";
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        echo "<option value='".$row['StaffID']."'>".$row['Name']."</option>";
    }
    echo "</select>";
}

if(isset($_POST["btnAdd"])){
    $id = $_POST["StaffID"];
    $name = $_POST["Name"];
    $address = $_POST['Address'];
    $position = $_POST['Position'];
    $err="";

    if(trim($id)==""){
        $err .="<li>Enter staff ID, please</li>";
    }
    if(trim($name)==""){
        $err .="<li>Enter Name, please</li>";
    }
    // if(trim($address)=="" || !is_numeric($address)){
    //     $err .="<li>Enter a valid address, please</li>";
    // }
    // if(trim($position)=="" || !is_numeric($position)){
    //     $err .="<li>Enter a valid position, please</li>";
    // }
    if($err !=""){
        echo "<ul>$err</ul>";
    }
    else{
        $sq="SELECT * FROM staff WHERE StaffID='$id' OR Name='$name'";
        $result = mysqli_query($conn, $sq);
        if(mysqli_num_rows($result)>0){
            echo "<li>Duplicate StaffID or Name</li>";
        }
        else{
            $sqlstring = "INSERT INTO staff(StaffID, Name, Address, Position) VALUES(?,?,?,?)";
            $stmt = $conn->prepare($sqlstring);
            $stmt->bind_param("ssss", $id, $name, $address, $position);
            if($stmt->execute()){
                echo "success";
                header("Location: ?page=Staff_Management");
                exit();
            }
            else{
                echo "fail";
            }
        } 
    }
}
?>

<div class="container">
    <h2>Adding new Staff</h2>

    <form id="frmProduct" name="frmProduct" method="post" enctype="multipart/form-data" action="" class="form-horizontal" role="form">
        <div class="form-group">
            <label for="txtTen" class="col-sm-2 control-label">Staff ID(*):</label>
            <div class="col-sm-10">
                <input type="text" name="StaffID" id="StaffID" class="form-control" placeholder="Staff ID" value=''/>
            </div>
        </div> 
        <div class="form-group"> 
            <label for="txtTen" class="col-sm-2 control-label">Name(*):</label>
            <div class="col-sm-10">
                <input type="text" name="Name" id="Name" class="form-control" placeholder="Name" value=''/>
            </div>
        </div>   
        <div class="form-group">  
            <label for="txtTen" class="col-sm-2 control-label">Address(*):</label>
            <div class="col-sm-10">
                <input type="text" name="Address" id="Address" class="form-control" placeholder="Address" value=''/>
            </div>
        </div>
        <div class="form-group">   
            <label for="lblGia" class="col-sm-2 control-label">Position(*):</label>
            <div class="col-sm-10">
                <input type="text" name="Position" id="Position" class="form-control" placeholder="Position" value=''/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-primary" name="btnAdd" id="btnAdd" value="Add new"/>
                <input type="button" class="btn btn-primary" name="btnIgnore" id="btnIgnore" value="Ignore" onclick="window.location='Product_Management.php'" />
            </div>
        </div>
    </form>
</div>