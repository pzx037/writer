
<?php

include_once('C:/wamp64/www/writer/model/ChapterManager.php');
include_once('C:/wamp64/www/writer/model/CommentManager.php');
include_once('C:/wamp64/www/writer/model/InscriptionManager.php');
include_once('C:/wamp64/www/writer/model/AdminManager.php');




        function listChapters()
        {
            $ChapterManager = new ChapterManager();

            $dropList = $ChapterManager->dropDown();

            include('C:/wamp64/www/writer/view/frontend/listChaptersView.php');
        }

        function loadChapter()
        {
            $ChapterManager = new ChapterManager();
            $CommentManager = new CommentManager();

            $dropList = $ChapterManager->dropDown();
            $chapterShow = $ChapterManager->showChapter($_POST['chapterTitle']);
            

            include('C:/wamp64/www/writer/view/frontend/listChaptersView.php');
        }

        //Add a comment
        function addComment()
        {
            $CommentManager = new CommentManager();

            $addPost = $CommentManager->postComment();

            include('C:/wamp64/www/writer/view/frontend/listChaptersView.php');   
            
        }

    






       
