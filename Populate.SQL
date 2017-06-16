USE LIBRARY;

-- Populate Borrowers table
INSERT INTO Borrower (Name, Address, Phone) VALUES
('Harry Bosch', '1385 N. Hollywood Ave., Los Angeles, CA, ', '818-850-9976'),
('Matthew Crosby', '309 S. Virginia Ave., Burbank, CA', '818-773-9875'),
('Oliver McGee', '919 Columbia Blvd., New York, NY', '909-284-2859'),
('Wallace Harrington', '1593 E. Siberia St., Hanover, NH', '848-984-1254')
;

-- Populate Library_Branches table
INSERT INTO Library_Branch (BranchName) VALUES
('New Amsterdam Library'),
('Chatham Square Library'),
('Jefferson Market Library'),
('Mulberry Street Library')
;

-- Populate Publishers table
INSERT INTO Publisher (PubName, Address, Phone) VALUES
('Penguin Random House', '1077 Ave of the Americas, New York, NY', '646-443-3520'),
('Houghton Mifflin Harcourt', '215 Park Ave S, New York, NY', '212-420-5800'),
('Oxford University Press', '198 Madison Ave, New York, NY', '800-445-9714'),
('Wiley', 'One Montgomery Street, San Francisco, CA', '415-433-1740')
;