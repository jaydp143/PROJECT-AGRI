<?php 
    require('./database.php');
    $select_query1 = mysqli_query($connection,"SELECT * from tbl_municipality ");
    while($row = mysqli_fetch_array($select_query1)){ 
    echo "<option>".$row['municipality']."</option> ";
    }
?>