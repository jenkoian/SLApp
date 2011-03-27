<?php
/**
* 
*/
echo form_open(uri_string());
    echo form_fieldset('update profile');
    // ** Place information in between these comments ** //
        echo form_label('Username', 'username');
        $data = array(
                      'name'        => 'username',
                      'id'          => 'username',
                      'value'       => set_value('username', $userInfo['username']),
                      'maxlength'   => '10',
                      'readonly'    => 'readonly'
                    );
        
        echo form_input($data);
        echo form_label('Email', 'email');
        $data = array(
                      'name'        => 'email',
                      'id'          => 'email',
                      'value'       =>  set_value('email', $userInfo['email']),
                    );
        echo form_input($data);
        echo form_label('Password', 'password');
        $data = array(
                      'name'        => 'password',
                      'id'          => 'password',
                      'type'        => 'password',
                    );
        echo form_input($data);
        echo form_label('Password Confirm', 'passconf');
        $data = array(
                      'name'        => 'passconf',
                      'id'          => 'passconf',
                      'type'        => 'password',
                    );
        echo form_input($data);
        echo form_submit('mysubmit', 'Update My Profile');         
    // ** Place information in between these comments ** //
    echo form_fieldset_close(); 
echo form_close();
echo '<p>'.anchor('dashboard', 'return to dashboard').'&nbsp;|&nbsp;';
echo anchor('logout', 'logout').'</p>';