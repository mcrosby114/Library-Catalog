-- ﻿/*
-- Created: 3/29/15
-- Modified: 5/5/16
-- Project: CS 410 Undergrad Project
-- Model: Library_System
-- Company: BSU
-- Author: Mike Lynott, Matthew Crosby
-- Database: MySQL 5.5
-- */




-- Create databases section -------------------------------------------------
DROP DATABASE IF EXISTS Library;
CREATE DATABASE Library
;
USE Library;

-- Create tables section -------------------------------------------------

-- Table Book

CREATE TABLE Book
(
  BookId Bigint NOT NULL AUTO_INCREMENT,
  AuthorName Varchar(50),
  Title Varchar(100),
  PubId Bigint(20) NOT NULL,
  CreateUID Varchar(50),
  CreateTime Datetime,
  UpdateUID Varchar(50),
  UpdateTime Datetime,
  PRIMARY KEY (BookId),
 INDEX IX_book1 (BookId)
)
;

CREATE INDEX IX_published_by_publisher_of ON Book (PubId)
;

-- Triggers for Book

DELIMITER //
CREATE TRIGGER `Library`.`Book_BEFORE_INSERT` BEFORE INSERT ON `Book` FOR EACH ROW
BEGIN
  SET NEW.CreateUID = USER();
  SET NEW.CreateTime = NOW();
  SET NEW.UpdateUID = USER();
  SET NEW.UpdateTime = NOW();
END;//
DELIMITER ;

DELIMITER //
CREATE TRIGGER `Library`.`Book_BEFORE_UPDATE` BEFORE UPDATE ON `Book` FOR EACH ROW
BEGIN
  SET NEW.UpdateUID = USER();
  SET NEW.UpdateTime = NOW();
END;//
DELIMITER ;

-- Table Publisher

CREATE TABLE Publisher
(
  PubId Bigint(20) NOT NULL AUTO_INCREMENT,
  PubName Varchar(50) NOT NULL,
  Address Varchar(100),
  Phone Varchar(15),
  CreateUID Varchar(50),
  CreateTime Datetime,
  UpdateUID Varchar(50),
  UpdateTime Datetime,
  PRIMARY KEY (PubId),
 INDEX IX_publisher_1 (PubId)
)
;

ALTER TABLE Publisher ADD UNIQUE PubName (PubName)
;

-- Triggers for Publisher

DELIMITER //
CREATE TRIGGER `Library`.`Publisher_BEFORE_INSERT` BEFORE INSERT ON `Publisher` FOR EACH ROW
BEGIN
  SET NEW.CreateUID = USER();
  SET NEW.CreateTime = NOW();
  SET NEW.UpdateUID = USER();
  SET NEW.UpdateTime = NOW();
END;//
DELIMITER ;

DELIMITER //
CREATE TRIGGER `Library`.`Publisher_BEFORE_UPDATE` BEFORE UPDATE ON `Publisher` FOR EACH ROW
BEGIN
  SET NEW.UpdateUID = USER();
  SET NEW.UpdateTime = NOW();
END;//
DELIMITER ;

-- Table Library_Branch

CREATE TABLE Library_Branch
(
  BranchId Bigint NOT NULL AUTO_INCREMENT,
  BranchName Varchar(50),
  CreateUID Varchar(50),
  CreateTime Datetime,
  UpdateUID Varchar(50),
  UpdateTime Datetime,
  PRIMARY KEY (BranchId),
 INDEX IX_library_branch1 (BranchId)
)
;

-- Triggers for Library_Branch

DELIMITER //
CREATE TRIGGER `Library`.`Library_Branch_BEFORE_INSERT` BEFORE INSERT ON `Library_Branch` FOR EACH ROW
BEGIN
  SET NEW.CreateUID = USER();
  SET NEW.CreateTime = NOW();
  SET NEW.UpdateUID = USER();
  SET NEW.UpdateTime = NOW();
END;//
DELIMITER ;

DELIMITER //
CREATE TRIGGER `Library`.`Library_Branch_BEFORE_UPDATE` BEFORE UPDATE ON `Library_Branch` FOR EACH ROW
BEGIN
  SET NEW.UpdateUID = USER();
  SET NEW.UpdateTime = NOW();
END;//
DELIMITER ;

-- Table Borrower

CREATE TABLE Borrower
(
  CardNo Bigint NOT NULL AUTO_INCREMENT,
  Name Varchar(50),
  Address Varchar(100),
  Phone Varchar(15),
  CreateUID Varchar(50),
  CreateTime Datetime,
  UpdateUID Varchar(50),
  UpdateTime Datetime,
  PRIMARY KEY (CardNo),
 INDEX IX_borrower1 (CardNo)
)
;

-- Triggers for Borrower

DELIMITER //
CREATE TRIGGER `Library`.`Borrower_BEFORE_INSERT` BEFORE INSERT ON `Borrower` FOR EACH ROW
BEGIN
  SET NEW.CreateUID = USER();
  SET NEW.CreateTime = NOW();
  SET NEW.UpdateUID = USER();
  SET NEW.UpdateTime = NOW();
END;//
DELIMITER ;

DELIMITER //
CREATE TRIGGER `Library`.`Borrower_BEFORE_UPDATE` BEFORE UPDATE ON `Borrower` FOR EACH ROW
BEGIN
  SET NEW.UpdateUID = USER();
  SET NEW.UpdateTime = NOW();
END;//
DELIMITER ;

-- Table Book_Copies

CREATE TABLE Book_Copies
(
  BookCopyId Bigint(20) NOT NULL AUTO_INCREMENT,
  NoOfCopies Smallint,
  BookId Bigint NOT NULL,
  BranchId Bigint NOT NULL,
  CreateUID Varchar(50),
  CreateTime Datetime,
  UpdateUID Varchar(50),
  UpdateTime Datetime,
  PRIMARY KEY (BookCopyId),
 INDEX IX_book_copies1 (BookCopyId)
)
;

CREATE INDEX IX_held_at_site_for ON Book_Copies (BranchId)
;

CREATE INDEX IX_of_printed_as ON Book_Copies (BookId)
;

-- Triggers for Book_Copies

DELIMITER //
CREATE TRIGGER `Library`.`Book_Copies_BEFORE_INSERT` BEFORE INSERT ON `Book_Copies` FOR EACH ROW
BEGIN
  SET NEW.CreateUID = USER();
  SET NEW.CreateTime = NOW();
  SET NEW.UpdateUID = USER();
  SET NEW.UpdateTime = NOW();
END;//
DELIMITER ;

DELIMITER //
CREATE TRIGGER `Library`.`Book_Copies_BEFORE_UPDATE` BEFORE UPDATE ON `Book_Copies` FOR EACH ROW
BEGIN
  SET NEW.UpdateUID = USER();
  SET NEW.UpdateTime = NOW();
END;//
DELIMITER ;

-- Table Book_Loans

CREATE TABLE Book_Loans
(
  BookLoanId Bigint NOT NULL AUTO_INCREMENT,
  DateOut Date,
  DueDate Date,
  ReturnedDate Date,
  BranchId Bigint NOT NULL,
  BookId Bigint NOT NULL,
  CardNo Bigint NOT NULL,
  CreateUID Varchar(50),
  CreateTime Datetime,
  UpdateUID Varchar(50),
  UpdateTime Datetime,
  PRIMARY KEY (BookLoanId),
 INDEX IX_book_loans1 (BookLoanId)
)
;

CREATE INDEX IX_from_site_for ON Book_Loans (BranchId)
;

CREATE INDEX IX_of_borrowed_in ON Book_Loans (BookId)
;

CREATE INDEX IX_by_borrower_in ON Book_Loans (CardNo)
;

-- Triggers for Book_Loans

DELIMITER //
CREATE TRIGGER `Library`.`Book_Loans_BEFORE_INSERT` BEFORE INSERT ON `Book_Loans` FOR EACH ROW
BEGIN
  SET NEW.CreateUID = USER();
  SET NEW.CreateTime = NOW();
  SET NEW.UpdateUID = USER();
  SET NEW.UpdateTime = NOW();
END;//
DELIMITER ;

DELIMITER //
CREATE TRIGGER `Library`.`Book_Loans_BEFORE_UPDATE` BEFORE UPDATE ON `Book_Loans` FOR EACH ROW
BEGIN
  SET NEW.UpdateUID = USER();
  SET NEW.UpdateTime = NOW();
END;//
DELIMITER ;

-- Create relationships section ------------------------------------------------- 

ALTER TABLE Book_Copies ADD CONSTRAINT of_printed_as FOREIGN KEY (BookId) REFERENCES Book (BookId) ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE Book_Copies ADD CONSTRAINT held_at_site_for FOREIGN KEY (BranchId) REFERENCES Library_Branch (BranchId) ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE Book_Loans ADD CONSTRAINT from_site_for FOREIGN KEY (BranchId) REFERENCES Library_Branch (BranchId) ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE Book_Loans ADD CONSTRAINT of_borrowed_in FOREIGN KEY (BookId) REFERENCES Book (BookId) ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE Book_Loans ADD CONSTRAINT by_borrower_in FOREIGN KEY (CardNo) REFERENCES Borrower (CardNo) ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE Book ADD CONSTRAINT published_by_publisher_of FOREIGN KEY (PubId) REFERENCES Publisher (PubId) ON DELETE RESTRICT ON UPDATE RESTRICT
;



