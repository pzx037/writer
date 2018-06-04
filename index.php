
<?php
session_start();

include('C:/wamp64/www/writer/controller/frontend.php');
include('C:/wamp64/www/writer/controller/backend.php');


try
{
    if (isset($_GET['action']))
    {
        if ($_GET['action'] == 'listChapters')
        {
            listChapters();
        }

    elseif($_GET['action'] == 'landing')
    {
        require('C:/wamp64/www/writer/view/frontend/landingPageView.php');
    }
       elseif($_GET['action'] == 'signIn')
        {
            if(!empty($_POST['loginName']) || !empty($_POST['loginPassword']))
            {
                $result = memberSignIn();
                $isPasswordCorrect = password_verify($_POST['loginPassword'], $result['password']);

                if ($isPasswordCorrect && $_POST['loginName'] == 'Administrator')
                {
                    $_SESSION['id'] = $result['id'];
                    $_SESSION['name'] = $_POST['loginName'];
                    header('Location: index.php?action=admin');
                }
                    elseif($isPasswordCorrect)
                    {
                        $_SESSION['id'] = $result['id'];
                        $_SESSION['name'] = $_POST['loginName'];
                        header('Location: index.php?action=listChapters');
                    }
                    else
                    {
                        throw new Exception("Your login details aren't correct");
                    }
                }
            else
            {
                throw new Exception('Error : You must fill in the form');
            }
        }
        elseif($_GET['action'] == 'signOut')
        {
            session_destroy();
            header('Location: index.php');
        }

        elseif($_GET['action'] == 'register')
        {
            require('C:/wamp64/www/writer/view/frontend/inscriptionView.php');
        }


        elseif($_GET['action'] == 'inscription')
        {
                if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['pass']) && !empty($_POST['pass2']))
                {
                    $username = htmlspecialchars($_POST['username']);
                    $email = htmlspecialchars($_POST['email']);
                    $pass = htmlspecialchars($_POST['pass']);
                    $pass2 = htmlspecialchars($_POST['pass2']);

                    $nameLength = strlen($username);

                    $user_name = checkName();

                    if(empty($user_name['name']))
                    {
                        if($nameLength <= 255)
                        {
                            if(filter_var($email, FILTER_VALIDATE_EMAIL))
                            {
                                $user_email = checkEmail();

                                if(empty($user_email['email']))
                                {
                                    if($pass === $pass2)
                                    {
                                        $passLength = strlen($pass);
                                        if ($passLength >= 6)
                                        {
                                            $pass_hash = password_hash($_POST['pass'], PASSWORD_BCRYPT);

                                            addMember($pass_hash);
                                            header('Location: index.php?action=signIn');
                                        }
                                        else
                                        {
                                            throw new Exception('Error : Your password must be more than 6 characters');


                                        }
                                    }
                                    else
                                    {
                                        throw new Exception('Error : The passwords aren\'t the same, please try again');
                                    }
                                }
                                else
                                {
                                    throw new Exception('Error : The username or email you have chosen allready exists');

                                }
                            }
                            else
                            {
                                throw new Exception("Error : Your e-mail isn\'t valid, please try again");
                            }
                        }
                        else
                        {
                            throw new Exception('Error : The username you have chosen is too long');
                        }
                    }
                    else
                    {
                        throw new Exception("Error : The username or email you have chosen allready exists");
                    }
                }
                else
                {
                    throw new Exception('Error : You must fill in the form');
                }
        }

        // Gets a chapter with its comments
        elseif ($_GET['action'] == 'loadChapter') 
        {
            if(isset($_SESSION['name']))
            { 
                if (isset($_GET['chapterId']) && $_GET['chapterId'] > 0)
                {

                    loadChapter();
                }
                else
                {
                    throw new Exception('Error : No Id sent');
                }
            }
            else
            {
                throw new Exception('Error : You must be connected to read the rest');
                
            }
        }

        elseif($_GET['action'] == 'addComment')
        {
            if(isset($_SESSION['name']))
            {
                if (isset($_GET['chapterId']) && $_GET['chapterId'] > 0)
                {
                    if (!empty($_POST['chapterComment']))
                    {
                      
                        addComment($_GET['chapterId'], $_POST['chapterComment']);
                        
                    }
                    else
                    {
                        throw new Exception('Error : Your must write a comment for it to be added !');
                    }
                }
                else
                {
                    throw new Exception('Error : No Id sent');
                }
            }
            else
            {
                throw new Exception("Error : You must be connected to add a comment");
            }
        }

 
        // Gets adminComments, Members and dropdown for adminView
        elseif($_GET['action'] == 'admin')
        {
            if(isset($_SESSION['id']) == 'Administrator')
            {
                admin();
            }
            else
            {
                throw new Exception('Error : You must be the administrator to access this page');
            }
        }

        elseif($_GET['action'] == 'load')
        {
            load();
        }

        // Gets the chosen chapter, members and adminComments
       

        /* Confirm a member */
        elseif($_GET['action'] == 'confirm')
        {
            if(isset($_GET['confirm']) && !empty($_GET['confirm']))
            {
                $confirm = (int)$_GET['confirm'];
                confirm($confirm);?>

                <div id="setTime" ><?php
                echo "<p> The member was successfully confirmed</p>";
                ?></div><?php

                admin();

            }
            else
            {
                throw new Exception('Error : The member hasn\'t been confirmed');
            }
        }

        /* Delete a member */
        elseif($_GET['action'] == 'delete')
        {
            if(isset($_GET['delete']) && !empty($_GET['delete']))
            {
                $delete = (int)$_GET['delete'];
                delete($delete);?>

                <div id="setTime"><?php
                echo "<p> The member was successfully deleted</p>";
                ?></div><?php

                admin();

            }
            else
            {
                throw new Exception('Error : The member hasn\'t been deleted');
            }
        }

        /* Confirm a comment */
        elseif($_GET['action'] == 'confirmComment')
        {
            if(isset($_GET['confirm']))
            {

                $confirmComment = (int)$_GET['confirm'];
                confirmComment($confirmComment);?>

                <div id="setTime"><?php
                echo "<p> The comment was successfully confirmed</p>";
                ?></div><?php

                admin();

            }
            else
            {
                throw new Exception('Error : The comment has not been confirmed');
            }
        }

        /* Delete a comment */
        elseif($_GET['action'] == 'deleteComment')
        {
            if(isset($_GET['delete']))
            {
                $deleteComment = (int)$_GET['delete'];
                deleteComment($deleteComment);?>

                <div id="setTime"><?php
                echo "<p> The comment was successfully deleted</p>";
                ?></div><?php

                admin();
            }
            else
            {
                throw new Exception('Error : The comment has not been deleted');
            }
        }

        /* Save/Update/Delete tinyMCE */

        elseif($_GET['action'] == 'tinyMCE')
        {

            if(isset($_POST['tinySave']))
            {
                if(!empty($_POST['tinyTitle']) && !empty($_POST['tinyTextarea']))
                {
                    saveTinymce();?>

                    <div id="setTime"><?php
                    echo "<p> Your chapter was successfully saved</p>";
                    ?></div><?php

                    admin();
                }
                else
                {
                    throw new Exception('Error : You must write a chapter to save it');
                }
            }


            elseif(isset($_POST['tinyUpdate']))
            {
                if(!empty($_POST['tinyTitle']) && !empty($_POST['tinyTextarea']))
                {
                    updateTinymce();?>

                    <div id="setTime"><?php
                    echo "<p> Your chapter was successfully updated</p>";
                    ?></div><?php

                    admin();

                }
                else
                {
                    throw new Exception('Error : You must load a chapter to be updated');
                }
            }
            elseif(isset($_POST['tinyDelete']))
            {
                if(!empty($_POST['tinyTitle']) && !empty($_POST['tinyTextarea']))
                {
                    deleteTinymce();?>

                    <div id="setTime"><?php
                    echo "<p> Your chapter was successfully deleted</p>";
                    ?></div><?php

                    admin();
                }
                else
                {
                    throw new Exception('Error : You must load a chapter to be deleted');
                }
            }
        }

        elseif($_GET['action'] == 'contact')
        {
            require'view/frontend/contactView.php';
        }

    }
    // Returns to the landing page
    else
    {
        landingPage();
    }
}


catch(Exception $e)
{
    $errorMessage = $e->getMessage();
    require('C:/wamp64/www/writer/view/frontend/errorView.php');
}