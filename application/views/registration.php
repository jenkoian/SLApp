<div id="content">
    <h1><?php echo anchor('home', 'SLAPP!'); ?></h1>

    <?php
    include_once 'partial/messages.php';
    ?>

    <div class="form registration"> 
        <?php
        echo form_open('registration');
        ?>
        <div class="formleft">
            <?php echo form_label('Username', 'username'); ?>
        </div>
        <div class="formright">
            <?php
            echo form_input(
                    array(
                          'name'        => 'username',
                          'id'          => 'username',
                          'value'       =>  set_value('username'),
                          'maxlength'   => '50',
                        )
                );
            ?>
        </div>
        <div class="formleft">
            <?php echo form_label('Display name', 'display_name'); ?>
        </div>
        <div class="formright">
            <?php
            echo form_input(
                    array(
                          'name'        => 'display_name',
                          'id'          => 'display_name',
                          'value'       =>  set_value('display_name'),
                          'maxlength'   => '50',
                        )
                );
            ?>
        </div>        
        <div class="formleft">
            <?php echo form_label('Email', 'email'); ?>
        </div>
        <div class="formright">
            <?php 
            echo form_input(
                    array(
                      'name'        => 'email',
                      'id'          => 'email',
                      'value'       =>  set_value('email'),
                    )
                );
            ?>
        </div>
        <div class="formleft">
            <?php echo form_label('Password', 'password'); ?>
        </div>
        <div class="formright">
            <?php echo form_input(
                            array(
                              'name'        => 'password',
                              'id'          => 'password',
                              'type'        => 'password',
                            )
                        ); 
            ?>
        </div>
        <div class="formleft">
            <?php echo form_label('Password Confirm', 'passconf'); ?>
        </div>
        <div class="formright">
            <?php 
                echo form_input(
                            array(
                              'name'        => 'passconf',
                              'id'          => 'passconf',
                              'type'        => 'password',
                            )
                        );
            ?>
        </div>
        <div class="formright">
            <?php echo form_submit('formsubmit', 'Sign up', 'class="large button"'); ?>
        </div>    
        <?php echo form_close(); ?>           
    </div>
    
    <div class="form login">
        <?php
        echo form_open('login');
        ?>
        <div class="formleft">
            <?php echo form_label('Username', 'username'); ?>
        </div>
        <div class="formright">
            <?php
            echo form_input(
                    array(
                          'name'        => 'username',
                          'id'          => 'username',
                          'value'       =>  set_value('username'),
                          'maxlength'   => '10',
                        )
                );
            ?>
        </div>
        <div class="formleft">
            <?php echo form_label('Password', 'password'); ?>
        </div>
        <div class="formright">
            <?php echo form_input(
                            array(
                              'name'        => 'password',
                              'id'          => 'password',
                              'type'        => 'password',
                            )
                        ); 
            ?>
        </div>  
        <div class="formright">
            <?php echo form_submit('formlogin', 'Login', 'class="large button"'); ?>
        </div>    
        <?php echo form_close(); ?>         
    </div>
</div>