<!DOCTYPE html>
<html>
    <head>
        <title>TweetCool</title>
    </head>
    <body>
        <h2>TweetCool</h2>
        <form action="" method="POST">
            Name: <br><input type="text" name="username"><br><br>
            Comment: <br><textarea name="comment" rows="5" cols="40"></textarea><br>
            <input type="submit" name="submit" value="Go!"><br><br>
        </form>
        <h3>Tweets:</h3>
    </body>
</html>

<?php

    require_once "Tweet.php";

    $db = pg_connect("host=localhost port=5432 dbname=tweetcool user=postgres password=admin");

    $username;
    $comment;

    if(isset($_POST["submit"])){
        $ok = false;
        $new_tweet = new Tweet;
        if(isset($_POST["username"])){
            $username = $new_tweet->username = $_POST["username"];
            $ok = true;
        }
        if(isset($_POST["comment"])){
            $comment = $new_tweet->comment = $_POST["comment"];
            $ok = true;
        }

        if($ok){
            $query = "INSERT INTO tweet (username, tweet_comment) VALUES ('$_POST[username]','$_POST[comment]')";
            $result = pg_query($query);
        }

    }
    $tweets = "SELECT * FROM tweet";
    $rs = pg_query($db, $tweets);
    while ($row = pg_fetch_row($rs)) {
        echo "$row[1]: $row[2] ($row[3])</br>";
    }



?>