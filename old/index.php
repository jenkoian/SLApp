<?php
/**
 * TODO: Refactor this
 */
$db = new SQLiteDatabase("testdb.sqlite");

// Are we marking items as complete/uncomplete
if (isset($_GET['is_done'])) {
    // Mark an item as complete
    if (is_numeric($_GET['id'])) {
        $db->singleQuery("UPDATE listItem SET is_done = ".$_GET['is_done'].
                            " WHERE id = ".$_GET['id']);
        $return_percentage = 1;
    }
}

// Are we deleting an item?
if (isset($_GET['delete_item'])) {
    // Mark an item as complete
    if (is_numeric($_GET['id'])) {
        $db->singleQuery("DELETE FROM listItem".
                            " WHERE id = ".$_GET['id']);
        $return_percentage = 1;
    }
}

if ($_POST['title'] || $_POST['comments']) {

    list($field, $id) = explode('_',$_POST['id']);

    $db->singleQuery("UPDATE listItem SET {$field} = '".$_POST[$field]."'".
                        " WHERE id = ".$id);
    echo $_POST[$field];
    exit;
}

// Get list title
$list_title = $db->singleQuery("SELECT title FROM list WHERE id = 1");

// Get list items
$items = $db->query("SELECT * FROM listItem WHERE listId = 1");

$total_items = count($items);

$done_items = $db->singleQuery("SELECT COUNT(title) FROM listItem WHERE listId = 1 AND is_done = 1");

$percentage = number_format(($done_items / $total_items) * 100,0);

// Are we adding a new item?
if (isset($_GET['add_item'])) {
    $db->singleQuery("INSERT INTO listItem (title, comments, is_done, listId) VALUES ('[Click to edit]','[Click to edit]',0,1)");

    $return_percentage = 1;

    // Get the latest addition
    $new_item = $db->query("SELECT * FROM listItem WHERE listId = 1 ORDER BY id DESC LIMIT 1");

    $new_row = $new_item->fetch(SQLITE_ROW);

    if ($_GET['ajax']) {
        echo '<tr>
                    <td class="id" valign="top">'.($total_items+1).'</td>
                    <td>
                        <span class="title" id="title_'.$new_row['id'].'">'.$new_row['title'].'</span>
                        <br />
                        <span class="comments" id="comments_'.$row['id'].'">'.$new_row['comments'].'</span>
                    </td>
                    <td valign="top" class="status"><a class="complete_'.$new_row['id'].'" href="?complete='.$new_row['id'].'">Complete</a></td>
                    <td valign="top" class="delete"><a class="delete_'.$new_row['id'].'" href="?delete_item='.$new_row['id'].'">Delete</a></td>
                </tr>';
        exit;
    }
}

// Are they editing some text
if ($_POST['list_title']) {

    $field = 'title';
    $list_title = str_replace('[total]',$total_items,$_POST['list_title']);

    $db->singleQuery("UPDATE list SET title = '".$list_title."'".
                        " WHERE id = 1");
    echo $list_title;
    exit;
}

if ($return_percentage) {
    echo $percentage;
    exit;
}
?>
<!doctype html>
<html>
    <head>
        <!--[if lte IE 8]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script> 
        <![endif]--> 
        <title><?php echo $list_title; ?></title>
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
        <meta charset="utf-8" />
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery.jseditable.js"></script>
        <script type="text/javascript" src="js/alljs.js"></script>
    </head>
    <body>
        <div id="main">
            <h1 class="list_title"><?php echo $list_title; ?></h1>
            
            <h2>Progress</h2>
            <div id="percentage_bar">
                <span style="width: <?php echo $percentage; ?>%"><?php echo $percentage; ?>%</span>
            </div> 
            
            <table id="list" cellpadding="10">
                <?php
                $i = 1;
                while($row = $items->fetch(SQLITE_ASSOC)){
                ?>
                    <tr>
                        <td class="id" valign="top"><?php echo $i;?></td>
                        <td <?php echo ($row['is_done']) ? 'class="done"' : ''?>>
                            <span class="title" id="title_<?php echo $row['id']; ?>"><?php echo $row['title'];?></span>
                            <br />
                            <span class="comments" id="comments_<?php echo $row['id']; ?>"><?php echo $row['comments'];?></span>
                        </td>
                        <td valign="top" class="status"><?php echo ($row['is_done']) ? '<a class="uncomplete_'.$row['id'].'" href="?uncomplete='.$row['id'].'">Uncomplete</a>' : '<a class="complete_'.$row['id'].'" href="?complete='.$row['id'].'">Complete</a>'?></td>
                        <td valign="top" class="delete"><a class="delete_<?php echo $row['id'];?>" href="?delete_item=<?php echo $row['id'];?>">Delete</a></td>
                    </tr>
                <?php
                    ++$i;
                }
                ?>
            </table>
            
            <p><a href="?add_item=1" id="add_item">+ Add item</a></p>
        </div>
    </body>

</html>