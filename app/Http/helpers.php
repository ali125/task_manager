<?php
function condition_check($value){
    return ( isset($value) || $value !== null || $value = '');
}
function call_user($user){
   
    $say = (condition_check($user->last_name)) ? $user->last_name
    : (condition_check($user->username)) ? $user->username
    : (condition_check($user->name)) ? $user->name  
    : 'Unknown';

    return $say;
}

function role_type($role){
    $role = ($role == 1) ? "Manager"
    : ($role == 2) ? "Employee" 
    : 'Admin';

    return $role;
}

function user_avatar($avatar){
    $path = '/upload/avatar/';
    if(isset($avatar) && $avatar && $avatar != null){
        return $path . $avatar;
    }else{
        return $path . 'default.jpg';
    }
}