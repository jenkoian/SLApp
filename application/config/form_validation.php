<?php
/*
FORM VALIDATION RULES
*/

$config = 
    array(
    'registration' => array
        (
        array(
                'field' => 'username',
                'label' => 'username',
                'rules' => 'trim|required|min_length[5]|max_length[50]|xss_clean|callback_verifyUniqueUsername'
             ),
        array(
                'field' => 'display_name',
                'label' => 'display_name',
                'rules' => 'trim|required|min_length[5]|max_length[50]|xss_clean|callback_verifyUniqueUsername'
             ),        
        array(
                'field' => 'email',
                'label' => 'email',
                'rules' => 'trim|required|valid_email|callback_verifyUniqueEmail'
             ),             
        array(
                'field' => 'password',
                'label' => 'password',
                'rules' => 'trim|required|min_length[5]|matches[passconf]|md5'
             ),
        array(
                'field' => 'passconf',
                'label' => 'password confirmation',
                'rules' => 'trim|required|matches[password]'
             ),
        ),
    'login' => array
        (
        array(
                'field' => 'username',
                'label' => 'username',
                'rules' => 'trim|required|min_length[5]|max_length[10]|xss_clean'
             ),             
        array(
                'field' => 'password',
                'label' => 'password',
                'rules' => 'trim|required|min_length[5]|md5'
             ),
        ),
    'editUser' => array
        (
        array(
                'field' => 'username',
                'label' => 'username',
                'rules' => 'trim|required|min_length[5]|max_length[50]|xss_clean'
             ),  
        array(
                'field' => 'display_name',
                'label' => 'display_name',
                'rules' => 'trim|required|min_length[5]|max_length[50]|xss_clean'
             ),         
        array(
                'field' => 'email',
                'label' => 'email',
                'rules' => 'trim|required|valid_email'
             ),
        array(
                'field' => 'password',
                'label' => 'password',
                'rules' => 'trim|min_length[5]|matches[passconf]|md5'
             ),
        array(
                'field' => 'passconf',
                'label' => 'password confirmation',
                'rules' => 'trim|matches[password]'
             ),             
        ),                                      
    );