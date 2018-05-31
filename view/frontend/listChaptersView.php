
<?php $title = 'Live Book'; ?>

<?php ob_start(); ?>




<section id="topSection">

    <article id="topTitle">
        <h1><?php if(isset($_SESSION['name'])){echo 'Welcome ' . $_SESSION['name'] . '<br /> to Read my Book';}else{echo 'Welcome to Read my Book';} ?></h1>
    </article>

</section>


<section id="topLine">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 col-sm-push-1 col-xs-12 ">
                <div class="listChapters">

                  <form action="index.php?action=loadChapter" class="loadChapter" method="post">
                        <SELECT name="chapterTitle"  class='chapterTitle'>
                            <option>Choose a chapter</option>
                            <?php while($drop = $dropList->fetch())
                            {
                                $chapterId = $drop['id'];
                                $chapterTitle = $drop['title'];

                            ?>
                            <option value="<?=$chapterId;?>"><?=$chapterTitle; ?></option>
                            <?php
                            }
                            ?>
                        </SELECT>
                    <input type="submit" name="loadButton" class="loadButton" value="Load Chapter">
                </form>


            </div>
        </div>



            <div class="col-sm-6 col-xs-12">
                <div class="row">
                    <div class="col-sm-6 col-sm-push-6 col-xs-12">
                        <div class="signReg">

                                <form action="index.php?action=<?php
                                if(isset($_SESSION['name']))
                                {
                                    echo 'signOut';
                                }
                                else
                                {
                                    echo 'signIn';
                                }
                                ?>"
                                method="post">
                                    <input type="submit" name="signIn" class="signIn" value="<?php if(isset($_SESSION['name'])){echo 'Sign out';} else{ echo 'Sign in';}?>">
                                </form>


                                <?php
                                if(!isset($_SESSION['name']))
                                {
                                ?>

                                <form action="index.php?action=register" method="post">
                                    
                                        <button type="submit" class="register">Register <i class='fas fa-user-plus'></i></button>
                                    
                                </form>
                                <?php
                                }

                                ?>
                        </div>


                    </div>
                </div>
            </div>
    </div>
</div>


</section>


<section>

    <article id="preambleSetup">
        <div class="preambleText">
            <p>"This is a website where i write my book and i publish new chapters as soon as i finish writing them. You will find all the available chapters in the dropdown list above, 
            and as soon as i finish another one it will be added to the list. Have fun !!!"</p>
        </div>
    </article>


</section>

<section id="toRead">

    <article>
        <form id="readableContent">

            <br /><input type="text" name="readTitle" class="readableTitle" disabled="disabled"  placeholder="Title" value ="<?php
            if(!empty($_POST['chapterTitle'])){echo $chapterShow['title'];}else{echo '';}?>">

            <br />
            <?php if(!empty($chapterShow))
            {
            ?>
                <p class="writtenChapter">This chapter was written on the <?= $chapterShow['written_date']?></p>
            <?php
            }
            else
            {
                echo '';
            }
            ?>
            <br />

            <textarea class="readableChapter" name="readChapter" ><?php
                if(!empty($_POST['chapterTitle'])){echo $chapterShow['content'];}else{echo 'Select a chapter and start reading';}?></textarea>


        </form>
    </article>

</section>



<?php $content = ob_get_clean(); ?>

<?php include('C:/wamp64/www/writer/include/template.php'); ?>
