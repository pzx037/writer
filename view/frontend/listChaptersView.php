
<?php $title = 'Live Book'; ?>

<?php ob_start(); ?>

<section id="topSection">

    <article id="topTitle">
        <h1><?php if(isset($_SESSION['name'])){echo 'Welcome ' . $_SESSION['name'] . '<br /> to Read my Book';}else{echo 'Welcome to Read my Book';} ?></h1>
    </article>

</section>

    <div id="topLine"></div>

<section>

    <article id="preambleSetup">
        <div class="preambleText">
            <p>"This is a website where i write my book and publish the chapters as soon as i finish them. You will find all the available chapters in the list below
            and as soon as i finish another it will be added to the list. Please feel free to give me your thoughts below."</p>
        </div>
    </article>


</section>

<section id="chapters">

    <article class="chapterPreview">

        
        <div class="row">
            <?php while($chapter = $chapters->fetch()) { ?>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="thumbnail">
                        <div class="caption">
                            <h3><?= $chapter['title']; ?></h3>
                            <p><?= $chapter['content']; ?><em><a href="index.php?action=loadChapter&amp;chapterId=<?= $chapter['id']; ?>"> ...read more</a></em></p>
                            <p><em>Written </em><?= $chapter['written_date']; ?></p>                                       
                                    
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <article>

</section>



<?php $content = ob_get_clean(); ?>

<?php include('C:/wamp64/www/writer/include/template.php'); ?>
