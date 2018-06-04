<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 16/05/2018
 * Time: 08:00
 */

include_once('C:/wamp64/www/writer/model/ChapterManager.php');
include_once('C:/wamp64/www/writer/model/CommentManager.php');
include_once('C:/wamp64/www/writer/model/InscriptionManager.php');
include_once('C:/wamp64/www/writer/model/AdminManager.php');

    function admin()
    {
        $ChapterManager = new ChapterManager;
        $AdminManager = new AdminManager;
        $CommentManager = new CommentManager;

        $dropList = $ChapterManager->dropDown();
        $members = $AdminManager->getMembers();
        $adminComments = $AdminManager->getAdminComments();

        include('C:/wamp64/www/writer/view/backend/adminView.php'); 
    }

    function load()
    {
        $ChapterManager = new ChapterManager;
        $AdminManager = new AdminManager;
        

        $dropList = $ChapterManager->dropDown();
        $members = $AdminManager->getMembers();
        $adminComments = $AdminManager->getAdminComments();
        $chapterShow = $ChapterManager->showChapter($_POST['chapterTitle']);


        include('C:/wamp64/www/writer/view/backend/adminView.php'); 
    }

    function checkName()
    {
        $InscriptionManager = new InscriptionManager();

        $user_name = $InscriptionManager->nameCheck();


        return $user_name;
    }

    function checkEmail()
    {
        $InscriptionManager = new InscriptionManager();

        $user_email = $InscriptionManager->emailCheck();


        return $user_email;
    }
    /*
    function str_random($length)
    {
        $alphabet = '0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN';

        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, 60);
    }
    */
    function memberSignIn()
    {
        $InscriptionManager = new InscriptionManager();

        $result = $InscriptionManager->signIn();

        return $result;

    }

    function addMember($pass_hash)
    {
        $InscriptionManager = new InscriptionManager();

        $affectedLines = $InscriptionManager->inscription($pass_hash);

        if($affectedLines === false)
        {
            throw new Exception('You have not been registered');
        }
    }

    //Confirm a member
    function confirm($confirm)
    {
        $AdminManager = new AdminManager();

        $confirmation = $AdminManager->confirmMember($confirm);

    }

    //Delete a member
    function delete($delete)
    {
        $AdminManager = new AdminManager();

        $confirmation = $AdminManager->deleteMember($delete);

    }

    //Confirm a comment
    function confirmComment($confirmComment)
    {
        $CommentManager = new CommentManager();

        $confirmation = $CommentManager->confirmComment($confirmComment);

    }

    //Delete a comment
    function deleteComment($deleteComment)
    {
        $CommentManager = new CommentManager();

        $confirmation = $CommentManager->deleteComment($deleteComment);

    }

    function saveTinymce()
    {
        $ChapterManager = new ChapterManager();

        $save = $ChapterManager->saveChapter();

    }


    function updateTinymce()
    {
        $ChapterManager = new ChapterManager();

        $updateChapter = $ChapterManager->updateChapter($_GET['chapterId']);

    }

    function deleteTinymce()
    {
        $ChapterManager = new ChapterManager();

        $delete = $ChapterManager->deleteChapter($_GET['chapterId']);

    }

