SELECT * FROM room rm)
INNER JOIN reservation res ON  rm.RoomID = res.RoomID
WHERE (res.FirstNight BETWEEN "2014-06-30" AND "2014-07-01") OR (res.LastNIght BETWEEN "2014-06-30" AND "2014-07-01");

-- this is the one -------------------------------------------------------------
-- -----------------------------------------------------------------------------
SELECT COUNT(RoomID) AS "Number Of Available Rooms" FROM room WHERE RoomID NOT IN(SELECT RoomID FROM reservation
WHERE (FirstNight BETWEEN '2014-07-01' AND '2014-07-02') OR (LastNIght BETWEEN '2014-07-01' AND '2014-07-02'));
-- ------------------------------------------------------------------------------
-- ------------------------------------------------------------------------------

SELECT udf_getRoomAvailabilty('2014-07-01', '2014-07-02')






SELECT * FROM reservation
WHERE (FirstNight BETWEEN "2014-07-01" AND "2014-07-01") OR (LastNIght BETWEEN "2014-07-01" AND "2014-07-01");

SELECT * FROM reservation
WHERE (FirstNight BETWEEN 2014-06-30 AND 2014-07-01) 
OR (FirstNight = 2014-06-30)
OR (LastNight = 2014-07-01)
OR (LastNIght BETWEEN 2014-06-30 AND 2014-07-01)
 
SELECT * FROM reservation
WHERE FirstNight = "2014-06-30"
OR (LastNight = 2014-07-01)

SELECT * FROM room rm
INNER JOIN reservation res ON  rm.RoomID = res.RoomID
WHERE LastNight NOT BETWEEN "2014-06-30" AND "2014-07-01";

SELECT * FROM reservation
