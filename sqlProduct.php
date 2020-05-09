<?php

#free the current table by uncomment it to work on 
//include 'testStock.php';
//include 'testProduct.php';
//include 'toolsTest.php';
//include 'testcustomer.php';


#Hint insert the product before tools
try{


    
    //$p = new Product ('fbrp','10','faberPen','80');  #insert(barcode,price,description,amount_available)


    //$t = new Tools ('brgl','1');                  #insert(type,idemployee)

    
    //$c = new Customer('Sally','01144444444');         #insert(name,telephone)





    //*******************************//
    //Testing product table
    //*******************************//

    //echo Product::get_productAttributes('cnema');       #get the price, description, amount_available of any product by its barcode
    //Product::update_price('5','yberr');                 #update product price by (newPrice,barcode)
    //Product::update_description('Elawael','cnema');     #update product description by (newDescription,barcode)
    //Product::update_amount_available(100,'edrft');      #update product amount by (newAmount,barcode)
    //echo Product::get_stockID('howth');                 #to know id_stock "foreign key" before making join query
    //Product::get_infoStock_innerJoin(4);              #get participated attributes between product&stock by idstock
    //Product::get_infoStock_leftouterJoin (3);         #get stock attributes that not in product by foreign key of stock

    //echo Product::get_empID('plzco');                   #to know id_employee "foreign key" before making join query

    //Product::get_infoEmployee_innerJoin(1);           #get participated attributes between product&employee by foreign key employee

    //Product::get_infoEmployee_leftouterJoin(1);      #get employee attributes that not in product by employee foreign key   
    //Product::delete_product('tbleh');                   #delete any product and its foreign key  from tools



    //*******************************//
    //Testing tools table
    //*******************************//

    //echo Tools::get_foreignID_by_type('autograph');   #get tools foreign key by its type
    //Tools::get_toolsAttributes(41);                 #get type, employeeID tools by its foreign key
    //Tools::update_type('noteBook',11);        #update tool type by(new type, foreign key)
    //Tools::update_empTools('1','41');         #update inserted employee by(new employee, foreign key)
    //Tools::get_infoProduct_innerJoin('42');   #get participated attributes between product&tool by foreign key
    //Tools::get_infoProduct_leftouterJoin('12'); #get product attributes that not in tools by foreign key



    //*******************************//
    //Testing customer table
    //*******************************//

    //Customer::get_info_by_name('Sally');                   #get information about customer by name

    //Customer::update_nameCustomer(5,'Younis');                    #update customer nameby(idCustomer,new name)

    //Customer::update_telephoneCustomer(1,'01137373737');          ##update customer telephoneby(idCustomer,new num)
    
    //Customer::delete_customer_by_id('5');                         #delete any customer by its id.

}


catch(PDOException $e) {
    echo "Connection failed " . $e->getMessage();
}

?>