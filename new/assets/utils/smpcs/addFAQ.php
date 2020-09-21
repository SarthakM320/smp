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
        $category = $_POST['category'];

        $link = linkToSMP();
        $sql="INSERT INTO `faqs`(`question`, `category`, `answer`) VALUES (:question,:category,:answer)";
        $handle=$link->prepare($sql);
        $handle->execute(array('question' => $question, 'category'=>$category, 'answer'=>$answer));
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
