### Project ReadMe

Run the already created database migrations using 'php artisan migrate'.

I used mysql database in the laravel project

## importing the database into mysql:

Note: You might have to configure mysql to allow uploading files to it.

I used the following command to populate the database in mysql.

LOAD DATA INFILE 'C:\\ProgramData\\MySQL\\MySQL Server 8.0\\Uploads\\Tennis_Rankings_2019.csv'
INTO TABLE rankings
FIELDS TERMINATED BY ',' ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(date, gender, type, ranking, player, country, age, @points, tournaments)
SET points = replace(@points, ',' ,''),
created_at = CURRENT_TIMESTAMP,
updated_at = CURRENT_TIMESTAMP

## Checklist

### Back-end:

#### Basic

-   create a migration (to create a table in DB) ✓
-   import `Tennis_Rankings_2019.csv` into the database ✓
-   create CRUD APIs for front-end to consume ✓

#### Bonus

-   request validation ✓
-   search/filter APIs ✓
-   handle records order (ascending/descending) ✓
-   pagination ✓

### Front-end:

#### Basic

-   create a datatable ✓
-   integrate with the API ✓
-   CRUD records ✓

#### Bonus

-   pretty UI/UX design Maybe
-   form validation ✓
-   pagination ✓
-   search/filter Note: The maximum supported year is 2029, Sorted by date initially. I used ranges to filter number fields and didn't have enough time to show error messages but it does validate. The default ages, rankings... are filtered to only show ranges from 1..100 but you can change that. The search filter is always active.
-   infinite scroll table ✓
-   responsive design ✓

## Project details

Hosted on elastic beanstalk
