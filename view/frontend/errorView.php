<?php $title = 'Error'; ?>


<?php ob_start() ?>

<section id="topSection">

    <h1>Error Page</h1>

</section>

<section id="errorPage">

        <div class="messageError">
                <?php
                if(isset($errorMessage))
                {
                    echo $errorMessage . '<br />';

                    if($_GET['action'] == 'inscription')
                    {
                        ?><a href="index.php?action=register"> Try again</a><?php
                    }
                        elseif($_GET['action'] == 'tinyMCE')
                        {
                            ?><a href="index.php?action=admin"> Try again</a><?php
                        }
                            elseif($_GET['action'] == 'addComment')
                            {
                                ?><a href="index.php?action=listChapters"> Try again</a><?php
                            }
                                elseif($_GET['action'] == 'logIn')
                                {
                                    ?><a href="index.php?action=signIn"> Try again</a><?php
                                }
                                    elseif($_GET['action'] == 'confirm' || $_GET['action'] == 'delete' || $_GET['action'] == 'confirmComment' || $_GET['action'] == 'deleteComment')
                                    {
                                        ?><a href="index.php?action=admin">Admin page </a> <?php
                                    }
                }
          ?>

         </div>

<?php $content = ob_get_clean() ?>

</section>

<?php include('C:/wamp64/www/writer/include/template.php'); ?>
