<?php

/*****************************************************************************
File:		  install.php
Author:		Oliver Chi
Purpose:	<installation processing> create tables and entries in database
******************************************************************************/

// Create and Load Database
  try{ $db = new SQLite3('./assets/db/db.sq3'); } catch(Exception $exception){ echo $exception->getMessage(); }

// Create All Tables
  /* create user table */
  $db->exec(
  "CREATE TABLE IF NOT EXISTS user(
      id INT(8) PRIMARY KEY,
      email VARCHAR(64),
      key VARCHAR(16),
      name VARCHAR(32) )"
  );
  /* create product table */
  $db->exec(
  "CREATE TABLE IF NOT EXISTS product(
      id INT(8) PRIMARY KEY,
      title VARCHAR(255),
      author VARCHAR(255),
      date DATE,
      category TINYINT(1),
      price FLOAT(10,2),
      discount FLOAT,
      brief TEXT,
      description TEXT)"
  );
  /* create order table */
  $db->exec(
  "CREATE TABLE IF NOT EXISTS orders(
      id INT(8) PRIMARY KEY,
      userid INT(8),
      date DATE,
      totalprice FLOAT(10,2),
      ifpaid TINYINT(1),
      deliveryid INT(8) )"
  );
  /* create order-products table */
  $db->exec(
  "CREATE TABLE IF NOT EXISTS orderproducts(
      id INT(8) PRIMARY KEY,
      orderid INT(8),
      productid INT(8),
      price FLOAT(10,2),
      discount FLOAT(10,2),
      amount TINYINT(1) )"
  );
  /* create delivery table */
  $db->exec(
  "CREATE TABLE IF NOT EXISTS delivery(
      id INT(8) PRIMARY KEY,
      orderid INT(8),
      status TINYINT(1),
      deliverer VARCHAR(255),
      barcode VARCHAR(32),
      phone VARCHAR(10),
      street VARCHAR(255),
      city VARCHAR(32),
      state VARCHAR(3),
      postcode VARCHAR(4) )"
  );
  /* create invoice table */
  $db->exec(
  "CREATE TABLE IF NOT EXISTS invoice(
      id INT(8) PRIMARY KEY,
      orderid INT(8),
      name VARCHAR(255),
      info VARCHAR(255),
      price FLOAT(10,2),
      gst FLOAT(10,2) )"
  );
  /* create review table */
  $db->exec(
  "CREATE TABLE IF NOT EXISTS review(
      id INT(8) PRIMARY KEY,
      userid INT(8),
      productid INT(8),
      star TINYINT(1),
      comment TEXT )"
  );
  /* create cart table */
  $db->exec(
  "CREATE TABLE IF NOT EXISTS cart(
      id INT(8) PRIMARY KEY,
      userid INT(8),
      productid INT(8),
      amount TINYINT(1) )"
  );
  /* create admin table */
  $db->exec(
  "CREATE TABLE IF NOT EXISTS admin(
      name VARCHAR(5) PRIMARY KEY,
      key VARCHAR(10) )"
  );

// Insert All Entries and Test User information
  if ($db->exec("INSERT INTO admin (name, key) VALUES ('admin', 'usq-ict')") ) {/* administrator */
    echo "administrator info writes into database successfully<br>";
  } else {
    echo "error in the processing of administrator info writing into database<br>";
  }

  if ($db->exec("INSERT INTO user (id, email, key, name) VALUES (10000001, 'oliver.chi@icloud.com', 'u1037192', 'Oliver')") ){/* register user 1 */
    echo "register user 1 info writes into database successfully<br>";
  } else {
    echo "error in the processing of register user 1 info writing into database<br>";
  }

  if ($db->exec("INSERT INTO user (id, email, key, name) VALUES (10000002, 'eleen.guan@icloud.com', 'Eleen123', 'Eleen')") ){/* register user 2 */
    echo "register user 2 info writes into database successfully<br>";
  } else {
    echo "error in the processing of register user 2 info writing into database<br>";
  }

  /* product 1 */
  $brief1 = "With the Scratch Coding Cards, kids learn to code as they create interactive games, stories, music, and animations. The short-and-simple activities provide an inviting entry point into Scratch, the graphical programming language used by millions of kids around the world.";
  $description1 = "Kids can use this colorful 75-card deck to create a variety of interactive programming projects. They will create their own version of Pong, Write an Interactive Story, Create a Virtual Pet, Play Hide and Seek, and more!

Each card features step-by-step instructions for beginners to start coding with Scratch. The front of the card shows an activity kids can do with Scratch-like animating a character or keeping score in a game. The back shows how to put together code blocks to make the projects come to life! Along the way, kids learn key coding concepts, such as sequencing, conditionals, and variables.

This collection of coding activity cards is perfect for sharing among small groups in homes and schools.";
  $sql_product1 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES (10000001, 'Scratch Coding Cards', 'Scratch Team Mit', '2017-02-10', 0, 26.43, 0.85, '$brief1', '$description1')";
  if ($db->exec($sql_product1)){
    echo "product 1 info writes into database successfully<br>";
  } else {
    echo "error in the processing of product 1 info writing into database<br>";
  }
  /* product 2 */
  $brief2 = "Suitable for children, this title covers colourful collage illustrations and its deceptively simply, hopeful story. It features die-cut pages and finger-sized holes to explore.";
  $description2 = "";
  $sql_product2 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES (10000002, 'The Very Hungry Caterpillar', 'Eric Carle', '1994-02-12', 0, 15.75, 0.95, '$brief2', '$description2')";
  if ($db->exec($sql_product2)){
    echo "product 2 info writes into database successfully<br>";
  } else {
    echo "error in the processing of product 2 info writing into database<br>";
  }
  /* product 3 */
  $brief3 = "Harry finds some old dinosaurs in his Grandma’s attic. He cleans them up and makes them his own, carefully (and accurately) naming each one. Harry and his dinosaurs go everywhere together. But one day, after an exciting train ride, Harry accidentally leaves the dinosaurs on the train. Silly, charming illustrations accompany this whimsical text of a child being a child.";
  $description3 = "From the Hardcover edition.";
  $sql_product3 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES (10000003, 'Harry and the Bucketful of Dinosaurs', 'Ian Whybrow', '2009-02-23', 0, 12.77, 0.95, '$brief3', '$description3')";
  if ($db->exec($sql_product3)){
    echo "product 3 info writes into database successfully<br>";
  } else {
    echo "error in the processing of product 3 info writing into database<br>";
  }
  /* product 4 */
  $brief4 = "Jordan Peterson as a clinical psychologist has reshaped the modern understanding of personality, and now he has become one of the world most popular public thinkers, with his lectures on topics ranging from the Bible to romantic relationships drawing tens of millions of viewers. In an era of polarizing politics, echo chambers and trigger warnings, his startling message about the value of personal responsibility and the dangers of ideology has resonated around the world.";
  $description4 = "In this book, he combines ancient wisdom with decades of experience to provide twelve profound and challenging principles for how to live a meaningful life, from setting your house in order before criticising others to comparing yourself to who you were yesterday, not someone else today. Gripping, thought-provoking and deeply rewarding, 12 Rules for Life offers an antidote to the chaos in our lives- eternal truths applied to our modern problems.";
  $sql_product4 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES (10000004, '12 Rules for Life', 'Jordan B.Peterson', '2018-01-16', 1, 24.00, 0.90, '$brief4', '$description4')";
  if ($db->exec($sql_product4)){
    echo "product 4 info writes into database successfully<br>";
  } else {
    echo "error in the processing of product 4 info writing into database<br>";
  }
  /* product 5 */
  $brief5 = "Explores the projects, dreams and nightmares that will shape the twenty-first century - from overcoming death to creating artificial life. This book asks the fundamental questions: Where do we go from here? And how will we protect this fragile world from our own destructive powers?";
  $description5 = "";
  $sql_product5 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES (10000005, 'Homo Deus: A Brief History of Tomorrow', 'Yuval Noah Harari', '2017-05-21', 1, 18.01, 1, '$brief5', '$description5')";
  if ($db->exec($sql_product5)){
    echo "product 5 info writes into database successfully<br>";
  } else {
    echo "error in the processing of product 5 info writing into database<br>";
  }
  /* product 6 */
  $brief6 = "Penguin presents the unabridged downloadable audiobook edition of Mythos, written and read by Stephen Fry. ";
  $description6 = "The Greek myths are amongst the greatest stories ever told, passed down through millennia and inspiring writers and artists as varied as Shakespeare, Michelangelo, James Joyce and Walt Disney.

They are embedded deeply in the traditions, tales and cultural DNA of the West. You will fall in love with Zeus, marvel at the birth of Athena, wince at Cronus and Gaia revenge on Ouranos, weep with King Midas and hunt with the beautiful and ferocious Artemis.

Spellbinding, informative and moving, Stephen Fry Mythos perfectly captures these stories for the modern age - in all their rich and deeply human relevance. ";
  $sql_product6 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES (10000006, 'Mythos', 'Stephen Fry', '2017-01-21', 1, 25.90, 0.80, '$brief6', '$description6')";
  if ($db->exec($sql_product6)){
    echo "product 6 info writes into database successfully<br>";
  } else {
    echo "error in the processing of product 6 info writing into database<br>";
  }
  /* product 7 */
  $brief7 = "Harry Potter has never even heard of Hogwarts when the letters start dropping on the doormat at number four, Privet Drive. Addressed in green ink on yellowish parchment with a purple seal, they are swiftly confiscated by his grisly aunt and uncle. Then, on Harry eleventh birthday, a great beetle-eyed giant of a man called Rubeus Hagrid bursts in with some astonishing news: Harry Potter is a wizard, and he has a place at Hogwarts School of Witchcraft and Wizardry. An incredible adventure is about to begin!";
  $description7 = "Harry Potter and the Philosopher’s Stone is also available as an Illustrated Kindle-in-Motion edition.";
  $sql_product7 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES (10000007, 'Harry Potter and the Philosophers Stone', 'J.K. Rowling', '2015-09-21', 2, 22.99, 0.95, '$brief7', '$description7')";
  if ($db->exec($sql_product7)){
    echo "product 7 info writes into database successfully<br>";
  } else {
    echo "error in the processing of product 7 info writing into database<br>";
  }
  /* product 8 */
  $brief8 = "This popular paperback edition of the classic work of fantasy, with a striking new black cover based on JRR Tolkien own design and featuring brand new reproductions of all his drawings and maps.";
  $description8 = "";
  $sql_product8 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES (10000008, 'The Hobbit: International Edition', 'J.R.R. Tolkien', '1991-11-13', 2, 15.50, 1, '$brief8', '$description8')";
  if ($db->exec($sql_product8)){
    echo "product 8 info writes into database successfully<br>";
  } else {
    echo "error in the processing of product 8 info writing into database<br>";
  }
  /* product 9 */
  $brief9 = "An enemy hidden in the shadows,
A crack in the armor of secrecy,
One chance to find an answer.";
  $description9 = "Captain David Rice and the crew of Red Falcon have spent two years infiltrating the arms smuggling underworld of the Protectorate of the Mage-King of Mars. When the co-opted rebellion on Ardennes reveals a supply chain of weapons intended to fight Mars, this makes them the perfect team to investigate.

His new mission brings him across old friends and old enemies alike, but as his suspects start turning up dead, David realizes he isn’t the only one following the loose ends.

As shadowy enemies move to position themselves for civil war, Red Falcon’s crew must chase an ever-shrinking set of clues. If they succeed, they might just buy the Protectorate peace for their lifetime.

But if they fail…";
  $sql_product9 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES (10000009, 'Agents of Mars', 'Glynn Stewart', '1998-10-12', 2, 16.99, 0.95, '$brief9', '$description9')";
  if ($db->exec($sql_product9)){
    echo "product 9 info writes into database successfully<br>";
  } else {
    echo "error in the processing of product 9 info writing into database<br>";
  }
  /* product 10 */
  $brief10 = "For readers of Santa Montefiore and Victoria Hislop, a gripping story of passion and family secrets set in a glorious Tuscan villa";
  $description10 = "When Carrie Stowe unexpectedly inherits her eccentric grandmother’s Italian villa, she sets her heart on going to Tuscany. It could be her only escape from the mundane and suffocating routine of life with Arthur, her repressive husband.

Arriving late at night and in the midst of a violent storm, she discovers that she is not alone. A young man is there before her, an enigmatic figure from the past: her cousin Leo, who had been missing for years, believed dead.

As Carrie reads the secrets of her grandmother’s diaries and the enchantment of the house exerts itself, Carrie finds herself irresistibly drawn to him. But what of her husband? And is Leo really who he appears to be?";
  $sql_product10 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES (10000010, 'The Italian House: The unmissable read of 2018', 'Teresa Crane', '2016-04-03', 3, 145.10, 0.75, '$brief10', '$description10')";
  if ($db->exec($sql_product10)){
    echo "product 10 info writes into database successfully<br>";
  } else {
    echo "error in the processing of product 10 info writing into database<br>";
  }
  /* product 11 */
  $brief11 = "All the love she ever gave. Every secret she never told.";
  $description11 = "Catherine was the love of Sean’s life. But now she is gone. All that’s left is a box full of envelopes, each containing a snapshot and a cassette tape.

Through a series of recordings, Catherine shares their long love story, but will Sean recognise the story she tells? Catherine’s words have been chosen with love, but are painfully honest—and sometimes simply painful. She reveals every unspoken thought and every secret she kept from her husband—revelations that will shake everything Sean thought he knew about their life together.

But as disconcerting as the tapes turn out to be, Sean prays that they will ultimately confirm the one thing he never dared question. Does destiny exist? And were his and Catherine’s love and life together always meant to be?";
  $sql_product11 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES (10000011, 'Things We Never Said', 'Nick Alexander', '2018-4-9', 3, 22.24, 0.9, '$brief11', '$description11')";
  if ($db->exec($sql_product11)){
    echo "product 11 info writes into database successfully<br>";
  } else {
    echo "error in the processing of product 11 info writing into database<br>";
  }
  /* product 12 */
  $brief12 = "A wickedly funny new novel of social climbing, secret emails, art-world scandal, lovesick billionaires, and the outrageous story of what happens when Rachel Chu, engaged to marry Asia most eligible bachelor, discovers her birthfather. From the bestselling author of Crazy Rich Asians. Kevin Kwan, bestselling author of Crazy Rich Asians, is back with a wickedly funny new novel of social climbing, secret emails, art-world scandal, lovesick billionaires, and the outrageous story of what happens when Rachel Chu, engaged to marry Asia most eligible bachelor, discovers her birth father.";
  $description12 = "On the eve of her wedding to Nicholas Young, heir to one of the greatest fortunes in Asia, Rachel should be over the moon. She has a flawless Asscher-cut diamond from JAR, a wedding dress she loves more than anything found in the salons of Paris and a fiance willing to sacrifice his entire inheritance in order to marry her. But Rachel still mourns the fact that her birth father, a man she never knew, will not be able to walk her down the aisle. Until: a shocking revelation draws Rachel into a world of Shanghai splendour beyond anything she has ever imagined.

Here we meet Carlton, a Ferrari-crashing bad boy known for Prince Harry-like antics; Colette, a celebrity girlfriend chased by fevered paparazzi; and the man Rachel has spent her entire life waiting to meet: her father. Meanwhile, Singapore It Girl, Astrid Leong, is shocked to discover that there is a downside to having a newly minted tech billionaire husband. A romp through Asia most exclusive clubs, auction houses and estates, China Rich Girlfriend brings us into the elite circles of Mainland China, introducing a captivating cast of characters and offering an inside glimpse at what it is like to be gloriously, crazily, China-rich.";
  $sql_product12 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES (10000012, 'China Rich Girlfriend', 'Kevin Kwan', '2016-04-14', 3, 18.95, 1, '$brief12', '$description12')";
  if ($db->exec($sql_product12)){
    echo "product 12 info writes into database successfully<br>";
  } else {
    echo "error in the processing of product 12 info writing into database<br>";
  }

  /* product 13 */
  $brief13 = "Fans of Katie Fforde, Carole Matthews, Victoria Connelly or Erica James – and everyone who enjoyed Nick Alexander’s The French House – will love Fiona Valpy.

Five weddings. The perfect venue. One little hitch…";
  $description13 = "Leaving the grey skies of home behind to transform a crumbling French Château into a boutique wedding venue is a huge leap of faith for Sara. She and fiancé Gavin sink their life savings into the beautiful Château Bellevue – set under blue skies and surrounded by vineyards in the heart of Bordeaux.

After months of hard work, the dream starts to become a reality – until Gavin walks out halfway through their first season. Overnight, Sara is left very much alone with the prospect of losing everything.

With her own heart breaking, Sara has five weddings before the end of the season to turn the business around and rescue her dreams. With the help of the locals and a little French courage, can she save Château Bellevue before the summer is over?";
  $sql_product13 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES (10000013, 'The French for Always', 'Fiona Valpy', '2014-03-04', 4, 23.99, 0.8, '$brief13', '$description13')";
  if ($db->exec($sql_product13)){
    echo "product 13 info writes into database successfully<br>";
  } else {
    echo "error in the processing of product 13 info writing into database<br>";
  }

  /* product 14 */
  $brief14 = "Lonely Planet Japan is your passport to the most relevant, up-to-date advice on what to see and skip, and what hidden discoveries await you. Explore a bamboo grove in Arashiyama, marvel at Shinto and Buddhist architecture in Kyoto, or relax in the hot springs of Noboribetsu Onsen; all with your trusted travel companion. Get to the heart of Japan and begin your journey now! ";
  $description14 = "The Perfect Choice: Lonely Planet Japan, our most comprehensive guide to Japan, is perfect for both exploring top sights and taking roads less travelled.

About Lonely Planet: Lonely Planet is a leading travel media company and the world’s number one travel guidebook brand, providing both inspiring and trustworthy information for every kind of traveler since 1973. Over the past four decades, we’ve printed over 145 million guidebooks and grown a dedicated, passionate global community of travelers. You’ll also find our content online, and in mobile apps, video, 14 languages, nine international magazines, armchair and lifestyle books, ebooks, and more.";
  $sql_product14 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES (10000014, 'Lonely Planet Japan (Travel Guide)', 'Lonely Planet', '2017-01-08', 4, 21.75, 0.8, '$brief14', '$description14')";
  if ($db->exec($sql_product14)){
    echo "product 14 info writes into database successfully<br>";
  } else {
    echo "error in the processing of product 14 info writing into database<br>";
  }

  /* product 15 */
  $brief15 = "The utterly compelling and inspirational account of how two very different Australian writers tackle their demons walking the Camino de Santiago de Compostela, the legendary medieval pilgrimage across Spain. Two writers, barely acquainted, decide - pretty much on the spur of the moment - to seize the day and go on an 800-kilometre hike along the ancient Camino de Santiago pilgrim trail. With its history and legends of Templar Knights, Holy Grails and bandits, there is bound to be a book in it!";
  $description15 = "But what happens when two vastly different people find themselves confronting their pasts - and each other - beneath the stark glare of mid-summer heat-waves? Bound by a promise and fuelled by lashings of local vino, what might have been a travelogue soon becomes an epic tale of tragedy, triumph and fierce loyalty as a scenic walk through mystic lands gives rise to far greater personal journeys.

Set amidst the olive groves, rolling hills, castles and cathedrals of Northern Spain; and featuring a supporting cast of eccentrics - from mad monks to angry nuns, lycra-clad cyclists, international soul seekers and boisterous boy scouts - The Year We Seized the Day is the inspiring, moving and blackly funny account of two hapless pilgrims on an extraordinary journey to the end of the earth.and beyond.
";
  $sql_product15 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES (10000015, 'The Year We Seized the Day: A true story of friendship and renewal on the Camino', 'Elizabeth Best', '2010-01-01', 4, 39.86, 0.95, '$brief15', '$description15')";
  if ($db->exec($sql_product15)){
    echo "product 15 info writes into database successfully<br>";
  } else {
    echo "error in the processing of product 15 info writing into database<br>";
  }

  /* product 16 */
  $brief16 = "A secret lies buried at the heart of her family—but it can’t stay hidden forever.";
  $description16 = "When Cara stumbles across a stash of old postcards in the attic, their contents make her question everything she thought she knew.

The story she pieces together is confusing and unsettling, and appears to have been patched over with lies. But who can tell her the truth? With her father sinking into Alzheimer’s and her brother reluctant to help, it seems Cara will never find the answers to her questions. One thing is clear, though: someone knows more than they’re letting on.

Torn between loyalty to her family and dread of what she might find, Cara digs into the early years of her parents’ troubled marriage, hunting down long-lost relatives who might help unravel the mystery. But the picture that begins to emerge is not at all the one she’d expected—because as she soon discovers, lies have a habit of multiplying . . .";
  $sql_product16 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES (10000016, 'Postcards from a Stranger', 'Imogen Clark', '2018-08-23', 5, 20.81, 0.95, '$brief16', '$description16')";
  if ($db->exec($sql_product16)){
    echo "product 16 info writes into database successfully<br>";
  } else {
    echo "error in the processing of product 16 info writing into database<br>";
  }

  /* product 17 */
  $brief17 = "The first book of the New York Times, Wall Street Journal, and USA Today bestselling series! Though much of the book is light-hearted and occasionally outright hilarious, the author sneaks in a few home truths along the way that will hit you where it counts, like how even someone’s best intentions can box you in. --Everybody Needs a Little Romance";
  $description17 = "For Rose Gardner, working at the DMV on a Friday afternoon is bad even before she sees a vision of herself dead. She’s had plenty of visions, usually boring ones like someone’s toilet’s overflowed, but she’s never seen one of herself before. When her overbearing momma winds up murdered on her sofa instead, two things are certain: There is not enough hydrogen peroxide in the state of Arkansas to get that stain out, and Rose is the prime suspect.

Rose realizes she’s wasted twenty-four years of living and makes a list on the back of a Wal-Mart receipt: twenty-eight things she wants to accomplish before her vision comes true. She’s well on her way with the help of her next door neighbor Joe, who has no trouble teaching Rose the rules of drinking, but won’t help with number fifteen-- do more with a man. Joe’s new to town, but it doesn’t take a vision for Rose to realize he’s got plenty secrets of his own.

Somebody thinks Rose has something they want and they’ll do anything to get it. Her house is broken into, someone else she knows is murdered, and suddenly, dying a virgin in the Fenton County jail isn’t her biggest worry after all.";
  $sql_product17 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES (10000017, 'Twenty-Eight and a Half Wishes', 'Denise Grover Swank', '2013-12-12', 5, 23.25, 0.9, '$brief17', '$description17')";
  if ($db->exec($sql_product17)){
    echo "product 17 info writes into database successfully<br>";
  } else {
    echo "error in the processing of product 17 info writing into database<br>";
  }

  /* product 18 */
  $brief18 = "Dirty Headlines is a fantastic enemies-to-lovers office romance with a perfect, filthy as*hole hero that I wish I should written myself. - Laurelin Paige, New York Times bestselling author. ";
  $description18 = "From bestselling author L.J. Shen, comes a new standalone, enemies-to-lovers romance.

Célian Laurent.
Manhattan royalty.
Notorious playboy.
Heir to a media empire.
...And my new boss.

I could have impressed him, if not for last month unforgettable one-night stand.
I left it with more than orgasms and a pleasant memory--namely, his wallet.
Now he is staring me down like I am the dirt under his Italian loafers, and I am supposed to take it.
But the thing about being Judith Jude Humphry is I have nothing to lose.
Brooklyn girl.
Infamously quirky.
Heir to a stack of medical bills and a tattered couch.
When he looks at me from across the room, I see the glint in his eyes, and that makes us rivals.
He knows it.
So do I.
Every day in the newsroom is a battle.
Every night in his bed, war.
But it was my heart at stake, and I fear I should be raising the white flag.";
  $sql_product18 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES (10000018, 'Dirty Headlines', 'LJ Shen', '2018-04-20', 5, 24.45, 1, '$brief18', '$description18')";
  if ($db->exec($sql_product18)){
    echo "product 18 info writes into database successfully<br>";
  } else {
    echo "error in the processing of product 18 info writing into database<br>";
  }


  /* product 19 */
  $brief19 = "Why thieves now rule the world - and how to take it back. Jaw-dropping and deeply unsettling. Oliver Bullough provides a sobering and brilliant account of how piracy on an epic-scale is alive and well in the 21st century. A must-read. Simple as that. - Peter Frankopan, author of The Silk Road

From ruined towns on the edge of Siberia, to Bond-villain lairs in Knightsbridge and Manhattan, something has gone wrong with the workings of the world.";
  $description19 = "Once upon a time, if an official stole money, there was not much he could do with it. He could buy himself a new car or build himself a nice house or give it to his friends and family, but that was about it. If he kept stealing, the money would just pile up in his house until he had no rooms left to put it in, or it was eaten by mice.

And then some bankers in London had a bright idea.

Join the investigative journalist Oliver Bullough on a journey into Moneyland - the secret country of the lawless, stateless superrich.

Learn how the institutions of Europe and the United States have become money-laundering operations, undermining the foundations of Western stability. Discover the true cost of being open for business no matter how corrupt and dangerous the customer. Meet the kleptocrats. Meet their awful children. And find out how heroic activists around the world are fighting back.

This is the story of wealth and power in the 21st century. It is not too late to change it.";
  $sql_product19 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES (10000019, 'Moneyland: Why Thieves And Crooks Now Rule The World And How To Take It Back', 'Oliver Bullough', '2018-09-16', 6, 38.99, 1, '$brief19', '$description19')";
  if ($db->exec($sql_product19)){
    echo "product 19 info writes into database successfully<br>";
  } else {
    echo "error in the processing of product 19 info writing into database<br>";
  }


  /* product 20 */
  $brief20 = "It is the biggest revolution you have never heard of, and it is hiding in plain sight. Over the past decade, Silicon Valley executives like Eric Schmidt and Elon Musk, special operators like the Navy SEALs and the Green Berets, and maverick scientists like Sasha Shulgin and Amy Cuddy have turned everything we thought we knew about high performance upside down. Instead of grit, better habits, or 10,000 hours, these trailblazers have found a surprising shortcut. They are harnessing rare and controversial states of consciousness to solve critical challenges and outperform the competition. ";
  $description20 = "New York Times bestselling author Steven Kotler and high-performance expert Jamie Wheal spent four years investigating the leading edges of this revolution-from the home of SEAL Team Six to the Googleplex, the Burning Man festival, Richard Branson Necker Island, Red Bull is training center, Nike innovation team, and the United Nations headquarters. And what they learned was stunning: In their own ways, with differing languages, techniques, and applications, every one of these groups has been quietly seeking the same thing: the boost in information and inspiration that altered states provide.

Today, this revolution is spreading to the mainstream, fueling a trillion-dollar underground economy and forcing us to rethink how we can all lead richer, more productive, more satisfying lives. Driven by four accelerating forces-psychology, neurobiology, technology, and pharmacology-we are gaining access to and insights about some of the most contested and misunderstood terrain in history. Stealing Fire is a provocative examination of what is actually possible; a guidebook for anyone who wants to radically upgrade their life.";
  $sql_product20 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES (10000020, 'Stealing Fire: How Silicon Valley, the Navy SEALs, and Maverick Scientists Are Revolutionizing the Way We Live and Work', 'Steven Kotler', '2017-12-16', 6, 18.16, 1, '$brief20', '$description20')";
  if ($db->exec($sql_product20)){
    echo "product 20 info writes into database successfully<br>";
  } else {
    echo "error in the processing of product 20 info writing into database<br>";
  }


  /* product 21 */
  $brief21 = "A powerful meditation on the nature and dangers of ego, from the bestselling author of The Obstacle is the Way. It has wrecked the careers of promising young geniuses. It has evaporated great fortunes and run companies into the ground. It has made adversity unbearable and turned struggle into shame. Every great philosopher has warned against it, in our most lasting stories and countless works of art, in all culture and all ages. Its name? Ego, and it is the enemy - of ambition, of success and of resilience. ";
  $description21 = "In Ego is the Enemy, Ryan Holiday shows us how and why ego is such a powerful internal opponent to be guarded against at all stages of our careers and lives, and that we can only create our best work when we identify, acknowledge and disarm its dangers. Drawing on an array of inspiring characters and narratives from literature, philosophy and history, the book explores the nature and dangers of ego to illustrate how you can be humble in your aspirations, gracious in your success and resilient in your failures.

The result is an inspiring and timely reminder that humility and confidence are our greatest friends when confronting the challenges of a culture that tends to fan the flames of ego, a book full of themes and life lessons that will resonate, uplift and inspire.";
  $sql_product21 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES (10000021, 'Ego is the Enemy: The Fight to Master Our Greatest Opponent', 'Ryan Holiday', '2017-08-06', 6, 16.80, 1, '$brief21', '$description21')";
  if ($db->exec($sql_product21)){
    echo "product 21 info writes into database successfully<br>";
  } else {
    echo "error in the processing of product 21 info writing into database<br>";
  }


  /* product 22 */
  $brief22 = "A con artist couple. A botched scheme. Their latest double-cross could cost them their marriage… and their lives…";
  $description22 = "Even in the company of backstabbing crooks, Tom and Patty Brown can always count on each other. The husband and wife duo have built a life for themselves conning criminals and getting away scot-free. When their latest scheme to sell contaminated land to a gangster goes south, Patty worries that Tom might be losing his nerve…

After Tom senses a double-cross, he suppresses the urge to run. After all, he’d rather stand with his wife than leave himself open to the impressive list of enemies they’ve collected over the years…

As Tom and Patty fight to keep one step ahead of the jilted gangster, they narrow down their lists of suspects. By hook or by crook, they’ll make sure whoever ratted them out never crosses them again…

The Traveling Man is the first book in a series of suspenseful crime thrillers. If you like edge-of-your-seat action, shady criminal worlds, and nail-biting plot twists, then you’ll love Michael King’s dizzying whodunnit. ";
  $sql_product22 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES (10000022, 'The Traveling Man', 'Michael P. King', '2015-09-06', 7, 24.41, 1, '$brief22', '$description22')";
  if ($db->exec($sql_product22)){
    echo "product 22 info writes into database successfully<br>";
  } else {
    echo "error in the processing of product 22 info writing into database<br>";
  }


  /* product 23 */
  $brief23 = "Newly married Natasha has the perfect house, a loving husband and a beautiful little girl called Emily. She’d have it all if it wasn’t for Jen, her husband’s ex-wife who just won’t leave them alone …";
  $description23 = "Then Natasha returns home one day to find her husband and Emily gone without trace. Desperate to get her daughter back, Natasha will do anything even if it means accepting an offer of help from Jen. But can she trust her? And do either of them really know the man they married?

If you loved The Girl on the Train, Gone Girl or The Couple Next Door then this dark, twisting psychological thriller from Amazon chart bestseller Jess Ryder is guaranteed to have you gripped.
";
  $sql_product23 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES (10000023, 'The Ex-Wife: A nail biting gripping psychological thriller', 'Jess Ryder', '2016-08-06', 7, 18.95, 1, '$brief23', '$description23')";
  if ($db->exec($sql_product23)){
    echo "product 23 info writes into database successfully<br>";
  } else {
    echo "error in the processing of product 23 info writing into database<br>";
  }


  /* product 24 */
  $brief24 = "In this edge-of-your-seat thriller, author Dave Edlund brings readers face to face with the promise of energy independence... and its true cost.";
  $description24 = "As one by one the world’s leading alternative energy researchers are assassinated, Peter Savage and his friend Jim Nicolaou race against the clock to preserve the secret that promises to change the landscape of the world... or start a global war. In the timely, heart-thumping thriller Crossing Savage, author Dave Edlund presents the theory of abiogenic oil production and the terrifying array of unintended consequences that accompany the belief that energy independence can be realized.";
  $sql_product24 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES (10000024, 'Crossing Savage: A Peter Savage Novel', 'Dave Edlund', '2014-05-06', 7, 18.09, 1, '$brief24', '$description24')";
  if ($db->exec($sql_product24)){
    echo "product 24 info writes into database successfully<br>";
  } else {
    echo "error in the processing of product 24 info writing into database<br>";
  }

  /* product 25 */
  $brief25 = "The Soong Dynasty is the first full behind-the-scenes account of the extraordinary Soong family whose power and wealth dominated China and American policy towards Asia in the Twentieth Century. ";
  $description25 = "It is an extraordinary work of historical detection which traces the family’s roots from the middle of the last century and their explosive rise thereafter.

Descendants of a runaway, they grew up in America under the protection of the Methodist church and returned to their homeland to make a fortune selling Western bibles.

The Soong Family became the principal rulers of China during the first half of the Twentieth Century.

In The Soong Dynasty, Sterling Seagrave describes for the first time the intricate and fascinating rise to power of Charlie Soong and his children, whom he married to some of China’s most powerful men to create a network of power and influence which was to last for over fifty years.

It is a classic tale of power, money, corruption and greed with elements of tragedy and comedy.";
  $sql_product25 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES (10000025, 'The Soong Dynasty', 'Sterling Seagrave', '2015-05-06', 8, 45.33, 0.95, '$brief25', '$description25')";
  if ($db->exec($sql_product25)){
    echo "product 25 info writes into database successfully<br>";
  } else {
    echo "error in the processing of product 25 info writing into database<br>";
  }

  /* product 26 */
  $brief26 = "Everyone has seen photographs of the Taj Mahal. The massive, bulbous central dome, the four slender minarets, the shimmering marble, the long reflecting pool, the manicured gardens - all seem too striking for adequate description and proper appreciation. But there is more to the Taj than its beauty.";
  $description26 = "The world best-known mausoleum celebrates the love story of the seventeenth-century Moghul emperor Shah Jahan and his queen, Mumtaz Mahal. They fell in love at first sight and were married for nineteen years. She ruled at his side as almost an equal, but her death in childbirth in 1631 left him wild with grief and determined to build a monument to their devotion.

Behind this romantic tale is the saga of the Moghul emperors who swept into North India only a century earlier. By the time of Shah Jahan, they had established an absolute monarchy comparable to Louis XIVs. The Moghul court was rich, cruel, and omnipotent. As descendants of Tamerlane and Genghis Khan, they relished bloody combat, savage sports, and hideous torture of their victims. In the absence of primogeniture, brother fought brother for the throne - it was the law of the “throne or coffin.” But less than a century after Shah Jahan was deposed by his ruthless son, the dynasty was in decline and ripe for conquest by Great Britain.

For a time, it seemed like the Taj - like the Moghuls - would vanish. Only in the twentieth century was the Taj restored to something of its former glory.

Here is the dramatic and often tragic story of the Taj and the men and women of the dynasty that created it.";
  $sql_product26 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES (10000026, 'The Taj Mahal: A History', 'John David Cooper', '2014-07-04', 8, 38.95, 0.9, '$brief26', '$description26')";
  if ($db->exec($sql_product26)){
    echo "product 26 info writes into database successfully<br>";
  } else {
    echo "error in the processing of product 26 info writing into database<br>";
  }


  /* product 27 */
  $brief27 = "The association of the name James Cook with ideas of seafaring adventure and discovery is truly an indelible one. Even if you do not know the details of this extraordinary man’s life, you can probably avow that he left a unique stamp on history. ";
  $description27 = "In this book, we will explore the life of James Cook from his birth in 1728 in a humble Yorkshire village all the way to his death on the newly discovered Sandwich Islands—today known as Hawaii—in 1779. You will gain insight into the character of this famous yet markedly private man, and explore the factors that might have contributed to this tragic downfall. ";
  $sql_product27 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES (10000027, 'James Cook: A Life From Beginning to End', 'Hourly History', '2015-07-09', 8, 39.87, 0.85, '$brief27', '$description27')";
  if ($db->exec($sql_product27)){
    echo "product 27 info writes into database successfully<br>";
  } else {
    echo "error in the processing of product 27 info writing into database<br>";
  }


  /* product 28 */
  $brief28 = "Jamie Cooks Italy is a celebration of the joy of Italian food. Jamie wants to share his love of all things Italian with accessible, best-ever recipes for Classic Carbonara, Salina Chicken, Stuffed Focaccia, Baked Risotto Pie, Pot-Roasted Cauliflower and Limoncello Tiramisu. This is about bringing the pleasure and passion of the world favourite cuisine to your kitchen at home. ";
  $description28 = "Featuring 130 recipes in Jamie easy-to-follow style, the book has chapters on Antipasti, Salad, Soup, Meat, Pasta, Fish, Rice & Dumplings, Bread & Pastry, Sides, Desserts and all the Basics you need.

The recipes are a mix of fast and slow cooking, familiar classics with a Jamie twist, simple everyday dishes and more indulgent labour-of-love choices for weekends and celebrations. Whether cooking for yourself or cooking for friends and family, the aromas and tastes will transport you straight to the landscapes of Italy. Viva Italia!";
  $sql_product28 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES (10000028, 'Jamie Cooks Italy', 'Jamie Oliver', '2018-06-09', 9, 24.00, 0.9, '$brief28', '$description28')";
  if ($db->exec($sql_product28)){
    echo "product 28 info writes into database successfully<br>";
  } else {
    echo "error in the processing of product 28 info writing into database<br>";
  }

  /* product 29 */
  $brief29 = "Mouthwatering meals from healthy and portable bowl that help to quickly fuel your day, from morning to dinner.";
  $description29 = "";
  $sql_product29 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES (10000029, 'Nourishing Superfood Bowls: 75 Healthy and Delicious Gluten-Free Meals to Fuel Your Day', 'Lindsay Cotter', '2018-04-10', 9, 24.75, 0.95, '$brief29', '$description29')";
  if ($db->exec($sql_product29)){
    echo "product 29 info writes into database successfully<br>";
  } else {
    echo "error in the processing of product 29 info writing into database<br>";
  }

  /* product 30 */
  $brief30 = "Unsure of Yourself? Learn How to Develop More Confidence in Your Abilities and Achieve Your Goals";
  $description30 = "Most of us have no problems identifying goals we want to accomplish. It’s putting these plans into action that is difficult.

Sometimes we lack discipline or motivation. However, there’s another reason why you might struggle to make changes in your life – you have low self-efficacy.

What is self-efficacy? What are the main four sources of it? How can you develop more confidence in your abilities?

These are some of the questions I’ll answer in this short book. The advice you’re about to read is based both on scientific research and my personal experience. I will share fundamental knowledge that will help you build more confidence in your abilities and reach your goals.";
  $sql_product30 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES (10000030, 'Confidence: How to Overcome Your Limiting Beliefs and Achieve Your Goals', 'Martin Meadows', '2015-07-10', 9, 22.55, 0.85, '$brief30', '$description30')";
  if ($db->exec($sql_product30)){
    echo "product 30 info writes into database successfully<br>";
  } else {
    echo "error in the processing of product 30 info writing into database<br>";
  }

  /* product 31 */
  $brief31 = "American Chinese cuisine brings you a style of Chinese cuisine developed by Americans of Chinese descent who were brought over to work as railroad workers or miners during the California gold rush. The dishes served in many North American Chinese restaurants are adapted to American tastes and often differ significantly from those found in China. Of the various regional cuisines in China, Cantonese cuisine has been the most influential in the development of American Chinese food, especially that of Toisan, the origin of most early immigrants.";
  $description31 = "In American Chinese cuisine, you will discover over 50 great recipes, including:

Chicken Lettuce Wraps,
Honey Hoisen Pan-Fried Noodles,
Wonton Soup,
Chicken Mei Fun,
Crispy Honey Chicken,
General Tso Chicken,
Chinese Pineapple Chicken,
Chinese Lemon Chicken,
Mandarin Chicken,
Chop Suey,
Chow Mein,
Cashew Chicken,
Egg Foo Yung,
Kung Pao Chicken,
Orange Chicken,
Moo Goo Gai Pan,
Mongolian Beef,
Crispy Fried Beef,
Moo Shu Pork,
Sticky Chinese BBQ Pork Belly Ribs,
General Tso Tofu,
General Tso Chickpeas,
Chinese Sweet Roll,
Fortune Cookie,
Chinese Almond Cookie.

Scroll up now to grab your copy of American Chinese cuisine TODAY!";
  $sql_product31 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES (10000031, 'American Chinese Cuisine: Classic Americanized Adaptations of Chinese Recipes', 'JR Stevens', '2017-07-01', 10, 24.84, 0.95, '$brief31', '$description31')";
  if ($db->exec($sql_product31)){
    echo "product 31 info writes into database successfully<br>";
  } else {
    echo "error in the processing of product 31 info writing into database<br>";
  }

  /* product 32 */
  $brief32 = "Don’t you just love the crunchy texture and intense flavor of deep fried foods like fried chicken, French fries, breaded pork chops and calamari? It’s no wonder these items are staples, not only in fast food chains but also in the menus of many American households.";
  $description32 = "According to experts, the typical American diet is high in fat and low in nutrients. Deep frying, which is a popular cooking method in the United States and many Western countries, is pointed out as one of the reasons to blame.

So does this mean that we can no longer enjoy our deep-fried favorites? Fortunately, the answer is no.

The air fryer was designed specifically for this purpose—so that people can enjoy fried foods without the health drawbacks.

An air fryer utilizes what is called “rapid air technology” to cook food that usually requires being submerged in deep fat or oil. What the device does is circulate the air to reach up to 390 degrees F in order to fry foods like fries, chicken, chips, fish and many more.";
  $sql_product32 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES (10000032, 'The Effective Air Fryer Cookbook: The Ultimate Guide Inclusive of 150 Healthy Recipes', 'Chef Effect', '2014-09-01', 10, 27.88, 0.9, '$brief32', '$description32')";
  if ($db->exec($sql_product32)){
    echo "product 32 info writes into database successfully<br>";
  } else {
    echo "error in the processing of product 32 info writing into database<br>";
  }


  /* product 33 */
  $brief33 = "Growing up in an all-women household and coddled endlessly by his Italian mother and grandmother, Eric Lindstrom was nourished to obesity on meaty sauces, fried eggs, and butter-laden cookies. After spending the first half of his life as an adamant omnivore, Lindstrom went 100% vegan. Reluctantly. Overnight. From burgers to beets, from pork to parsnips.";
  $description33 = "It’s time for a down-to-earth book that proves anyone can go vegan (even someone who once ate sixty-eight chicken wings in a sitting). How can a man adopt a vegan approach? Won’t he die of protein deficiency? What if he is married to a vegan woman? How would he order a salad at a Minnesota steakhouse? What should he bring to a gluten-free, nut-free, macrobiotic, nightshade-free, oil-free, vegan potluck (true story)?";
  $sql_product33 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES (10000033, 'The Skeptical Vegan: My Journey from Notorious Meat Eater to Tofu-Munching Vegan—A Survival Guide', 'Eric C. Lindstrom', '2017-07-14', 10, 32.99, 0.8, '$brief33', '$description33')";
  if ($db->exec($sql_product33)){
    echo "product 33 info writes into database successfully<br>";
  } else {
    echo "error in the processing of product 33 info writing into database<br>";
  }


  /* product 34 */
  $brief34 = "#1 Kindle Bestseller in BOTH Men Adventure and War genres!";
  $description34 = "Carolyn McCray 30 PIECES OF SILVER proves that Dan Brown crown is up for grabs. Part minefield and all roller-coaster ride, here is a story as controversial as it is thriller. Hunker down for a long night because once you start this book you wo not be putting it down.";
  $sql_product34 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES (10000034, '30 Pieces of Silver: An Extremely Controversial Historical Thriller', 'Carolyn McCray', '2013-05-01', 11, 98.14, 0.70, '$brief34', '$description34')";
  if ($db->exec($sql_product34)){
    echo "product 34 info writes into database successfully<br>";
  } else {
    echo "error in the processing of product 34 info writing into database<br>";
  }


  /* product 35 */
  $brief35 = "Getting into my top choice sorority? Done.

Dating one of the hottest guys in the biggest fraternity? Done.


Failing out of College? Oops...";
  $description35 = "When Libby Gentry parents receive the letter that she has failed out of school, Libby is forced to pack her Prada bag and head to work for her great aunt in rural Louisiana.

Nothing about tiny Elsbury, Louisiana entices her until she locks eyes with the southern charmer, Blaine Crabtree.

Libby is used to getting what she wants and Blaine is no exception, but as the two grow closer, bigger problems arise.

Libby does not know how much more pain her already paper-thin heart can take and when new opportunities in Chicago pop up she is presented with a difficult situation: wait for her redneck Romeo, or move on.";
  $sql_product35 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES (10000035, 'My Paper Heart: My Paper Heart', 'Magan Vernon', '2012-06-14', 11, 6.98, 0.95, '$brief35', '$description35')";
  if ($db->exec($sql_product35)){
    echo "product 35 info writes into database successfully<br>";
  } else {
    echo "error in the processing of product 35 info writing into database<br>";
  }


  /* product 36 */
  $brief36 = "Lara Jean keeps her love letters in a hatbox her mother gave her. One for every boy she has ever loved. The letters are for her eyes only. Until the day they are mailed, and suddenly Lara Jean love life goes from imaginary to out of control.";
  $description36 = "";
  $sql_product36 = "INSERT INTO product (id, title, author, date, category, price, discount, brief, description) VALUES (10000036, 'To All the Boys I have Loved Before', 'Jenny Han', '2014-08-14', 11, 18.28, 0.75, '$brief36', '$description36')";
  if ($db->exec($sql_product36)){
    echo "product 36 info writes into database successfully<br>";
  } else {
    echo "error in the processing of product 36 info writing into database<br>";
  }

  /* review */
  $review = array(1, 36);
  $review[0] = "Excellent! Smart, witty, fun. Great read for teens and tweens. (Best summer read or beach book.)";
  $review[1] = "i 100% recommend this book.
loved the writing and your pictures .
And was extremely amazed that you are really are the perfect role model for me.
And thank you for spending so much time on this book.
To answer almost every one of our questions and finding the cutest pictures ever.
love you";
  $review[2] = "this book inspires me so much and i love the quizzes, fun diys, hair and makeup hacks, and of course the pictures at the end.
#JENZIE";
  $review[3] = "This book is so inspirational and includes advice on everything! I recommend this brilliant book by the outstanding singer, actress, dancer, model and author to all tween and teen girls.";
  $review[4] = "This book is inspirational and a good laugh to boot! It shows the intense life of three morons and their emotional struggle to survive. The main character is Ed, who drives a cab around Sydney with little aspiration be become anything better, due in part to his upbringing. A series of events cause him to become a messenger which inturn causes lots of puzzles and disruptions in his life and those of his friends. I especially love Ed''s best friend ''Doorman'' who adds to this hilarious story. Support from your friends and family is so important in anyone''s life and can empower you especially when your problems seem unsolvable. ENJOY THIS GREAT READ!";
  $review[5] = "Have read this several times now (with several years between each read). It''s so unique and enthralling and relatable. I can''t explain how I felt while reading this book, but very few other books have made me feel the same. Would be a good read for anyone who likes to read stories that have multiple levels of depth to it (i.e. if you chose to ignore the deep, more serious parts of the book, it''s still an enjoyable read, but you would be missing out on some very thought-provoking ideas)";
  $review[6] = "A young man is witness to a bank robbery and his life changes in unexpected ways. We meet a number of characters with no apparent link to each other but bit by bit we see a grand design bringing them closer. It is hard to say much without giving away the plot.
It is an excellent book which I found compelling. Really unique plot and well written. My heart went out to some characters. thers needed a good talking to!
i really recommend this book. It would be fun to discuss it with friens too.";
  $review[7] = "For me I found this book and game changer. It inspired me to take a leap of faith and tell someone how wonderful I really think they are. It gave me the courage to face a tough time in my marriage. It showed me that no matter how insignifcant you may feel inside by doing small things you can make a difference in your life and a positive difference in someone else''s. I loved the book and couldn''t put it down. It came at a really good time in my life.";
  $review[8] = "An enjoyable book to read. Even though most of the ''messages'' were for a good cause, the situations and their solutions were a bit unreal. The overall impression and message to the reader at the end of the book however are worthwhile.";
  $review[9] = "An easy book to read but always has you guessing what is going to happen next. Definitely recommend this book";
  $review[10] = "Reynolds inspires the reader to take a risk and try something one has never done before, in order to discover new things about oneself. THE DOT gives a big hug to budding artists and shows how to encourage others. My favorite line is, ''Vashti even made a dot by NOT painting a dot.'' This sentence gave opportunity to discuss various ways to make a dot, opening up the imagination of young minds. I have to say, it took some time to turn the page because everyone wanted to be heard. I love books that help children see possibilities in their own talents.";
  $review[11] = "A must read for my kinders at the beginning of the year! Vashti learns that he can do anything if he never gives up. Vashti then learns to encourage others the same way his teacher encouraged him. Many year long references to never give up can be made after reading this book.";
  $review[12] = "I loved the movie so much, I had to read the book. It did not disappoint! It is written in such a way that one lives it with the characters. Even knowing the story, I still re-experienced it in that way, and the emotional journey was the same. Characters you really care about!";
  $review[13] = "A thoroughly great ''read''. One Dy is London of the 80s 90s and this new century. It is a light hearted laugh at the phoney world of the twenty and thirty somethings of this generation and yet there are moments of tenderness that are a ju";
  $review[14] = "I am a re-reader and Blue Smoke is like chicken soup for me in the best possible way 😄";
  $review[15] = "Excellent story line which made me want to research the background";
  $review[16] = "Couldn’t get into this book found it boring. Only read a few chapters might give it a go ata later date.";
  $review[17] = "Thoroughly enjoyed reading this book. I couldn''t put this book down. Very easy reading.";
  $review[18] = "What an absolute breath of fresh air. I loved the characters in this book, particularly Eleanor and Raymond. It was beautifully written and had you teary one minute, then the next chuckling or straight out laughing out loud. I loved Eleanor’s very correct way of speaking, how proper her language was...you could almost imagine her speaking to you and being very entertained. I would love a sequel, I know, a bit boring, but I would enjoy seeing her make a life with Raymond. I was hoping till the end that would happen. Funny isn’t it, how absorbed you get in characters from a book and want a happy life ending for fictitious people? That’s the joy of getting lost in rich characters.";
  $review[19] = "The book was unlike anything I usually read - being a murder mystery fan usually but I saw the reviews and thought why not. I can honestly say It''s one of the best books I have ever read. I saw bits of Eleanor in myself and other people I know. It was so easy to read and so hard to out aside to do other things that needed doing. Highly recommended";
  $review[20] = "Eleanor is a triumph. A damaged, broken person who ever so slowly blooms without you realising what you''re a witness to. It feels privileged to be a part of. An honour, dusted with both heartache and out loud hilarity. The emotional insights are sharp, acute and accurate. A painful, joyous must read.";
  $review[21] = "Not perfect,not precious literature, but what a story! At first we snigger at this eccentric misfit.Whats with her- ;Asperger''s? Then we learn about the lonely weekends sustained only by alcohol. And as the layers are slowly peeled away we realize she knows only violence,cruelty and indifference and is deeply traumatized.She''s slowly and painfully rescued by someone she initially disrespects and virtually ignores, but who is aided by his family. And although Eleanor still doesn''t realize it even at the end of the book, we are aware that her rescue is no accident, and sometimes must have been a thankless task, but is eventually rewarded. This is a story about the power of the best kind of love: Caring. .
";
  $review[22] = "I was looking for a summer holiday read recently and came across this book. Read the reviews and purchased it, I was hooked from the first page and devoured it!. A wonderful well written read book.
Detached, likeable, quirky and honest would best describe Eleanor. This book resonates with you well after you have finished it, as the reader comes to love Eleanor and it is difficult to let go and say goodbye to such a wonderful story & character. Well done to Gail Honeyman on her debut book & I shall certainly be looking for her next publications.Highly recommended.";
  $review[23] = "This is a must read book. I was cautious to start given all the raving reviews but this book is divine. Eleanor is the character of this year that you won’t be able to stop thinking about- she’s honest, real and I’m sure everyone will relate to parts of her. Get ready to laugh and cry in this beautiful read.";
  $review[24] = "There were so many amazing scenes in this book. Scenes that left you gasping, and hoping and pleading. Scenes that made you cry, with sadness, and some with happiness. The range of emotions I experienced while reading this book was almost unfathomable, and Laini Taylor did that.";
  $review[25] = "I enjoyed the journey through this great novel. The author takes you through his perspective of an amazing historic image. That world, to my simple understanding, remained so steady and constant for many centuries. Post Reformation and Enlightenment things changed so dramatically.
My first attempt at this book was in the Dark Ages before the Internet. This time, even with online resources the historic and multilingual references were almost impenetrable. I need to find a good companion guide next time I pick this book up.";
  $review[26] = "I really did enjoy this book, for it characterisation, plot and view into the lives of mediaeval monks. However, I found the politics surrounding the story hard to follow and the use of Latin without translation alienated me from the text.";
  $review[27] = "I''m very tired and very exhausted by this book. But it was also very good.
The nutshell is this is a murder mystery set in a fourteenth century Benedictine abbey, with Franciscan monk William of Baskerville and his Benedictine novice Adso of Melk on the case. And it''s genuinely fun! A Holmesian romp set in medieval paranoia. But everything in this book is a conceit; the entire abbey vibrates with a deconstructive menace. Behind the beautifully described murals, the rich and perversely interesting history of the persecution of mendicant monks, and even the trappings of a wicked murder plot, there is a nagging metafiction suggestion that what you see is wrong, and darkness is inevitable.";
  $review[28] = "The mystery and the setting are intriguing. Much of the story, however, is weighed down by long, rambling, unnecessary descriptions and expositions. At first, some of them are interesting, but this book is nearly 600 pages long. It would have been much better if it were 350 pages. Instead of describing four or five items (like images on a church door or sacred relics) that give the reader a complete idea, the writer routinely literally describes 25-30 items, sometimes in long lists! The same occurs with historical details. What could effectively be said with precision becomes confusing, boring, and tedious because the writer is so circumlocutory.";
  $review[29] = "I love this book, much as I love the movie it inspired, mostly for the world it so vividly recreates: a 14th-century monastery in the mountains of northern Italy, populated by monks, peasants – and an apparent serial killer. Although this medieval community is a great place to visit in a book, you probably wouldn’t want to live there. Not unless you enjoy fetching water from wells, laboring from dawn to dusk, and adhering to the strict lifestyle of a monk.";
  $review[30] = "I have enjoyed reading Less more than most books I have read this year. It has a charm and quirky humour and satisfying wit that is surprisingly uplifting ...it is a gay man''s story but I do not think you need to be gay to enjoy it, though I guess it adds a delicious dimension if you are. It is romantic and whimsical at times but self deprecating at others, and quietly incisive in its observations of relationships, ageing, work, and travel. My tip...don''t miss it!";
  $review[31] = "What a surprising delight!
I loved this novel, I loved Less with all his eccentricities and vanities, but more than that I enjoyed Greer’s writing, his beautiful and original similes, the wonderful evocation of place, the sudden surprise of laughter at odd moments and the poignancy that left me smiling with unshed tears. Worth reading aloud just to share the joy!";
  $review[32] = "This story got better as it went, with new layers of meaning adding depth to something that seemed light and pithy to begin with. I loved the suggestion of Deus ex machina (I think that’s what I mean!) as the protagonist’s own novel seems to follow the same path as the story I am reading, like a window into the making of the novel within the novel.";
  $review[33] = "I loved the language used. I also loved the way the author revealed Arthur Less''s character - in the beginning, he wasn''t particularly likeable, but I became quite fond of him as the novel progressed. I would highly recommend this book.";
  $review[34] = "Less is a book that grows on you & Arthur Less is an unique character who has been in my thoughts days after finishing the book.";
  $review[35] = "Sweet, beguiling, witty and beautifully written. A tale of self discovery as two men veer toward love. Read it soon!";
  for ($i=0; $i<36;$i++){
    $id = 10000001 + $i;
    $productid = 10000001 + $i;
    $uerid = 10000002 - $i%2;
    $star = $i%5+1;
    $sql_review = "INSERT INTO review (id, userid, productid, star, comment) VALUES ($id, $uerid, $productid, $star, '$review[$i]')";
    if ($db->exec($sql_review)){
      echo "review $i info writes into database successfully<br>";
    } else {
      echo "error in the processing of review $i info writing into database<br>";
    }
  }





// Close database
  $db->close();

?>
