<?php
require_once ('Manager.php');
require_once ('AdminManager.php');

class CommentManager extends Manager
{
    
   function getComments($chapterId)
    {
     $db = $this->getDb();

        $chapterComments = $db->query('SELECT id, content, DATE_FORMAT(comment_date, \'%a the %D of %b  at %Hh%m\') AS comment_date FROM comments WHERE id_chapter = "' .$chapterId. '" ORDER BY id DESC LIMIT 0,6');
        
        return $chapterComments;
    }

    //add a comment 
    function addComment($chapterId, $chapterComment)
        {
       
            $db = $this->getDb();

            $req = $db->prepare('INSERT INTO comments (id_chapter, content, confirmed, comment_date) VALUES(?, ?, 0, NOW())');
            $req->execute(array($chapterId, $chapterComment));
        }


    
}