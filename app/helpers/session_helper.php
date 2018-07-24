<?php

session_start();

// Flash massage helper
// Beispielaufruf: flash('register_success', 'Du bist nun registriert', 'party party-juchuu');
// aufruf in der View.php: <?php echo flash('register_success'); 
function flash($name = '', $message = '', $class = 'alert alert-success') {
    if (!empty($name)) {
        if (!empty($message) && empty($_SESSION[$name])) {
            if (!empty($_SESSION[$name])) {
                unset($_SESSION[$name]);
            }
            if (!empty($_SESSION[$name . '_class'])) {
                unset($_SESSION[$name . '_class']);
            }
            $_SESSION[$name] = $name;
            $_SESSION[$name. '_class'] = $class;
        }
        elseif (empty($message) && !empty($_SESSION['name'])) {
            $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
            echo '<div class="' . $class . '" id="flash-message">' . $_SESSION[$name] . '<div>';
            
            unset($SESSION[$name]);
            unset($SESSION[$name . '_class']);
        }
    }
}


// CHECK OB USER EINGELOGGED IST ++++++++++++++++++++++++++++++++++++++++++
function isLoggedIn() {
    if(isset($_SESSION['user_id'])) {
        return true;
    }
    else {
        return false;
    }
} // ende türsteher  ------------------------------------------------------


function getUserId() {
    return $_SESSION['user_id'];
}