
<?php $title = 'Live Book'; ?>

<?php ob_start(); ?>

<section id="topSection">

    <article id="topTitle">
        <h1><?= 'Welcome to chapter ' . $chapter['id']; ?></h1>
    </article>

</section>

    <div id="topLine"></div>

<section id="toRead">

    <article>
        <form id="readableContent">
            <br /><input type="text" name="readTitle" class="readableTitle" disabled="disabled"  placeholder="Title" value ="<?= $chapter['title']; ?>"><br />
            <?php { ?><p class="writtenChapter">This chapter was written on the <?= $chapter['written_date']; ?></p><?php } ?><br />
            <textarea class="readableChapter" name="readChapter" ><?= $chapter['content']; ?></textarea>
        </form>   
    </article>



    <article>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-md-offset-1 col-sm-8 col-sm-offset-2 col-xs-pull-1 col-xs-10 col-xs-push-1">
                    <h4 class="addComments">Feel free to comment on this chapter</h4> 
                        <form action="index.php?action=addComment&amp;chapterId=<?= $_GET['chapterId']; ?>" method="post">
                            <label>Your thoughts </label><input type="text" class="yourThoughts" name="chapterComment">
                            <input type="submit" class="submitcomment" name="submitComment" value="add">

                        </form>
                </div>

                <div class="col-md-4 col-md-offset-1 col-sm-8 col-sm-offset-2 col-xs-pull-1 col-xs-10 col-xs-push-1">
                    <h4 class="lastComments">Comments   </h4>                 
                        <?php while($comment = $chapterComments-> fetch()) { ?>
                            <div class="dialogbox">
                                <div class="body">
                                    <span class="tip tip-left"></span>
                                        <div class="message">
                                            <span><?= $comment['comment_date']; ?></span><br />
                                            <span><?= $comment['content']; ?></span>
                                            
                                       
                                        </div>
                                </div><br />
                            </div>
                        <?php } ?>
                </div>
            </div>
        </div>
    </article>

</section>

<?php $content = ob_get_clean(); ?>

<?php include('C:/wamp64/www/writer/include/template.php'); ?>
