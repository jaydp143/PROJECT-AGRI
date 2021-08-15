<?php 
    require('./database.php');
    $select_query1 = mysqli_query($connection,"SELECT * from tbl_seed");
    while($row = mysqli_fetch_array($select_query1)){ 
    echo "<option>".$row['seed_description']."</option> ";
    }
?>