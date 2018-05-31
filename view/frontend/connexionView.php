<?php $title = 'Login'; ?>

<?php ob_start() ?>

<section>
    <article id="topSection">
        <h1><?php echo 'Log in here' ;?></h1>
    </article>
</section>

<section id="logInPage">

        <div id="formLogIn">
            <form action="index.php?action=logIn" method="post">
                <input type="text" placeholder="username" name="loginName" class="username"><br /><br />
                <input type="password" placeholder="password" name="loginPassword" class="password"><br />
                <input type="submit" class="logIn" value="log in">
                    <a href="index.php?action=forgot" class="forgot">forgot password</a>
            </form>
        </div>



<?php $content = ob_get_clean() ?>

</section>

<?php include('C:/wamp64/www/writer/include/template.php'); ?>