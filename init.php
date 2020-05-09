
<?php
 include 'supplier.php';
 include 'product_supplier_deal.php';
 include 'product_sale.php';
 $servername = "localhost";
//app
 $username = "root";
//default
 $password = "";
 $dbnae="pro";


#TEST PART!!!
$name_s="Omar we Ali";
#echo Supplier::get_phone_by_n($name_s);



#PRODUT_SUPPLIER_DEAL
#test insert_deal
#echo Supplier::get_info_by_n($name_s);

# echo product:: get_info_by_name($name)
//then the user will choose the id
#product_supplier_deal::insert_deal(1,2,"2020-05-03","2020-05-23",.20);


//test1: insert
#$sup=new Supplier('Omar we Ali','011', "cairo, behind loghat school", 3);
#$sup=new Supplier('1226000168', "159, 26th of July St. Zamalek Cairo, Egypt 12311", 3);

 
#2test update
#Supplier::update($idSupplier=1,$telephone="0108373729",$address="zagazi");


//  $stmt = $pdo->prepare($sql);
  //$stmt->execute(array(':name_s'-> $name_s, ':telephone_s'->$telephone_s , ':address'->$address , ':deals'->$deals));


#TEST produt_supplier_deal
#test2 insert
#product_supplier_deal::insert_deal(3,2,"2020-06-23",.20);

#test2: update
#product_supplier_deal::update($product_product_id=5,$Supplier_idSupplier=1 , $supplied_date="2020-04-22 20:11:41", $deadline="2020-05-30");


#$name="maktabet dewaa";
#Supplier::get_phone_by_n($name_s);

#get info by nae
#$sup->get_info_by_n($name);
#$sup->get_phone_by_n($name);

//get nae then update nae; get_info_by_n then y5tar y3addel eh dy n 3ndho b2a
#$sup->update($idSupplier='1', $name_s='rawraw', "011","england");



#test produt_sale table
#test insert_sale
#product_sale::insert_sale(3,"2020-04-24", "2020-05-24",40);

#test get_discount_by_date()
#product_sale::get_discount_by_date("2020-04-24");

#test update
#product_sale::update($idproduct_sale=1,$product_id=1,$quantity=60);
#product_sale::update($idproduct_sale=1,$product_id=1,$start_date="2020-04-25",$end_date="2020-05-30");



#test delete
$sup_id=1;
$pro_id=1;
#Supplier::delete($sup_id);


#test join()
#Supplier::get_supplier_deal_info_by_id($sup_id);

#test get_all_supplier_product_and_deal_info()
Supplier::get_supplier_product_and_deal_info_by_id($id_pro=$pro_id);

#test delete
#$pro_id=1;
$suplied_date="2020-05-03";
#product_supplier_deal::delete($sup_id,$pro_id,$suplied_date);


#testdelete
#get_disount_by_date then:
$sale_id=1;
#product_sale::delete($sale_id);


#test get_deal_by_date

#product_supplier_deal::get_deal_by_date($suplied_date);

#get_nuber_of_deals_for_eah_supplier?