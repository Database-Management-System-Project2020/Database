<?php
//include 'connect.php';
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
include 'bill.php';
include 'billline.php';
include 'images_class.php';
include 'supplier.php';




//those three must be called at the very beginning to be able to delete anything, only once.


//  Tools::on_delete_cascade_tools();
//  Books::on_delete_cascade_books();
// product_supplier_deal::supplier_and_emp_has_pages_tbls_contstr();
  // product_sale::alter_tables();
//Product::stockid_constraints();
//product::employee_idemployee_constraints();
//  employee::set_null_idemployeetype();
//   employee_type_has_pages::emp_type_table_constraints();
//  Images::on_delete_cascade_images();
// Bill::bill_table_constraints();
