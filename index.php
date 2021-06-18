<?php
$title = "MyTweet";
$fname = "tweet.txt";
if(isset($_POST['tweet'])){
    file_put_contents($fname, $_POST['tweet']."\n", FILE_APPEND);
}
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta http-equiv="Content-Type" content="text/html; character=UTF-8">
        <title><?php echo $title; ?></title>
    </head>
    <body>
        <h1><?php echo $title; ?></h1>
        <form action="index.php" method="post">
            <div>
                <label>
                    <textarea name="tweet" placeholder="いまどうしてる？"></textarea>
                </label>
            </div>
            <input type="submit"/>
        </form>
        <div>
            <?php
            if (file_exists($fname)){
                $tweets = file_get_contents($fname);
                $tweets  =explode("\n", $tweets);
                for($i = 0; $i < count($tweets); $i++){
                    echo "<div>".$tweets[$i]."</div>";
                }
            }
            ?>
        </div>
    </body>
</html>


