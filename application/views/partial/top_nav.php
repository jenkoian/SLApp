<ul id="top-links">
    <?php
    if ($this->session->userdata('activeUser')) {
    ?>
        <li><?php echo anchor('dashboard', 'dashboard'); ?></li>    
        <li><?php echo anchor('profile', 'edit profile'); ?></li>
        <li><?php echo anchor('logout', 'logout'); ?></li>                 
    <?php
    } else {
    ?>
        <li><?php echo anchor('about', 'wtf?'); ?></li>
        <li><?php echo anchor('login', 'login'); ?></li>                 
    <?php
    }
    ?>
</ul> 