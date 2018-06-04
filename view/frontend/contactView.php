<?php $title = 'Login'; ?>

<?php ob_start() ?>

<section>
    <article id="topSection">
               <h1><?php if(isset($_SESSION['name'])){echo $_SESSION['name'] . ' keep in contact';}else{echo 'Keep in Contact';} ?></h1>
    </article>
</section>

    <div id="topLine"></div>

<section id="contactPage">
    <div id="formContact">
        <form action="index.php?action=contactForm" method="post">


            <input type="text" name="username" class="username" placeholder="username" /><br /><br />
            <input type="email" name="email" class="email" placeholder="email"/><br /><br />
            <textarea type="text" name="contactMessage" class="message"></textarea><br />

            <input type="submit" name="contactForm" class="submit" value="send" />

        </form>
    </div>

<?php $content = ob_get_clean() ?>

</section>

<?php include('C:/wamp64/www/writer/include/template.php'); ?>