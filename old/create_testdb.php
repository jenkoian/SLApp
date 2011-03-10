<?php
$db=new SQLiteDatabase("testdb.sqlite");

// create table 'USERS' and insert sample data

$db->query("BEGIN;

        CREATE TABLE list (id INTEGER PRIMARY KEY,
title CHAR(255));

        INSERT INTO list (id,title) VALUES
(1,'Ians to do list');

        CREATE TABLE listItem (id INTEGER PRIMARY KEY,
title CHAR(255), comments TEXT, is_done INTEGER(1), listId INTEGER(3));

        INSERT INTO listItem (id,title,comments,is_done, listId) VALUES
(NULL,'Buy Milk',
'Should have time on way home from work',0,1);

        INSERT INTO listItem (id,title,comments,is_done, listId) VALUES
(NULL,'Finish painting the spare room',
'Will do it when the kid is in bed',0,1);

        COMMIT;");
?>