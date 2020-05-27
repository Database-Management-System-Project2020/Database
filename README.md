"# Database" 
in this readme file we are gonna talk about

1-the purpose of each file

2-the order in which we will fill the tables

\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_

1- connection.php

Contains connection class which has

- Connect function:establish the connection between sql server and database, this function requires inserting data about database name($dbname), server name ($servername) and user name($username).
- Get\_conn function:returns a connection variable $GLOBALS[&quot;conn&quot;] which prepares the sql statement for execution.
- Close\_conn function: close the connection.

2- books.php

Contains many functions related to the books table

To insert values you should make an object of the class and pass the values you want to insert,

Because the insert function is in the class constructor.

each &quot; **get\_..&quot;** function takes a barcode as argument except the get\_barcode function: takes $brand\_name, $educational\_stage, $subject, $product\_description as arguments.

each &quot; **update\_..**&quot; function takes 2 arguments:

1. Barcode of the item that is wanted to be updated.
2. The new values which are wanted to update the old ones

Delete function (delete\_book\_record)assumes that you have enabled cascade delete mode using the on\_delete\_cascade\_books function

set\_employee\_ID function takes the &quot;id&quot; of the employee who is logged in and uses the program, this function should be used or called in the logging in process.

delete\_employee\_ID function takes the &quot;id&quot; of the employee who is logged out and finished using the program.

**Note !**

The sameting with set\_employee\_ID and delete\_employee\_ID functions in product , images and tools classes

employee\_idemployee entry in product

3-images\_class.php

Contains many functions related to images table such as

1. Insert\_image: takes the file in which you want to store the image as argument.
2. On\_delete\_cascade\_images: enables cascade delete mode in images table

4-employee.php

Contains many functions related to images table

it does not matter.

**Note !**

You don&#39;t need to call connect, and close\_conn functions in each function (insert, update, etc), you can delete them. If you have already established the connection.

We call it to just test each function separately .

\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_

To start dealing with these 3 tables (books, images, employee) you have to fill these tables in this order

1. stock &amp; employee\_type
2. employee
3. product
4. books &amp; images

For the employee\_idemployee entry in product

It should be inserted using calling

table and id\_emp entry in books, tools and images tables
