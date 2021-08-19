<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    a{
        margin: 5px;
        padding: 10px;
    }
</style>

<body>

    <?php
        $conn = mysqli_connect("localhost","root","","pagination") or die("can't connect");

        $limit = 5;

        if(isset($_GET['page']))
        {
            $page = $_GET['page'];
        }
        else
        {
            $page = 1;
        }

        $offset = ($page - 1) * $limit;

        $sql = "SELECT * FROM `post` LIMIT $offset, $limit";

        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result))
        {
            echo "<h2>". $row['name'] ."</h2>";
        }
        
        $sql1 = "SELECT COUNT(*) FROM `post`";

        $result1 = mysqli_query($conn, $sql1);

        $total_rows = mysqli_fetch_array($result1)[0];

        $total_page = ceil($total_rows/$limit);

    ?>


<ul>
    <a href="?page=1">First</a>

    <a href="<?php if($page<=1) {echo '#';} else {echo "?page=".$page-1;}  ?>"><<</a>

    <?php

        for($i = 1; $i<=$total_page; $i++)
        {
            echo "<a href='?page=$i'>". $i ."</a>";
        }

    ?>

    <a href="<?php if($page==$total_page) {echo '#';} else {echo "?page=".$page+1;}  ?>">>></a>


    <a href="?page=<?php  echo $total_page; ?>">Last</a>
</ul>

<form action="pagination.php" method="GET">
            <select name="page" onchange="this.form.submit()">
                <?php 
                    echo "<option value='$page'>Active:".$page."</option>";
                    for($i = 1; $i <= $total_page; $i++){
                        echo "<option value='$i'>".$i."</option>";
                    }
                ?>
            </select>
        </form>



    
</body>
</html>