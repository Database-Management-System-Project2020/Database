<?php
include 'connect.php';
include 'stock.php';
include 'employee_type.php';
include 'employee.php';
include 'testProduct.php';
include 'books.php';
include 'toolsTest.php';
include 'product_supplier_deal.php';
include 'product_sale.php';
include 'testcustomer.php';
include 'class_pages.php';
include 'employee_type_has_pages.php';


stock::setquantity(3);
employee_type::setType('Admin');
//insert_employee(name, jobdescription , password, email, type number(1 for the first insert; which stands for admin) );
employee::insert_employee('name', 'anything' , '123123', 'name@admin.com', 1 );
