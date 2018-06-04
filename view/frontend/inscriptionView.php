<?php $title = 'Registration'; ?>



<?php ob_start() ?>

<section id="topSection">
      
      <h1>Registration</h1>

</section>

    <div id="topLine"></div>

<section id="registrationPage">
    <div class="subTitleRegistration">Subscribe and get full access to the site</div>
       <div id="formInscription">
            <form action="index.php?action=inscription" method="post">


                <input type="text" name="username" class="username" placeholder="username" /><br /><br />
                <input type="email" name="email" class="email" placeholder="email"/><br /><br />
                <input type="password" name="pass" class="password" placeholder="password" /><br /><br />
                <input type="password" name="pass2" class="password"  placeholder="password" /><br />

                <input type="submit" name="inscriptionForm" class="submit" value="Register" /><br />

            </form>
        </div>


    <br /><br />

<?php $content = ob_get_clean() ?>

</section>

<?php include('C:/wamp64/www/writer/include/template.php'); ?>