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
        $category = $_POST['category'];
        $id = $_POST['id'];

        $link = linkToSMP();
        $sql="UPDATE `faqs` SET `question`=:question, `category`=:category, `answer`=:answer WHERE `id`=:id";
        $handle=$link->prepare($sql);
        $handle->execute(array('question' => $question, 'category'=>$category, 'answer'=>$answer, 'id'=>$id));
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
