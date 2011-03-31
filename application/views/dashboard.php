<div id="dashboard">
    <h1><?php echo anchor('home', 'SLAPP!'); ?></h1>

    <?php
    include_once 'partial/messages.php';
    ?>
    
    <ul id="tabMenu">
        <li class="lists selected"><?php echo anchor('dashboard/lists','your lists'); ?></li>
        <li class="slapps"><?php echo anchor('dashboard/slapps','your slapps!'); ?></li>        
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
                        <li><?php echo anchor('lists/view/'.$list->list_id, $list->title); ?></li>                             
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
</div>