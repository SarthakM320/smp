<?php

function login(){
    try{
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);
        $branch = trim($_POST["branch"]);

        $all_branches = array("ae","ce","ch","cl","cs","ee","en","ep","es","hs","ma","me","mm");
        $all_usernames = array("adm-ae","adm-ce","adm-ch","adm-cl","adm-cs","adm-ee","adm-en","adm-ep","adm-es","adm-hs","adm-ma","adm-me","adm-mm");
        $all_passwords = array("84887","23060","77210","15348","13126","45821","88200","38666","22594","16268","28558","84652","10677");

        $index = array_search($branch,$all_branches);
        if($index === null){
            return "FI";
        }
        if($username !== $all_usernames[$index] or $password !== $all_passwords[$index]){
            return "F";
        }
        else{
            // If username, password and branch match and are valid, login the user
            session_start();
            $_SESSION["branch"] = $branch;
            return "S";
        }
    }
    catch(Exception $e){
        var_dump($e);
        return "F";
    }
}

echo login();