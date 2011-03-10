<?php
$db=new SQLiteDatabase("db.sqlite");

// create table 'USERS' and insert sample data

$db->query("BEGIN;

        CREATE TABLE list (id INTEGER PRIMARY KEY,
title CHAR(255));

        INSERT INTO list (id,title) VALUES
(1,'30 before 30');

        CREATE TABLE listItem (id INTEGER PRIMARY KEY,
title CHAR(255), comments TEXT, is_done INTEGER(1), listId INTEGER(3));

        INSERT INTO listItem (id,title,comments,is_done,listId) VALUES
(NULL,'Have started or be ready to start buying my own property (i.e. 
continue saving money for a deposit)',
'Have saved &pound;300 this month. Enquired about Hayes Apartments but nothing available
until Oct.',0,1);

        INSERT INTO listItem (id,title,comments,is_done,listId) VALUES
(NULL,'Be working in a job I am happy in and have a good future and prospects (keep looking and 
applying for new jobs)
',
'Bit of hope with Enable through Alex - at least they are keeping me in mind for future work I think.',0,1);

        INSERT INTO listItem (id,title,comments,is_done,listId) VALUES
(NULL,'Try to stop procrastinating so much (make daily goals and actually do them)
',
'List writing has slipped a bit and procrastinating setting back in - got a bit too
much on plate at moment - need to get work done and not take on anything new.
',0,1);

        INSERT INTO listItem (id,title,comments,is_done,listId) VALUES
(NULL,'Say less negative 
about people behind their backs (I know everyone does this but I hate 
myself for doing it and want to do it less)
',
'Prob still doing this without thinking about it - should probably be a bit more
tolerant of people and not get easily annoyed.
',0,1);

        INSERT INTO listItem (id,title,comments,is_done,listId) VALUES
(NULL,'Redesign my site 
to me more professional and something I do not want to redesign 2 weeks 
later (eek)
',
'Started ideas and think I might be onto something I quite like but need to
concentrate on other stuff at the moment.
',0,1);

        INSERT INTO listItem (id,title,comments,is_done,listId) VALUES
(NULL,'Eat healthier and lose some weight. (Enough 
said)
',
'Ate lots healthier in July and have lost some weight - need to keep up.
',0,1);

        INSERT INTO listItem (id,title,comments,is_done,listId) VALUES
(NULL,'Run a 10k (and maybe even a half marathon if I actually 
manage No 8.)
',
'No progress. Not entered anything maybe I should
',0,1);

        INSERT INTO listItem (id,title,comments,is_done,listId) VALUES
(NULL,'Join gym and go at least twice a week now. (This may have to be delayed slightly
until I am more clear on whether I am working in Cardiff or Bristol.)
',
'',0,1);

        INSERT INTO listItem (id,title,comments,is_done,listId) VALUES
(NULL,'Design, print and sell some postcards/greetings cards',
'I have created a name, designed a logo brainstormed some ideas, bought a domain name
and got my brother thinking of funny ideas for cards too. Oo done more on this than
I had thought
',0,1);

        INSERT INTO listItem (id,title,comments,is_done,listId) VALUES
(NULL,'See Muse, Florence & the Machine (will prob add more) live
',
'Think I have missed all potential tickets - no money for this at present. Did see
Mumford &amp; Sons and Doves this month though.
',0,1);

        INSERT INTO listItem (id,title,comments,is_done,listId) VALUES
(NULL,'Watch the classic films and books I have missed over the years.
',
'I have signed up for LoveFilm trial and have watched lots of the movies I missed
already - getting through my current pile of books slowly - then will use the iBooks
app on my iPad to read all the free classics they have on there.
',0,1);

        INSERT INTO listItem (id,title,comments,is_done,listId) VALUES
(NULL,'Get A Present for... designed up and live.
',
'Been working on visuals - getting there slowly. Will be priority once other jobs out
the way as have had some new ideas and inspiration lately.
',0,1);

        INSERT INTO listItem (id,title,comments,is_done,listId) VALUES
(NULL,'Be with 
someone I love, who loves me back and who has the same vision of our 
future together as me.
',
'Looked up phone number for local nunnery. 
',0,1);

        INSERT INTO listItem (id,title,comments,is_done,listId) VALUES
(NULL,'Go to the Build Conference in Belfast.
',
'Booked ticket, plane and hotel - it is still on like DonkeyKong
',0,1);

        INSERT INTO listItem (id,title,comments,is_done,listId) VALUES
(NULL,'Visit Cardiff Castle
',
'No plans yet - but it is like right there',0,1);

        INSERT INTO listItem (id,title,comments,is_done,listId) VALUES
(NULL,'Start & maintain a Tumblr blog',
'Done &amp; done - really enjoying it so will def keep it up therefore I am ticking this
badboy off.',1,1);

        INSERT INTO listItem (id,title,comments,is_done,listId) VALUES
(NULL,'Keep my new Orchid alive for more than 6 months this time (and prove I 
do not kill all plants I bring into my home)',
'This little baby is still going strong has a new branch of flowers and a new stalk
at the bottom - I am basically now Charlie Dimock - but with a bra.
',0,1);

        INSERT INTO listItem (id,title,comments,is_done,listId) VALUES
(NULL,'Do a dance class
',
'Not looked into this yet.',0,1);

        INSERT INTO listItem (id,title,comments,is_done,listId) VALUES
(NULL,'Learn how to wear my hair wavy and actually like it.',
'Not tried it my hair is just mental in this weather.',0,1);

        INSERT INTO listItem (id,title,comments,is_done,listId) VALUES
(NULL,'At 
least be possibly planning a trip to Japan (may be hard whilst saving a 
deposit?)',
'Nah.',0,1);

        INSERT INTO listItem (id,title,comments,is_done,listId) VALUES
(NULL,'Learn to cook more dishes (and not just bake 
cakes.)',
'I have been cooking lots of simple healthy stuff recently - but nothing thats going to
impress anyone',0,1);

        INSERT INTO listItem (id,title,comments,is_done,listId) VALUES
(NULL,'Try yoga',
'First class tonight',1,1);

        INSERT INTO listItem (id,title,comments,is_done,listId) VALUES
(NULL,'Start dressing more like I want 
to without worrying what people will think all the time.',
'Working on it. Losing bit of weight will prob help.',0,1);

        INSERT INTO listItem (id,title,comments,is_done,listId) VALUES
(NULL,'Keep
 on top of all my crap and keep throwing out/giving away all the stuff I
 do not need.',
'Sorted desk out - need to go through room and wardrobe again soon. But it is fairly
under control at the mo.',0,1);

        INSERT INTO listItem (id,title,comments,is_done,listId) VALUES
(NULL,'Visit the Gower',
'Stayed there for Cats bday. Did not do much sight seeing so need to go back but this
is done.',1,1);

        INSERT INTO listItem (id,title,comments,is_done,listId) VALUES
(NULL,'See Les Mis - and the 
other plays musicals I have been wanting to.
',
'Seen Les Mis last week and got Dirty Dancing in August.',1,1);

        INSERT INTO listItem (id,title,comments,is_done,listId) VALUES
(NULL,'Go home to see 
more of the girls from college.',
'Went home but no one was home or free to meet - boo',0,1);

        INSERT INTO listItem (id,title,comments,is_done,listId) VALUES
(NULL,'Visit the new aquarium in 
Bristol',
'Not done',0,1);

        INSERT INTO listItem (id,title,comments,is_done,listId) VALUES
(NULL,'??',
'??',0,1);

        INSERT INTO listItem (id,title,comments,is_done,listId) VALUES
(NULL,'??',
'??',0,1);

        COMMIT;");
?>