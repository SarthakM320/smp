<?php

function Login()
{
    try{
        session_start();
        $curr_role = $_SESSION['role'];
        if($curr_role=='admin'){
            $roles = [];
            $role_titles = ['Manage FAQs','Manage Categories','Manage Queries','Peer Review'];
            $role_links = ['faqs','categories','queries','peer-review'];
            for ($i = 0 ; $i < count($role_titles) ; $i++){
                $role = null;
                $role->title = $role_titles[$i];
                $role->link = $role_links[$i];
                array_push($roles,$role);
            }
            return json_encode($roles);
        }
        else if($curr_role=='mentor'){
            $roles = [];
//            $role->title = 'Manage FAQs';
//            $role->link = 'faqs';
//            array_push($roles,$role);
//            $role->title = 'Manage Categories';
//            $role->link = 'categories';
//            array_push($roles,$role);
            $role->title = 'Manage Queries';
            $role->link = 'queries';
            array_push($roles,$role);
//            $role->title = 'Peer Review';
//            $role->link = 'peer-review';
//            array_push($roles,$role);
            return json_encode($roles);
        }
        return 'F';
    }
    catch(Exception $e)
    {
        var_dump($e);
        return "F";
    }
}
echo Login();
?>