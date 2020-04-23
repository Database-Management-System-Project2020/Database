
<?php
 include 'supplier.php';
 include 'product_supplier_deal.php';
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
#product_supplier_deal::insert_deal(5,2,"2020-05-23",.20);



//test1: insert
#$sup=new Supplier('Omar we Ali','011', "cairo, behind loghat school", 3);
#$sup=new Supplier('1226000168', "159, 26th of July St. Zamalek Cairo, Egypt 12311", 3);

 
#2test update
#Supplier::update($idSupplier=1,$telephone="0108373729",$address="zagazig",$deals=1);


//  $stmt = $pdo->prepare($sql);
  //$stmt->execute(array(':name_s'-> $name_s, ':telephone_s'->$telephone_s , ':address'->$address , ':deals'->$deals));


#TEST produt_supplier_deal
#test2 insert
#product_supplier_deal::insert_deal(3,2,"2020-06-23",.20);

#test2: update
product_supplier_deal::update($product_product_id=5,$Supplier_idSupplier=1 , $supplied_date="2020-04-22 20:11:41", $deadline="2020-05-30");


#$name="maktabet dewaa";
#Supplier::get_phone_by_n($name_s);

#get info by nae
#$sup->get_info_by_n($name);
#$sup->get_phone_by_n($name);

//get nae then update nae; get_info_by_n then y5tar y3addel eh dy n 3ndho b2a
#$sup->update($idSupplier='1', $name_s='rawraw', "011","england");