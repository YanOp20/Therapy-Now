<?php

require_once "config.php";
$output = "";
$id ="";
$idd = '0';
if(isset($_GET['id'])){
    $idd = $_GET['id'];
}else{
    $idd = '0';
}
$sql = "SELECT * FROM blog  WHERE id != $idd ";
$query = mysqli_query($conn, $sql);
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $title = $row['title'];

            if ($row['img']) {
                
                $output .='<a href="blog.php?id='. $id=$row["id"] .'">
                <div>
                <img src="php\images\\' . $row['img'] . '">
                <h1>' . $row['title'] . '</h1>
                <p> ' . substr($row['text'], 0, 150 - strlen($title)) . '...</p>  
                </div>
                </a>';            
                
            } else {
                $output .='<a href="blog.php?id='. $id=$row["id"] .'">
                <div>
                <h1>' . $row['title'] . '</h1>
                <p> ' . substr($row['text'], 0, 150 - strlen($title)) . '...</p>  
                </div>
                </a>';  
            }
        }
    
    } 
    // else {
    //     $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
    // }
    echo $output;
