<?php
    if(!isset($_SESSION)) {
          session_start();
    }
require_once("../vendor/danielmewes/php-rql/rdb/rdb.php");

if (isset($_POST['login'])) {
    // do a check up with the db
    $inputEmail = $_POST['inputEmail'];
    //$inputEmail = 'adnan@ahsan.net';
    $inputPassword = $_POST['inputPassword'];
    // $inputPassword = 'testpaass';

    // Check with the db
    $conn = r\connect('localhost');
    $document = ['email' => $inputEmail];
    $result = r\table("users")->filter($document)->run($conn)->toArray();
    print("<pre>".print_r($result,true)."</pre>");
    if (empty($result)) {
        # code...
        echo "No user found";
    } else {
        if ($result[0]['password'] == $inputPassword) {
            echo "One user found"; // $result[0]['password'];
            $_SESSION['valid'] = true;
            $_SESSION['name'] = $result[0]['name'];
            header('Location: '.'../home.php');
        }
    }


    /*
    if ($result) {
        echo "User found<br>";
        $result = r\table("users")->filter($document)->run($conn);
        $user = $result->toArray();
        $password = $user[0]['password'];
        # print("<pre>".print_r($user[0]['email'],true)."</pre>");
        # echo "$password";
        if ($inputPassword == $password) {
            # code...
            echo "Logged in";
        }
    }*/
} else {
    // send to home page right away
    echo "No<br>";
}










