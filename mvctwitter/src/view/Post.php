<?php

ob_start();
session_start();

require '../../vendor/autoload.php';

use App\Classes\Database;
use App\Classes\Login;
use App\Model\Post;

$TimeLine = false;
// $DisplayProfile = false;

if (Login::isConnected()) {
    header('Location: ../view/register/index.login.php');
} else {
    $TimeLine = true;
}

try {
    if (isset($_POST['post']))
    {
    try 
    {
        $posts = Post::createPost(Login::getUserId(), $_POST['content']);

    } catch (\PDOException $exception) {
    echo "Error PostView : " . $exception->getMessage();
    }
        // foreach($posts as $post)
        // {
        //     echo "<p>$post->content</p> <span>~$post->userid by $post->username at $post->$time</span>";
        // }
    }
} catch (\PDOException $exception) {
    echo "Error PostController : " . $exception->getMessage();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="post.php" method="post">
        <textarea name="content" id="content" cols="30" rows="10"></textarea>
        <input type="submit" name="post" value="Post">
    </form>

    
</body>
</html>

<?php
// ob_clean();
?>