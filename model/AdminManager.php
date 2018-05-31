<?php
require_once ('Manager.php');


class AdminManager extends Manager
{


    function getMembers()
    {
        $db = $this->getDb();

        $members = $db->query('SELECT id, name, email, confirmed, DATE_FORMAT(inscription_date, \'%d-%m-%Y at %Hh%m\') AS inscription_date FROM members WHERE confirmed = 0 ORDER BY id DESC LIMIT 0, 5');

        return $members;

    }

    function confirmMember($confirm)
    {
        $db = $this->getDb();

        $req = $db->prepare('UPDATE members SET confirmed = 1 WHERE id = :id');
        $req->bindValue(':id', $confirm, PDO::PARAM_INT);

        $req->execute();
    }

    function deleteMember($delete)
    {
        $db = $this->getDb();

        $req = $db->prepare('DELETE FROM members WHERE id = :id');
        $req->bindValue(':id', $delete, PDO::PARAM_INT);

        $req->execute();
    }



}
