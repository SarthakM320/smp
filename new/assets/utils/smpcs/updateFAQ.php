<?php
include '../db_link.php';
function UpdateFAQ(){
    try
    {
        $question = $_POST['question'];
//        $question = base64_encode($question);
        $question = htmlspecialchars($question);
        $answer = $_POST['answer'];
//        $answer = base64_encode($answer);
        $answer = htmlspecialchars($answer);
        $id = $_POST['id'];

        $link = linkToSMP();
        $sql="UPDATE `faqs` SET `question`=:question, `answer`=:answer WHERE `id`=:id";
        $handle=$link->prepare($sql);
        $handle->execute(array('question' => $question, 'answer'=>$answer, 'id'=>$id));
        return "S";
    }
    catch(Exception $e)
    {
        var_dump($e);
        return "F";
    }
}
echo UpdateFAQ();
?>
