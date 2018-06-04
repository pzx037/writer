<?php
require_once ('Manager.php');

class ChapterManager extends Manager
{

    /* USER */

    function getChapters()
    {
        $db = $this->getDb();

        $chapters = $db->query('SELECT id, title, LEFT(content,230) AS content, DATE_FORMAT(written_date, \'%a the %D of %b  at %Hh%m\') AS written_date  FROM chapters ORDER BY id ASC');

        return $chapters;
    }

    function getChapter($chapterId)
    {
        $db = $this->getDb();

        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(written_date, \'%d-%m-%Y at %Hh%m\') AS written_date FROM chapters WHERE id = :chapterId');
        $req->bindValue(':chapterId', $chapterId, PDO::PARAM_INT);
        
        $req->execute();
        $chapter = $req->fetch();
     
        return $chapter;
    }


























    /* ADMIN */

    /**
     * recupere les chapitres pour listre celui selectionné par l'utilisateur
     *
     * @return bool|PDOStatement liste les titres des chapters dans la liste deroulante
     */

    // Fills the droplist on home page and admin page
	function dropDown()
	{
		$db = $this->getDb();

		$dropList = $db->query('SELECT * FROM chapters');

        return $dropList;
	}

    /**
     * recupere le chapitre selectionné
     *
     * @return mixed returns the selected chapter
     */

    // Shows the chapter on home page and Admin page
    function showChapter($chapter)
    {
        $db = $this->getDb();

        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(written_date, \'%d/%m/%Y at %Hh%m\')AS written_date FROM chapters WHERE id = :chapterId ');

        $req->bindValue(':chapterId', $chapter, PDO::PARAM_INT);

        $req->execute();
        $chapterShow = $req->fetch();
        
        return $chapterShow;
    }


    function saveChapter()
    {
        $db = $this->getDb();

        $req = $db->prepare('INSERT INTO chapters (title, content, written_date) VALUES(:title, :content, NOW())');

        $req->bindValue('title', $_POST['tinyTitle'], PDO::PARAM_STR);
        $req->bindValue('content', $_POST['tinyTextarea'], PDO::PARAM_STR);

        $req->execute();
    }

    function updateChapter($chapterId)
    {
        $db = $this->getDb();

        $req = $db->prepare('UPDATE chapters SET title = :title, content = :content, modified_date = NOW() WHERE id = :chapterId');

        $req->bindValue(':title', $_POST['tinyTitle'], PDO::PARAM_STR);
        $req->bindValue(':content', $_POST['tinyTextarea'], PDO::PARAM_STR);
        $req->bindValue(':chapterId', $chapterId, PDO::PARAM_INT);

        $req->execute();

    }

    function deleteChapter($chapterId)
    {
        $db = $this->getDb();

        $req = $db->prepare('DELETE FROM chapters WHERE id = :chapterId');

        $req->bindValue(':chapterId', $chapterId, PDO::PARAM_INT);

        $req->execute();
    }

}

