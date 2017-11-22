<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>  
<?php 
    if($_SERVER["REQUEST_METHOD"] == "POST") {
    $videoId = filter_input(INPUT_POST, "videoId");
    $content = file_get_contents("http://youtube.com/get_video_info?video_id=".$videoId);
    parse_str($content, $ytarr);
    echo $ytarr['video_id'];    
    }
    ?>
<iframe width="560" height="315" src="https://www.youtube.com/embed/<?= $videoId ?>" frameborder="0" allowfullscreen></iframe>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
<input type="text" name="videoId">
<input type="submit">
</form>
   
   
</body>
</html>