<?php

namespace App\Model;

use App\Classes\Database;
use App\Classes\Login;

class Post 
{    
    /**
     * createPost
     *
     * @param  mixed $userid
     * @param  mixed $content
     * @return void
     */
    public static function createPost($userid, $content)
    {
        try {
            if (Login::Check() === true)
            {
                if (isset($_POST['post']))
                {
                    $userid = Login::getUserId();
                    $content = $_POST['content'];

                try 
                {
                    if (strlen($content) >= 5 && strlen($content) <= 140)
                    {
                        Database::query('INSERT INTO tweet (content, date, user_id)
                         VALUES (:content, NOW(), :user_id)', 
                        [
                            ':content'=>$content,
                            ':user_id'=>$userid,
                        ]);
                        return true;
                    } else {
                        echo "Content must be between 5 and 160 characters";
                    }
                } catch (\PDOException $exception) {
                    echo "Error Insert Post DATA: " . $exception->getMessage();
                    }
                } else {
                    echo "Post Not Created";
                }
            } else {
                echo "You must be logged in to create a post";
            }
        } catch (\PDOException $exception) {
            echo "Error createPost: " . $exception->getMessage();
        }
    } 
    
    /**
     * getPost
     *
     * @param  mixed $posts
     * @param  mixed $userid
     * @return $posts
     */
    public function getPost($posts, $userid)
    {
        try {
            if (Login::Check() === true)
            {
                $userid = Login::getUserId();
                $posts = Database::query('SELECT content FROM tweet WHERE user_id=:user_id', array(':user_id'=>$userid));
                return $posts;
            } else {
                echo "You must be logged in to see your posts";
            }
        } catch (\PDOException $exception) {
            echo "Error getPost: " . $exception->getMessage();
        }
    }
    
    /**
     * getFollowersPost
     *
     * @param  mixed $posts
     * @param  mixed $userid
     * @param  mixed $follower
     * @return void
     */
    public function getFollowersPost($posts, $userid, $follower)
    {
        try {
            if (Login::Check() === true)
            {
                $userid = Login::getUserId();
                $follower = Database::query('SELECT follower_id FROM followers WHERE user_id=:user_id', array(':user_id'=>$userid));
                $posts = Database::query('SELECT * FROM tweet WHERE user_id=:user_id', array(':user_id'=>$follower));
                return $posts;
            } else {
                echo "You must be logged in to see your posts";
            }
        } catch (\PDOException $exception) {
            echo "Error getFollowersPost: " . $exception->getMessage();
        }
    }

}
