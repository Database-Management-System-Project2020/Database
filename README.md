"# Database" 
# So what is all of this about?
# 1- Supplier table
# * Use cases:

# 1-Insert 

Usage: by calling the Supplier construtor

Example : $sup=new Supplier('Omar we Ali','011', "cairo, behind loghat school", 3);

2- Getting a supplier information by his name

Function:: get_info_by_n($name) 

Returns: All the supplier’s information 

3- Getting a supplier’s phone by his nae

Function: get_phone_by_n($name)

Returns: the phone number

4-Update a supplier's existing information

Usage: First: Call the function get_id_from_name($name_s) which returns the supplier’s id
    Second: Call the function update($idSupplier ,$telephone_s=NULL ,$address=NULL,$deals=NULL)
    
    This function takes the supplier’s id and the new information that you want to update.(telephone and/or address and/or deals)
    
    Example: if you want to update a supplier’s phone number you would use the above function like this: Supplier::update($idSupplier=1,$telephone="0108373729");
And so on..

5- get the deals of a supplier 

Usage: First: Call the function get_id_from_name($name_s) which returns the supplier’s id
    Second: Call  get_supplier_deal_info_by_id($idsupplier)
    
    Returns: the supplier’s info and the deals’s details: date, productid, discount
    
    The important information that we can get using this function is the dates when supplier ade deals


6-get the supplier, deal, and product info

This function is more general than the previous one: it answers 2 questions:

# Q1:Knowing a supplier’s name ,what and when were the deals that he made with us?
# Q2: Knowing a product’s barcode, which supplier did we get this product from? And when? And what was the discount (if the product is a book)

Usage: 
-to answer Q1:  First: Call the function get_id_from_name($name_s) which returns the supplier’s id
        Second: Call   get_supplier_product_and_deal_info_by_id($id_sup)
        
    Which returns all the information about a deal: the supplier’s info, date, discount, and produt’s details

-To answer Q2:  First: Call the function product::get_infoProduct($barcode) which returns the product's id
    Second: Call  get_supplier_product_and_deal_info_by_id($id_pro)
    
    This time, you will send the product's id
    
7-delete a supplier’s info:

First: Call the function get_id_from_name($name_s) which returns the supplier’s id

    Second: Call  delete($id) : this function takes the supplier’s id and deletes his information from the supplier’s table



    

