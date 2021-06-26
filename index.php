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
    if (is_uploaded_file($_FILES['image']['tmp_name'])) {
        $tmpfile = $_FILES['image']['tmp_name'];
        $imgfile = "./img/" . $newid . "_" . $_FILES['image']['name'];
        move_uploaded_file($tmpfile, $imgfile);
        $entry->addChild("img", $imgfile);
    }
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
<form action="index.php" method="POST" enctype="multipart/form-data">
    <div>
        <textarea name="tweet" placeholder="いまどうしてる？"></textarea>
    </div>
    <div>
        <input type="file" name="image" accept="image/gif,image/jpeg,image/jpg,image/png,image/PNG"/>
    </div>
    <input type="submit"/>
</form>
    <div>
        <?php
        if (file_exists($xmlfile)) {
            $tweets = simplexml_load_file($xmlfile);
            foreach ($tweets as $entry) {
                $entries[(string)$entry['id']] = $entry;
            }

            krsort($entries);
            foreach ($entries as $entry) {
                echo "<div class='entry'>";
                echo "<div class='date'><p>$entry->date</p></div>";
                echo "<div class='text'><h3>$entry->text</h3></div>";
                if ($entry->img != "") {
                    echo "<img src='" . $entry->img . "'/>";
                }
                echo "</div>" . "\n";
            }
        }
        ?>
    </div>
</body>
</html>


