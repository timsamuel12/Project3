<?php
include("../config.php");
include("../models/database.php");
include("../models/questions_db.php");

if(!isset($_SESSION['email'])) {
    header("Location: ../");
    die();
}

$action = filter_input(INPUT_GET, 'action');
if ($action == NULL) {
    $action = 'display_questions';
}

if($action == "display_questions"){
    $result = get_questions();
    include("../views/display_questions.php");

} else if($action == "display_new_question"){
    include("../views/display_new_question.php");

} else if($action == "create_new_question"){

    if(isset($_POST['submit']))
    {
        $qname = $_POST['qname'];

        $body = $_POST['body'];
        $skills = $_POST['skills'];
        if($qname == '')
        {
            $_SESSION['error'] = "Question name is required";
        }
        else if(strlen($qname)<3)
        {
            $_SESSION['error'] = "Question name character length minimum is 3.";
        }
        else if($body == '')
        {
            $_SESSION['error'] = "Question Body is required to be filled.";
        }
        else if(strlen($body)>500)
        {
            $_SESSION['error'] = "Question body must contain less than 500 characters";
        }
        else
        {
            $array = explode(",", $skills);
            $skils = serialize($array);

            $result = create_question($qname, $body, $skils);

            if($result > 0)
                $_SESSION['success'] = "Question has been submitted successfully!";
            else
                $_SESSION['error'] = "There is some error.";

        }
    } else $_SESSION['error'] = "There was an error.";

    header("Location: ?action=display_new_question");

} else if($action == "display_edit_question"){

    $id = intval(filter_input(INPUT_GET, 'id'));

    if($id < 1) die("Invalid ID");

    $question = get_question($id);

    if(false == $question)
        die("Invalid ID");

    $question['skills'] = unserialize($question['skills']);
    $skills = "";
    foreach( $question['skills'] as $key => $sk) {
        $skills .= $sk;
        if((count($question['skills']) - 1 ) != $key )
            $skills .= ", ";
    }

    include("../views/display_edit_question.php");

} else if($action == "edit_question"){

    $id = intval(filter_input(INPUT_GET, 'id'));

    if($id < 1) die("Invalid ID");

    $result = exist_question($id);

    if($result < 1){
        echo "Invalid ID";
        die();
    }

    if(isset($_POST['submit']))
    {
        $qname = $_POST['qname'];

        $body = $_POST['body'];
        $skills = $_POST['skills'];
        if($qname == '')
        {
            $_SESSION['error'] = "Question name is required";
        }
        else if(strlen($qname)<3)
        {
            $_SESSION['error'] = "Question name character length minimum is 3.";
        }
        else if($body == '')
        {
            $_SESSION['error'] = "Question Body is required to be filled.";
        }
        else if(strlen($body)>500)
        {
            $_SESSION['error'] = "Question body must contain less than 500 characters";
        }
        else
        {
            $array = explode(",", $skills);
            $skils = serialize($array);

            $result = edit_question($qname, $body, $skils, $id);

            if($result > 0)
                $_SESSION['success'] = "Question has been edited successfully!";
            else
                $_SESSION['error'] = "There is some error.";

        }
    } else $_SESSION['error'] = "There was an error.";

    header("Location: ?action=display_edit_question&id=".$id);

} else if($action == "delete_question"){

    $id = intval(filter_input(INPUT_GET, 'id'));

    if($id < 1) die("Invalid ID");

    $result = exist_question($id);

    if($result < 1){
        echo "Invalid ID";
        die();
    }

    $r = delete_question($id);

    if($r > 0)
        $_SESSION['success'] = "Selected question has been deleted successfully!";
    else
        $_SESSION['error'] = "There is some error.";

    header("Location: ./");

} else {
    include("../views/404.php");
}