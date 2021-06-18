<?php
$title = "MyTweet";
$tweet = $_POST['tweet'];
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
                <textarea name="tweet" placeholder="いまどうしてる？"></textarea>
            </div>
            <input type="submit"/>
        </form>
        <div><?php echo $tweet; ?></div>
    </body>
</html>


