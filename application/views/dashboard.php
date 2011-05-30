<div id="dashboard">
    <h1><?php echo anchor('home', 'SLAPP!'); ?></h1>

    <?php
    include_once 'partial/messages.php';
    ?>
    
    <ul id="tabMenu">
        <li class="lists selected"><?php echo anchor('dashboard/lists','lists'); ?></li>
        <li class="slapps"><?php echo anchor('dashboard/slapps','slapps'); ?></li>        
        <li class="slapped"><?php echo anchor('dashboard/slapped','slapped'); ?></li>        
    </ul>
    
    <div class="breaker"></div>
    
    <div class="lists-box">
        <?php    
        if (isset($lists)) {
            if (!empty($lists)) {
            ?>   
                <ol id="list">
                    <?php                    
                    foreach ($lists->result() as $list) {                        
                    ?>                    
                        <li>
                            <span class="item">
                                <span class="title"><?php echo anchor('lists/view/'.$list->list_id, $list->title); ?></span>
                                <br />
                                <span class="comments">&nbsp;</span>
                            </span>
                            <span class="status"><?php echo anchor('slapp/lists/'.$list->list_id, '<img src="'.site_url().'images/slapp.png" alt="Slapp" class="slapp-icon" />', 'class="slapp_'.$list->list_id.'"'); ?></span>
                            <span class="delete"><?php echo anchor('dashboard/lists/delete/'.$list->list_id, '<img src="'.site_url().'images/delete.png" alt="Delete" class="delete-icon" />', 'class="delete_'.$list->list_id.'"'); ?></span>
                        </li>  
                        
                    <?php
                    }
                    ?>
                </ol>
            <?php
            }
            ?>
            <p class="add_list"><?php echo anchor('dashboard/lists/add', '<img src="'.site_url().'images/add.png" alt="+" align="absmiddle" />Add list', 'class="add_list"'); ?></p>
        <?php
        }
        ?>
    </div>
    
    <div class="slapps-box">
        <?php    
        if (isset($slapps)) {
            if (!empty($slapps)) {
            ?>   
                <ol id="list">
                    <?php                    
                    foreach ($slapps->result() as $slapp) {                        
                    ?>                    
                        <li><?php echo anchor('slapps/view/'.$slapp->list_id, $slapp->title); ?></li>                             
                    <?php
                    }
                    ?>
                </ol>
            <?php
            }
            ?>            
        <?php
        }
        ?>
    </div>    
    
    <div class="slapps-box">
        <?php    
        if (isset($slapped)) {
            if (!empty($slapped)) {
            ?>   
                <ol id="list">
                    <?php                    
                    foreach ($slapped as $slapp) {                        
                    ?>                    
                        <li><?php echo anchor('slapps/view/'.$slapp->list_id, $slapp->title); ?> (<?php echo $slapp->username; ?>)</li>                             
                    <?php
                    }
                    ?>
                </ol>
            <?php
            }
            ?>            
        <?php
        }
        ?>
    </div>     
</div>