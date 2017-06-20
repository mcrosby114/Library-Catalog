# Library Database Design website

## Description:
A web interface for tracking books and borrowers in a library system. Featuring a custom database model, DDL, PHP application middleware, HTML/CSS user interface.

##### (https://mcrosby114.github.io/Library-Catalog/)
##### (https://github.com/mcrosby114/Library-Catalog/)

##Description
A web interface for tracking books and borrowers in a library system. Featuring custom database model and DDL, PHP scripting, HTML/CSS user interface.

##Highlights:
* Designed database DDL from logical data model
* Triggers for insert/update on Book, Book Copy, Publisher, Library Branch, Borrower, Book Loan
* Constraints on foreign and primary keys
* Indices on foreign and primary keys
* Tables auto populate with auditing attributes (UID, date/time when row inserted, last updated)
* Error handling (application and database)

## Functionality:
* Add new book, and put each copy in a library branch
* Find a book, and display its details
* Check out a book to an existing borrower
* Return a checked out book
* Display borrowers and account details
