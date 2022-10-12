<?php

namespace App\Controller;

use App\Classes\Database;
use App\Classes\Login;
use App\Model\Post;
use Exception;
use PDOException;

class PostController 
{
    public function index()
    {
        session_start();
        if (Login::Check() === true)
        {
            $userid = $_SESSION['userid'];
            $content = $_POST['content'];
            
            $posts = Post::createPost($userid, $content);
            return $posts;
            // require '../views/posts.php';
        }
        try {
            
            if(Post::createPost($_SESSION['userid'], $_POST['content']))
            {

                echo "Post Created";
            }
            else
            {
                echo "Post Not Created";
            }


        } catch (\PDOException $exception) {
            echo "Error PostController : " . $exception->getMessage();
        }
    }
}