INSERT INTO reservation(FirstName, LastName) VALUES('Ted', null);

SELECT * FROM reservation;

SELECT * FROM room;

DELETE FROM reservation WHERE ReservationID > 40;

CALL usp_submitReservation('Mike', 'Smith', 'NA', '2014-09-29', '2014-09-30', '1', '2', 'Bla Bla', '289-990-7873', 'michael_t53@hotmail.com', @ReservationID);
SELECT @ReservationID


