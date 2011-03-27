<?php
/**
* 
*/
echo form_open(uri_string());
    echo form_fieldset('login information');
    // ** Place information in between these comments ** //
        echo form_label('username', 'username');
        $data = array(
                      'name'        => 'username',
                      'id'          => 'username',
                      'value'       =>  set_value('username'),
                      'maxlength'   => '10',
                    );
        echo form_input($data);
        echo form_label('password', 'password');
        $data = array(
                      'name'        => 'password',
                      'id'          => 'password',
                      'type'        => 'password',
                    );
        echo form_input($data);
        echo form_submit('mysubmit', 'Login');         
    // ** Place information in between these comments ** //
    echo form_fieldset_close(); 
echo form_close();
echo '<p>'.anchor('registration', 'register now!').'</p>';