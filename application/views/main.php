<h1 class="list_title"><?php echo $title; ?></h1>

<div id="percentage_bar">
    <span style="width: <?php echo $percentage; ?>%" title="<?php echo $percentage; ?>%"></span>
</div>

<!-- TODO: Use an ordered list rather than a table -->
<ol id="list">
    <?php
    $i = 1;
    foreach ($items as $item) {
    ?>
        <li>
            <span class="item<?php echo ($item->is_done) ? ' done' : ''?>">
                <span class="title" id="title_<?php echo $item->id; ?>"><?php echo $item->title;?></span>
                <br />
                <span class="comments" id="comments_<?php echo $item->id; ?>"><?php echo $item->comments;?></span>
            </span>
            <span class="status"><?php echo ($item->is_done) ? anchor('main/uncomplete/item/'.$item->id, '<img src="'.site_url().'images/uncomplete.png" alt="Uncomplete" class="uncomplete-icon" />', 'class="uncomplete_'.$item->id.'"') : anchor('main/complete/item/'.$item->id, '<img src="'.site_url().'images/complete.png" alt="Complete" class="complete-icon" />', 'class="complete_'.$item->id.'"') ?></span>
            <span class="delete"><?php echo anchor('main/delete/item/'.$item->id, '<img src="'.site_url().'images/delete.png" alt="Delete" class="delete-icon" />', 'class="delete_'.$item->id.'"'); ?></span>
        </li>
    <?php
        ++$i;
    }
    ?>
</ol>

<p><?php echo anchor('main/add/item', '<img src="'.site_url().'images/add.png" alt="+" align="absmiddle" />Add item', 'class="add_item"'); ?></p>