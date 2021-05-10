<?php
    session_start();

    require_once "util.php";

    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        echo json_encode([
            'success' => false,
            'message' => 'POST Method HTTP required'
        ]);

    }

    header('Content-Type: application/json');

    // if loggeedddd in then redirect to timeline.php
    if (isUserLoggedIn()) {
        echo json_encode([
            'success' => false,
            'message' => 'User is already authenticated'
        ]);
        die();
    }

    // get the data
    $email = $_POST['email'];
    $password= $_POST['password'];

    $user = findUserByEmailAndPassword($email, $password);

    if($user != null){
        // logged in
        echo "Logged in!!!";
        $_SESSION['logged_in'] = true;
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['email'] = $email;
        $_SESSION['id_user'] = $user['id_user'];
        echo json_encode([
            'success' => true,
            'message' => 'Authenticated'
        ]);
        die();
    }else {
        
        $_SESSION['logged_in'] = false;
        echo json_encode([
            'success' => false,
            'message' => 'Wrong credentials!!'
        ]);
    }


?>