<?php
function is_logged_in()
{
//    if (!isset($_SESSION['username'])) {
//        return false;
//    }else{
//        return true;
//    }

    //istoto poinaku zapisano
    return isset($_SESSION['username']);

}

function validate_user_creds($username, $password){
    //validate that against the records

    return ($username === USERNAME && $password === PASSWORD);
        //login + set the session
}