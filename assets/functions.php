<?php

require_once 'config/db.php';

/*function insertForumpost($username, $message) { //Insert - Stoppar in nya meddelanden
    $sql = "insert into forum (username, message) values (:username, :msg)";

    global $tourly;

    $stmt = $tourly->prepare($sql);

    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':msg', $message);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}*/

/*function getForumPosts() {
    $sql = "select * from forum order by time desc";

    global $tourly;
    $stmt = $tourly->prepare($sql);
    $stmt->execute();
    return $stmt;
}*/

function login($username, $password){
    global $tourly;

    $sql = "SELECT * FROM user WHERE username = :username";
    $stmt = $tourly->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->execute();

   $user = $stmt->fetch(PDO::FETCH_ASSOC);

   if ($user && password_verify($password, $user['password'])) {  //verifierar eller jämför lösenordet
        return true;
    } else {
        return false;
    } 

    /*$sql = "SELECT * FROM user WHERE username = :username"; //AND password = :password
    $stmt = $forum->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':password', $password);
    $stmt->execute();


    
    if ($stmt->rowCount()>0){  //Password verify och submissiv array
        return true;
    }else {
        return false;
    }*/
    
}

function addUser($felt) {

//INSERT INTO `user`(`username`, `name`, `email`, `password`)
// VALUES ('[value-1]','[value-2]','[value-3]',''[value-4])

    global $tourly;

    $sql = "INSERT INTO user(username, name, email, password)
        VALUES (:username,:name,:email,:password)";
    $stmt = $tourly->prepare($sql); // $sql - SQL koden i Vscode

    $hashed_password = password_hash($felt['password'], PASSWORD_DEFAULT);
    $stmt->bindValue(':username', $felt['username']); //bindValue - kopplar värden eller value
    $stmt->bindValue(':name', $felt['name']);
    $stmt->bindValue(':email', $felt['email']);
    $stmt->bindValue(':password', $hashed_password);

    try {
        return $stmt->execute();
    }

    catch(Exception $e){
        return false;
    }
  /*  if ($stmt->execute()) { 
        return true;
    } else {
        return false;
    }
        */
}

function updateUser($felt){

    global $tourly;

    /*$hashed_password = password_hash($felt['password'], PASSWORD_DEFAULT);*/

    if(!empty($felt['password'])) {
    $sql = "UPDATE user SET name = :name, 
    email = :email, password = :password WHERE username = :username";

    $stmt = $tourly->prepare($sql);
    $stmt->bindValue(':password', $hashed_password);
    } 

    else {
    $sql = "UPDATE user SET name = :name, 
    email = :email WHERE username = :username";

    $stmt = $tourly->prepare($sql);
    }

    $stmt->bindValue(':username', $felt['username']);
    $stmt->bindValue(':name', $felt['name']);
    $stmt->bindValue(':email', $felt['email']);  

    try {
        return $stmt->execute();
    }

    catch(Exception $e){
        return false;
    }
}


/*function getSearchForumPosts{

}*/
