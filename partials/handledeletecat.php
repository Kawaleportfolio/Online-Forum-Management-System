<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $catsearch=$_POST['query'];

            $sql="sselect * from category where match (category_name, category_description) against ('$catsearch')";
            $result= mysqli_query($con,$sql);
            while($row = mysqli_fetch_assoc($result)){

            $noresults=false;

            $catid = $row['thread_title'];
            $catname = $row['thread_desc'];
            $catdesc= $row['thread_id']; 
            $url="thread.php?threadid=".$th_id;
            echo '<div class="result">
            <h5>'.$catname.'</h5>
            <p>'.substr($catdesc,0,90).'</p>
            </div>'; 
            
            }
        
        }
    ?> 