<?php
date_default_timezone_set('Asia/Tokyo');
$title = "MyTweet";
$xmlfile = "tweets.xml";
if (isset($_POST['tweet'])) {
    $now = date("Y-m-d H:i:s");
    $tweets = simplexml_load_file($xmlfile);
    $newid = $tweets->count() + 1;
    $entry = $tweets->addChild("entry");
    $entry->addAttribute("id", $newid);
    $entry->addChild("date", $now);
    $entry->addChild("text", $_POST['tweet']);
    file_put_contents($xmlfile, $tweets->asXML());
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
    if (file_exists($xmlfile)) {
        $tweets = simplexml_load_file($xmlfile);
        foreach ($tweets as $entry) {
            echo "<div class='entry'>";
            echo "<div class='date'><p>$entry->date</p></div>";
            echo "<div class='text'><h3>$entry->text</h3></div>";
            echo "</div>\n";
        }
    }
    ?>
</div>
</body>
</html>


