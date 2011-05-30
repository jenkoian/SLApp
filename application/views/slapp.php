<div id="slapp">
    <h1><?php echo anchor('home', 'SLAPP!'); ?></h1>    
    
    <ul id="tabMenu">
        <li class="lists"><?php echo anchor('dashboard/lists','lists'); ?></li>
        <li class="slapps selected"><?php echo anchor('dashboard/slapps','slapps'); ?></li>        
        <li class="slapped"><?php echo anchor('dashboard/slapped','slapped'); ?></li>        
    </ul>
    
    <?php
    include_once 'partial/messages.php';
    ?>    
    
    <div class="form search"> 
        <?php
        echo form_open('slapp/user/');
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
        <div class="formright">
            <?php 
            echo form_hidden('listId', $listId);
            echo form_submit('form_user_search', 'SLApp!', 'class="large button"'); 
            ?>
        </div>         
    </div>

</div>