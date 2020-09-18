<?php
include '../db_link.php';
function AddFAQ(){
    try
    {
        $question = $_POST['question'];
//        $question = base64_encode($question);
        $question = htmlspecialchars($question);
        $answer = $_POST['answer'];
//        $answer = base64_encode($answer);
        $answer = htmlspecialchars($answer);

        $link = linkToSMP();
        $sql="INSERT INTO `faqs`(`question`, `answer`) VALUES (:question,:answer)";
        $handle=$link->prepare($sql);
        $handle->execute(array('question' => $question, 'answer'=>$answer));
        return "S";
    }
    catch(Exception $e)
    {
        var_dump($e);
        return "F";
    }
}
echo AddFAQ();
?>
