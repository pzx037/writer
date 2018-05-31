
<?php $title = 'Admin'; ?>

<?php ob_start(); ?>

<head>
	  <script src="public/plugin/tinymce/tinymce.min.js"></script>
        <script>
            tinymce.init({
                selector:'textarea',
                height:400,
                plugins:[
                    'advlist autolink lists image charmap print preview anchor textcolor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table contextmenu paste code help'
                ],
                forced_root_block : false,
                force_br_newlines : true,
                force_p_newlines : false,
                toolbar: 'insert | undo redo | stylselect | bold italic backcolor | alignleft, aligncnter, alignright alignjustify | bullist numlist indent | removeformat | help'

            });
        </script>
</head>


<section id="topSection">

    <header>
        <h1 class="session_name"><?= 'Welcome ' . $_SESSION['name'];?></h1>
    </header>

</section>

<section id="adminPage">

    <h3 class ="adminSubTitle"> Write your chapters here</h3><br />

        <form action="index.php?action=load" class="button_load_admin" method="post">

            <SELECT name="chapterTitle" id='chapterTitle'>
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

            


    <div id="mceForm">
        
        <form action="index.php?action=tinyMCE&amp;chapterId=<?=$chapterId;?>" class="tinyMceForm" method="post">
            
            <div class="inputTitleAdmin">
                    <label>Title</label> 

                    <input type="text" name="tinyTitle" id="tinyTitle" value ="<?php
            if(!empty($_POST['chapterTitle'])){echo $chapterShow['title'];}else{echo '';}?>">
            <br /><br />
                    <input type="submit" name="tinySave" class="tinySave" value="Save">
                    <input type="submit" name="tinyUpdate" class="tinyUpdate" value="Update">
                    <input type="submit" name="tinyDelete" class="tinyDelete" value="Delete">
            </div> 

    		<br /><br />
    		 
                    <textarea class="tinymce" name="tinyTextarea"><?php
                        if(isset($_POST['chapterTitle']) && $_POST['chapterTitle'] !== 'Choose a chapter'){echo $chapterShow['content'];}else{echo '';}?></textarea>
    	</form>

    </div>

</section>


<section id="confirmDelete">
    <h3 class ="adminTitle"> Confirm or Delete Members and Comments</h3> <br />
        <h4><em>List of Members to edit</em></h4>
            <article class="adminTables">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th class="info">Id</th>
                                <th class="info">Name</th>
                                <th class="info">Email</th>
                                <th class="info">Inscription Date</th>
                                <th class="info"></th>
                                <th class="info"></th>
                            </tr>
                        </thead>
                        
                            <?php while($member = $members->fetch()) { ?>

                        <tbody>
                             <tr>
                                <td><?= $member['id'] ?></td>
                                <td> <?= $member['name'] ?> </td>
                                <td><?=	$member['email'] ?> </td>
                                <td><?=	$member['inscription_date'] ?> </td>
                                <?php
                                if($member['confirmed'] == 0)
                                { ?>
                                <td><a href="index.php?action=confirm&amp;confirm= <?= $member['id']?>" class="confirm">Confirm</a></td>
                                <?php } ?>
                                <td><a href="index.php?action=delete&amp;delete= <?= $member['id']?>" class="delete">Delete </a></td>
                                <?php
                                }
                                $members->closeCursor();
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <br /><br />
            </article>

    <h4><em>List of Comments to edit</em></h4>
            <article class="adminTables">

                <div class="table-responsive">
                    <table class="table table-bordered table-hover ttable-condensed">
                        <thead>
                            <tr>
                                <th class="info">Id</th>
                                <th class="info">Name</th>
                                <th class="info">Comment</th>
                                <th class="info">Comment date</th>
                                <th class="info"></th>
                                <th class="info"></th>
                            </tr>
                         </thead>
                            
                            <?php while($comment = $adminComments->fetch()) { ?>
                        
                        <tbody>        
                            <tr>
                                <td> <?= $comment['id_member'] ?> </td>
                                <td> <?= $comment['name'] ?> </td>
                                <td><?=	$comment['content'] ?> </td>
                                <td><?=	$comment['comment_date'] ?> </td>

                                <?php
                                if($comment['confirmed'] == 0)
                                { ?>
                                    <td><a href="index.php?action=confirmComment&amp;confirm= <?= $comment['id']?>" class="confirm">Confirm </a></td>
                                <?php } ?>
                                <td><a href="index.php?action=deleteComment&amp;delete= <?= $comment['id']?>" class="delete">Delete </a></td>
                                <?php
                                }
                                $adminComments->closeCursor();
                                ?>
                            </tr>
                        </tbody>    
                    </table>
                </div>    
            </article>

    <br /><br />



<?php $content = ob_get_clean(); ?>

</section>

<?php require 'include/template.php'; ?>
