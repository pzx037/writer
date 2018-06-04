
<?php

include_once('C:/wamp64/www/writer/model/ChapterManager.php');
include_once('C:/wamp64/www/writer/model/CommentManager.php');


        function listChapters()
        {
            $ChapterManager = new ChapterManager();
            $CommentManager = new CommentManager();

            $chapters = $ChapterManager->getchapters();
            include('C:/wamp64/www/writer/view/frontend/listChaptersView.php');
        }

        function loadChapter()
        {
            $ChapterManager = new ChapterManager();
            $CommentManager = new CommentManager();
            
            $chapter = $ChapterManager->getChapter($_GET['chapterId']);
            $chapterComments = $CommentManager->getComments($_GET['chapterId']);

            include('C:/wamp64/www/writer/view/frontend/readView.php');
        }

        //Add a comment
        function addComment($chapterId, $chapterComment)
        {
            $CommentManager = new CommentManager();
            $addComment = $CommentManager->addComment($chapterId, $chapterComment);
            header('Location: index.php?action=loadChapter&chapterId=' . $chapterId);
        }
    
        function landingPage()
        {
            include('C:/wamp64/www/writer/view/frontend/landingPageView.php');
        }





       
