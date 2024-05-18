<?php

require_once "config.php";
$output = "";
$id ="";
$sql = "SELECT * FROM blog ORDER BY id DESC ";
$query = mysqli_query($conn, $sql);
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        if ($row['img']) {
            $output .= '<a href="blog.php?id='. $id=$row["id"] .'">
                            <div class="sub">
                                
                                <img src="php\images\\' . $row['img'] . '">
                                <h1>' . $row['title'] . '</h1>
                                <p> ' . substr($row['text'], 0, 200) . '...</p>                    
                            </div>
                        </a>';
        } else {
            
            $output .= '<a href="blog.php?id='. $id=$row["id"] .'"><div class="sub">
                                    <h1>' . $row['title'] . '</h1>
                                    <p> ' . substr($row['text'], 0, 200) . '...</p>
                                </div></a>';
        }
    }
} 
// else {
//     $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
// }
// $output .= '<button id="seemore" style="display:none"> See more</button>';

echo $output;