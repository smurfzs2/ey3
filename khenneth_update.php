<?php include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

<?php
    
    if(isset($_POST['submitBtn']))
    {
        $id = $_POST['id'];
        $firstName = $_POST['firstName'];
        $lastName =  $_POST['lastName']; 
        $birthDate = $_POST['birthDate'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $departmentName = $_POST['departmentName'];

        $tblUpdate = "UPDATE tbl_khenneth SET firstName='$firstName', lastName='$lastName', birthDate='$birthDate', address='$address', gender='$gender',  departmentId='$departmentName' WHERE id='$id' ";

        $tblUpdateQuery = mysqli_query($con, $tblUpdate);

        if($tblUpdateQuery)
        {
            echo "Record updated successfully";
            header("Location:  index.php");
        }else {
            echo "Error updating record";
            header("Location:  index.php");
        }
    }
    ?>

    <?php
        $id = $_GET['id'];
        $updateId = "SELECT * FROM tbl_khenneth WHERE id='$id' ";
        $updateQuery = $con->query($updateId);

        if($updateQuery->num_rows > 0)
        {
            while($queryResult = $updateQuery->fetch_assoc())
            {
                 ?>
           
                 <form action="#" method="POST" enctype="multipart/form-data">
                    <div class="container  mt-1">
                        <div class="card p-5 border-0 align-items-center m-0">
                            <div class=" card-body border rounded w-50 p-3">
                                <h1 class="text-center mb-4"></h1>
                                <input type="hidden" name="id" value="<?php echo $queryResult['id']; ?>">
                                    <div class="mb-2">
                                        <div>
                                            <label>First Name</label>
                                        </div>
                                    <input type="text" class="form-control" name="firstName" value="<?php echo $queryResult['firstName']; ?>" required>
                                </div>

                                <div class="mb-2">
                                    <div>
                                        <label>Last Name</label>
                                    </div>
                                    <input type="text" class="form-control" name="lastName" value="<?php echo $queryResult['lastName']; ?>" required>
                                </div>
                                
                                <div class="mb-2">
                                    <div>
                                        <label>Birth Date</label>
                                    </div>
                                    <input type="date" class="form-control" name="birthDate" value="<?php echo date('Y-m-d',strtotime($queryResult['birthDate'])); ?>" placeholder="YYYY-MM-DD" required>
                                </div>

                                <div class="mb-2">
                                    <div>
                                        <label>Address</label>
                                    </div>
                                    <textarea name="address" id="" cols="30" rows="2" class="form-control" required><?php echo $queryResult['address']; ?></textarea>
                                </div>

                                <div class="mb-2">
                                    <div>
                                        <label>Department</label>
                                    </div>
                                    <select name="departmentName" id="" class=" form-control">
                                        <option value=""></option>
                                        <option value="1">Accounting</option>
                                        <option value="2">Engineering</option>
                                        <option value="3">HR</option>
                                        <option value="4">IT</option>
                                        <option value="5">Purchasing</option>
                                        <option value="6">Production</option>
                                        <option value="7">IMPEX</option>
                                        <option value="8">PPIC</option>
                                        <option value="9">Sales</option>
                                        <option value="10">RPD</option>
                                        <option value="11">Logistics</option>
                                        <option value="12">FVI</option>
                                        <option value="13">QC</option>
                                        <option value="14">Utility</option>
                                        <option value="15">Security</option>
                                        <option value="16">QA</option>
                                        <option value="17">Top Management</option>
                                        <option value="18">DCC</option>
                                    </select>
                                    <!-- <textarea name="address" id="" cols="30" rows="2" class="form-control" required><?php echo $queryResult['address']; ?></textarea> -->
                                </div>

                                <div class="mt-2 p-1">
                                    <span>Gender</span>
                                    <div class="px-2">
                                        <input type="radio" name="gender" value="0" <?php echo $queryResult['gender'] == 0 ? 'checked':' '; ?>  id="male" required>
                                        <label for="male">Male</label>
                                    </div>
                                    
                                    <div class="px-2">
                                        <input type="radio" name="gender" value="1" <?php echo $queryResult['gender'] == 0 ? '':'checked'; ?> id="female" required>
                                        <label for="female">Female</label>
                                    </div>
                                    
                                </div>

                                <div class="mt-3">
                                    <!-- <input type="submit" name="submitBtn" value="Update" class="btn btn-success w-100 mt-3 mb-4"> -->
                                    <button type="submit" name="submitBtn" class="btn btn-dark w-100 mt-3 mb-4">Update</button>
                                </div>
                            </div>
            
                        </div>
                        
                    </div>
                    
                </form>
            <?php
            }
           
        }

       


    ?>

   

    
    
</body>
</html>