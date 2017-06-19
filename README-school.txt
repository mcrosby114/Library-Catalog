******************************
* Undergrad Database Project *
* COMPSCI 410                *
* May 5, 2016                *
* Matthew Crosby             *
******************************

KEY FILES:

 * README.txt - This file
 * Crosby_ModelDiagram_LibrarySystem_Toad.pdf - PDF file showing the data model diagram of the final database design
 * Library.SQL - The DDL to construct the Library database and associated tables/triggers
 * Populate.SQL - The load script to populate these tables: "Borrowers", "Library_Branches", "Publishers"
 * (numerous PHP & CSS files) - These are the code files used to generate a website interface and provide requisite functionality


 LAUNCHING WEBSITE INTERFACE:

 * The user interface for this system is basically a website that is constructed via PHP files. Therefore, in order to 
  run the website on a browser, we require using a server (e.g., Apache). At Boise State, there is a service called 
  'webdev' that uses an Apache server to target my public_html folder inside my student directory ("mcrosby") on Onyx.

 * In order to work with webdev (which is only accessible within the Onyx network), you will need to be on campus.

 * Once you are signed in to Onyx, open a browser and navigate to this URL: http://webdev/~mcrosby/index.php

 * This should reveal the homepage for my website.


 COMMENTS:

 This was a great exercise in understanding how to work with a basic database system. It was slow and confusing 
 to get started (with Toad especially), but now that I know exactly how the tools work, I'm confident I could repeat
 a similar project down the road in a fraction of the time.

 My favorite part of the project was taking on an extra challenge with figuring out how to display an "intelligent" 
 set of options for the user when the goal is to select books available to be checked out. When a user wants to find out 
 which books he/she may check out, it's better to show only books that are actually available (i.e., ruling out books if the 
 number of active loans equals the number of copies for each branch -- i.e., the situation where all copies of a given 
 book at a branch have been checked out). It was very tricky to figure out how to get this to work, since it involves 
 several layers of checks and comparisons: 
 	(1) Get all records of # of copies of a book across all branches;
 	(2) For each record, get all records of loans for this branch;
 	(3) Count the number of active loans for this book at this branch; 
 	(4) Count the total copies this branch would have if nothing were checked out;
 	(5) Subtract active loans from copies
 	(6) If the result is not 0, then display this book, its branch, and the remaining copies in stock 

 The most frustrating parts of this assignment had to do with connectivity and setup issues. There were hours of trial 
 and error required to get everything set up and communicating correctly before even getting to writing code
 (but that's part of the fun I suppose!). 

 As far as the logical aspect of the database, it was tricky to figure out how to design the "Add a new Book" and 
 "Check out a book" functionality, especially given the dependencies that have to be accounted for in other tables.
 For example, how to deal with duplicate Book entries and duplicate Book_Copy entries, or how to present the user with 
 options for picking a book, a branch that it goes to, and the number of copies for that branch, while preventing 
 the data from being corrupted in some way.
 
 I also spent a considerable amount of time updating the DDL file, and the TOAD model back and forth between TOAD and 
 MySQL. There are numerous compatibility issues between these programs -- I couldn't get the DDL for trigger written 
 with delimiters to be accepted by TOAD, for example. As you can see in the final model, each table has auditing 
 attributes for row insertion and update, and each table's primary and foreign keys are indexed. In the DDL script, 
 you can see the use of triggers for each table as well.


