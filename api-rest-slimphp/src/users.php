<?php

class users
{
    public static function getUsers($db)
    {
        $sth = $db->prepare('SELECT * FROM users ORDER BY id');
        $sth->execute();
        $users = $sth->fetchAll();

        return $users;
    }

    public static function getUser($db, $id)
    {
        $sth = $db->prepare('SELECT * FROM users WHERE id=:id');
        $sth->bindParam('id', $id);
        $sth->execute();
        $user = $sth->fetchObject();

        return $user;
    }

    public static function searchUsers($db, $usersStr)
    {
        $sth = $db->prepare('SELECT * FROM users WHERE UPPER(name) LIKE :query ORDER BY id');
        $query = '%'.$usersStr.'%';
        $sth->bindParam('query', $query);
        $sth->execute();
        $users = $sth->fetchAll();

        return $users;
    }

    public static function createUser($db, $request)
    {
        $input = $request->getParsedBody();
        $sql = 'INSERT INTO users (name) VALUES (:name)';
        $sth = $db->prepare($sql);
        $sth->bindParam('name', $input['name']);
        $sth->execute();
        $input['id'] = $db->lastInsertId();

        return $input;
    }
}
