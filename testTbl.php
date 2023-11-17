<?php
 include "connection.php";
    
     $query = "SELECT departmentName, COUNT(departmentName) AS count FROM hr_department INNER JOIN tbl_khenneth ON hr_department.departmentId=tbl_khenneth.id GROUP BY departmentName";
     $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) > 0)
    {
      ?>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">DeptName Count</th>
              <th scope="col">Department Name</th>
            </tr>
          </thead>
          <tbody>
        <?php
        $i = 0;
       
        while($row = $result->fetch_assoc())    
        {
          ?>
          <tr>
              <th scope="row"><?php echo count($row['departmentName']); ?></th>
             
              <td><?php echo $row["departmentName"];?></td>
            </tr>
          <?php
        }
            
            ?>
            </tbody>
        </table>
            <?php
          
      
    }
      
?>