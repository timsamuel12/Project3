<?php

function get_questions(){

    global $pdo;
    $query = $pdo->prepare("SELECT * FROM questions WHERE email = :email ");
    $query->bindParam("email", $_SESSION['email']);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    $query->closeCursor();
    return $result;

}

function create_question($qname, $body, $skils){

    global $pdo;
    $query = $pdo->prepare("INSERT INTO questions (name, body, skills, email) VALUES (:name, :body, :skills, :email)");
    $query->bindParam("name", $qname);
    $query->bindParam("body", $body);
    $query->bindParam("skills", $skils);
    $query->bindParam("email", $_SESSION['email']);
    $query->execute();
    $result = $query->rowCount();
    $query->closeCursor();
    return $result;
}

function get_question($id){

    global $pdo;
    $query = $pdo->prepare("SELECT * FROM questions WHERE id = :id ");
    $query->bindParam("id", $id);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    $query->closeCursor();
    return $result;

}

function exist_question($id){

    global $pdo;
    $query = $pdo->prepare("SELECT COUNT(id) FROM questions WHERE id = :id AND email = :email");
    $query->bindParam("id", $id);
    $query->bindParam("email", $_SESSION['email']);
    $query->execute();
    $result = $query->fetchColumn();
    $query->closeCursor();
    return $result;

}

function edit_question($qname, $body, $skils, $id){

    global $pdo;
    $query = $pdo->prepare("UPDATE questions SET name = :name, body = :body, skills = :skills WHERE id = :id");
    $query->bindParam("name", $qname);
    $query->bindParam("body", $body);
    $query->bindParam("skills", $skils);
    $query->bindParam("id", $id);
    $query->execute();
    $result = $query->rowCount();
    $query->closeCursor();
    return $result;

}

function delete_question($id){

    global $pdo;
    $query = $pdo->prepare("DELETE FROM questions WHERE id = :id LIMIT 1");
    $query->bindParam("id", $id);
    $query->execute();
    $result = $query->rowCount();
    $query->closeCursor();
    return $result;
}
