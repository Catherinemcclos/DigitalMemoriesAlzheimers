-- when you put this into a stored proc, you would pass a date (probably the first of 
-- the desired month, but it doesn't have to be), and stored proc would create the  
-- following dates based on the date supplied. In the example below, I used GETDATE() 
-- with returns the current date.
declare	@startDate DATE = DATEADD(month, DATEDIFF(month, 0, GETDATE()), 0);
declare @endDate   DATE = DATEADD(DAY,-1,DATEADD(month, DATEDIFF(month, 0, @startDate)+1, 0))   -- the end of the date range

select @startDate, @endDate

SET NOCOUNT ON;
-- sanity checks
if (@endDate = '1900-1-1')
BEGIN
	SET @endDate = CAST(GETDATE() AS DATE);
END
if (@startDate = '1900-1-1')
BEGIN
	SET @startDate = DATEADD(YEAR, -5, @endDate);
END
IF (@startDate > @endDate)
BEGIN
	DECLARE @temp date = @startDate;
	SET @startDate = @endDate;
	SET @endDate = @temp;
END

-- Get calendar data for every day in the date range . We should have one day for every 
-- day between and including the specified date range dates.     
;WITH n AS 
(
    SELECT TOP (DATEDIFF(DAY, @startDate, @endDate) + 1) n = ROW_NUMBER() OVER (ORDER BY [object_id]) 
    FROM sys.all_objects
)
SELECT DATEADD(DAY, n-1, @startDate) AS CalendarDate
       ,DATEPART(YEAR, DATEADD(DAY, n-1, @startDate)) AS CalendarYear
       ,DATEPART(MONTH, DATEADD(DAY, n-1, @startDate)) AS CalendarMonth
       ,DATEPART(WEEKDAY, DATEADD(DAY, n-1, @startDate)) AS WeekDayNumber
       ,DATENAME(WEEKDAY, DATEADD(DAY, n-1, @startDate)) AS WeekDayName
       ,DATENAME(MONTH, DATEADD(DAY, n-1, @startDate)) AS [MonthName]
       ,DATEPART(DAY, DATEADD(DAY, n-1, @startDate)) AS [DayOfMonth]
FROM n