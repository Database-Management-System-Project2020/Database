"# Database"
********************** table pages**************
Insert page_url into pages

function: pages::setPage_url('page_url');

idpages auto increment 

--input: page_url
************

getting page_url

function: echo pages:: getPage_url('1');

--input : idpages

--output:  page_url
*************

update pages' page_url

function: pages:: updatePages(1,'');

--input: idpages & page_url
**************
get idpages

function: echo pages:: getID('abcd');

--input: page_url

--output: idpages
****************
delete pages' data

function:  pages:: delete()

--input: idpages


********************** table employee_type******************

insert type into employee_type

function: employee_type::setType('accountant');

--input: type
****************
getting type

function:   echo employee_type::getType(1);

--input: idemployee_type

--output: type
**********************

delete employee_type data

function :  employee_type::deleteType();

--input: idemployee_type
***************

update data

function:  employee_type::updateType(  ,  );

--input: idemployee_type , new type
*************************



******************table employee_type_has_pages*****************

join between pages&pages_has_employee_type

getting page_url

function; echo employee_type_has_pages:: getpage_url(3);

--input: idEmployee

--output: page_url


*************
join between employee_type&pages_has_employee_type

getting type

function; echo employee_type_has_pages:: gettype(3);

--input: idEmployee

--output: type
*************

setting ids in table

function;  employee_type_has_pages:: setID('2', '2');

--input: pages_idpages ,employee_type_idemployee_type
***************
delete data

employee_type_has_pages:: deteleIdemployeetype('1');
--input:employee_type_idemployee_type

employee_type_has_pages::deteleIdpages('1');
--input:pages_idpages


******************
employee_type_has_pages:: updatePages_idpages('1');
input: pages_idpages

employee_type_has_pages:: updatEpemployee_type_idmployee_type('1')
input: employee_type_idemployee_type


