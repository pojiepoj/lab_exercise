# lab_exercise
 slab exercise

http url
http://128.199.102.121/keystore

API Name
- {url}/keystore 
POST method to insert new keys and values passing Json.
After Insert it will return the key, value and timestamp that was instered.
If key doesnt exist it will insert new data. If key exist it will update existing value and timestamp.
If no Json was pass, it will auto generate a new key.

- {url}/keystore/{key}
GET method, will retrieve the value and timestamp of what time the value was inserted.

- {url}/keystore/get_all_records
GET method, will retrieve ALL keys and their values

- {url}/keystore/{key}?timestamp={timestampvalue}
GET method, will retrieve corresponding value of the key during that designated timestamp.

Unit Testing
- PHPUnit is installed when executing the command composer install
- To execute the PHPUnit run {project path}.\vendor\bin\phpunit in the command line.

** Note **
Import the database structure and update the database connection found in src/Config/DatabaseConnector.php