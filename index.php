<?php include 'connection.php'; ?>

<?php
        if(isset($_GET['id']))
        {
        $id = $_GET['id'];
        $deleteQuery = "DELETE FROM tbl_khenneth WHERE id='$id'";
        $deleteQueryRun = mysqli_query($con, $deleteQuery);

        if($deleteQueryRun)
        {
            echo "Deleted successfully";
            header("Location: index.php");
        }else
        {
            echo "Failed to delete";
            header("Location: index.php");
        }
        }

        else if(ISSET($_POST['search']))
        {
            $fname_keyword = $_POST['fname_keyword'];
            $lname_keyword = $_POST['lname_keyword'];
            $address_keyword = $_POST['address_keyword'];
            $bdate_keyword = $_POST['bdate_keyword'];
            $gender_keyword = $_POST['gender_keyword'];
            $hr_keyword = $_POST['hr_keyword'];
            
            $query = "SELECT * FROM tbl_khenneth WHERE firstName LIKE '%$fname_keyword%' and lastName LIKE '%$lname_keyword%' and addressData LIKE '%$address_keyword%' and birthDate LIKE '%$bdate_keyword%' and gender LIKE '%$gender_keyword%' ";
            $queryRes = $con->query($query);

            $query = "SELECT * FROM `tbl_khenneth` INNER JOIN `hr_department` ON tbl_khenneth.id=hr_department.departmentId WHERE departmentName LIKE '%$hr_keyword%'";
            $queryRes = $con->query($query);
            
        }
        else{
            $query = "SELECT * FROM tbl_khenneth WHERE firstName LIKE '%$fname_keyword%' and lastName LIKE '%$lname_keyword%' and addressData LIKE '%$address_keyword%' and birthDate LIKE '%$bdate_keyword%' and gender LIKE '%$gender_keyword%' ";
            $queryRes = $con->query($query);

            $query = "SELECT * FROM `tbl_khenneth` INNER JOIN `hr_department` ON tbl_khenneth.id=hr_department.departmentId WHERE departmentName LIKE '%$hr_keyword%'";
            $queryRes = $con->query($query);
        }

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Exercise 7 Graph</title>
</head>

<body>

    <div class="container">
        <!-- <h1>
        <?php echo $_POST['fname_keyword']; ?> 
            <?php echo $_POST['lname_keyword']; ?>
            <?php echo $_POST['address_keyword']; ?>
            <?php echo $_POST['bdate_keyword']; ?>
            <?php echo $_POST['gender_keyword']; ?>
        </h1> -->

                    <form action="#" method="POST" class="">
                        <div class="mt-2 mb-2 ">
                            <div class="card-body shadow rounded my-3 p-3 w-80">
                    
                                        <select name="fname_keyword" id="" class="px-3 py-1 rounded" style="width: 140px;">
                                            <option value=""><?php echo isset($_POST['fname_keyword']) ? $_POST['fname_keyword'] : '' ?></option>
                                        <?php
                                            if($res= $queryRes->num_rows > 0)
                                            {
                                                foreach($queryRes as $row)
                                                {
                                                    ?>
                                                        <option value="<?php echo $row["firstName"]; ?>"><?php echo $row["firstName"]; ?></option>
                                                    <?php
                                                }
                                            }
                                        ?>
                                        </select>
                                        
                                        <select name="lname_keyword" id="" class="px-3 py-1 rounded" style="width: 140px;">
                                            <option value=""><?php echo isset($_POST['lname_keyword']) ? $_POST['lname_keyword'] : '' ?></option>
                                            <?php
                                            if($res= $queryRes->num_rows > 0)
                                            {
                                                foreach($queryRes as $row)
                                                {
                                                    ?>
                                                        <option value="<?php echo $row["lastName"]; ?>"><?php echo $row["lastName"]; ?></option>
                                                    <?php
                                                }
                                            }
                                        ?>
                                        </select>
                                        <select name="address_keyword" id="" class="px-3 py-1 rounded" style="width: 140px;">
                                            <option value=""><?php echo isset($_POST['address_keyword']) ? $_POST['address_keyword'] : '' ?></option>
                                            <?php
                                            if($res= $queryRes->num_rows > 0)
                                            {
                                                foreach($queryRes as $row)
                                                {
                                                    ?>
                                                        <option value="<?php echo $row["addressData"]; ?>"><?php echo $row["addressData"]; ?></option>
                                                    <?php
                                                }
                                            }
                                        ?>
                                        </select>
                                        <select name="bdate_keyword" id="" class="px-3 py-1 rounded" style="width: 140px;">
                                            <option value=""><?php echo isset($_POST['bdate_keyword']) ? $_POST['bdate_keyword'] : '' ?></option>
                                            <?php
                                            if($res= $queryRes->num_rows > 0)
                                            {
                                                foreach($queryRes as $row)
                                                {
                                                    ?>
                                                        <option value="<?php echo $row["birthDate"]; ?>"><?php echo $row["birthDate"]; ?></option>
                                                    <?php
                                                }
                                            }
                                        ?>
                                        </select>
                                        
                                        <select class="p-1 px-3 rounded" name="gender_keyword" style="width: 140px;">
                                            <option value="" disabled selected hidden>
                                                <?php 
                                                    if(isset($_POST['gender']))
                                                    {
                                                        echo $_POST['gender'] ? 'Male' : 'Female';
                                                    }
                                                    else
                                                    {
                                                        echo "Gender";
                                                    }
                                                ?>
                                            </option>

                                            <option value="0">Male</option>
                                            <option value="1">Female</option>
                                        </select>

                                        <select name="hr_keyword" id="" class="p-1 rounded" style="width: 140px;">
                                            <option value=""></option>
                                            <?php
                                                if($res= $queryRes->num_rows > 0)
                                                {
                                                    foreach($queryRes as $row)
                                                    {
                                                        ?>
                                                            <option value="<?php echo $row["departmentName"]; ?>"><?php echo $row["departmentName"]; ?></option>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                            
                                        </select>
                                   

                                <button type="submit" name="search" class="btn btn-dark px-3"><i class="fa fa-search"></i> Search</button>

                                <!-- fname_keyword func -->
                                    <!-- <input type="text" name="fname_keyword" value="<?php echo isset($_POST['fname_keyword']) ? $_POST['fname_keyword'] : '' ?>" class="rounded " placeholder="First Name"> -->
                                    
                                    <!-- lname_keyword func -->
                                    <!-- <input type="text" name="lname_keyword" value="<?php echo isset($_POST['lname_keyword']) ? $_POST['lname_keyword'] : '' ?>" class="rounded " placeholder="Last Name"> -->
                                    
                                    <!-- address_keyword func -->
                                    <!-- <input type="text" name="address_keyword" value="<?php echo isset($_POST['address_keyword']) ? $_POST['address_keyword'] : '' ?>" class="rounded " placeholder="Address"> -->
                                    
                                    <!-- bdate_keyword func -->
                                    <!-- <input type="text" name="bdate_keyword" value="<?php echo isset ($_POST['bdate_keyword']) ? $_POST['bdate_keyword'] : '' ?>" class="rounded " placeholder="Birth Date"> -->
                                
                                    <!-- gender_keyword func -->
                                <!-- <label class="">Gender</label> -->

                            <!-- <input type="text" name="gender_keyword" value="<?php echo isset($_POST['gender_keyword']) ? $_POST['gender_keyword'] : '' ?>" class="rounded" placeholder="Gender"> -->
                        </div>
                    </div>
                </form>
                <a href="khenneth_add.php" class="btn btn-dark mb-2 shadow" style="float: right;"><i class="fa fa-plus px-2"></i> Add New</a>
    
        
        <?php
            $query = "SELECT * FROM tbl_khenneth INNER JOIN `hr_department` ON tbl_khenneth.departmentId=hr_department.departmentId WHERE departmentName LIKE '%$hr_keyword%' and firstName LIKE '%$fname_keyword%' and lastName LIKE '%$lname_keyword%' and addressData LIKE '%$address_keyword%' and birthDate LIKE '%$bdate_keyword%' and gender LIKE '%$gender_keyword%' ORDER BY departmentName ASC";
            $queryRes = $con->query($query);

            // $query = "SELECT * FROM `tbl_khenneth` INNER JOIN `hr_department` ON tbl_khenneth.id=hr_department.departmentId WHERE departmentName LIKE '%$hr_keyword%'";
            // $queryRes = $con->query($query);
        
                if($res= $queryRes->num_rows > 0)
                {
                    ?>
                        <table class="table table-hover table-striped table-bordered text-center mb-5">
                            <thead class="bg-dark text-white">
                                <tr>
                                <th scope="col">ID</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Address</th>
                                <th scope="col">Birth Date</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Department</th>
                                <!-- <th scope="col">Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                    <?php

                    $i = 0;
                    while($row = $queryRes->fetch_assoc())
                    {
                        ?>
                            <tr>
                                <th scope="row"><?php echo ++$i; ?></th>
                                <td><?php echo $row["firstName"];?></td>
                                <td><?php echo $row["lastName"];?></td>
                                <td><?php echo $row["addressData"];?></td>
                                <td><?php echo $row["birthDate"];?></td>
                                <td><?php echo $row["gender"] == 0 ? "Male" : "Female";  ?></td>
                                <td value="<?= $row['departmentId'];?>"><?= $row['departmentName'];?>
                                <!-- <td> -->
                                         <!-- <a href="khenneth_update.php?id=<?php echo $row["id"];?>" class="btn btn-muted"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        <a href="index.php?id=<?php echo $row["id"];?>" class="btn btn-mute"><i class="fa fa-trash" aria-hidden="true"></i></a> -->
                                        <!-- <button type="submit" name="deleteBtn" value="<?php echo $row["id"];?>" class="btn btn-danger">Delete</button> -->
                                <!-- </td> -->
                            </tr>
                        <?php 
                    }
                }   
                else
                {            
                    echo '<span class="col-6 text-center">No data found.</span>';
                }

                    ?>
                        </tbody>
                        </table> 
                    <?php
        ?>
    </div>
      <?php
        //     }
         ?>  
</body>

</html>