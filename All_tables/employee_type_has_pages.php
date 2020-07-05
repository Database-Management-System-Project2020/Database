<?php
$conn;

// try{
// #echo employee_type_has_pages:: getpage_url(3);
// #echo employee_type_has_pages::gettype(1);
// #employee_type_has_pages:: updatePages_idpages('1');
// #employee_type_has_pages:: setEmployee_type_idemployee_type(2);
// #employee_type_has_pages:: setID('2', '2');
// #employee_type_has_pages:: deleteIdemployeetype('1');
//  employee_type_has_pages::deleteIdpages('1');
// }catch(PDOException $e)
//     {
//     echo "Error: " . $e->getMessage();
//     }
//

class employee_type_has_pages{


public $pages_idpages;
public $employee_type_idemployee_type;




public function __construct($pages_idpages, $employee_type_idemployee_type){
$this->$pages_idpages = $pages_idpages;
$this->$employee_type_idemployee_type = $employee_type_idemployee_type;
}
public static function emp_type_table_constraints(){
        connect();
        $stmt1= $GLOBALS["conn" ]->prepare(" ALTER TABLE employee_type_has_pages
                            DROP CONSTRAINT `fk_employee_type_has_pages_employee_type1` ");
        $stmt2=$GLOBALS["conn" ]->prepare(" ALTER TABLE employee_type_has_pages
                            ADD  CONSTRAINT `fk_employee_type_has_pages_employee_type1`
                                FOREIGN KEY (`employee_type_idemployee_type`)
                                REFERENCES `newpro`.`employee_type` (`idemployee_type`)
                                ON DELETE CASCADE
                                ON UPDATE CASCADE
            ");

        $stmt3= $GLOBALS["conn" ]->prepare(" ALTER TABLE employee_type_has_pages
                            DROP CONSTRAINT `fk_employee_type_has_pages_pages1`; ");
        $stmt4=$GLOBALS["conn" ]->prepare(" ALTER TABLE employee_type_has_pages
                             ADD CONSTRAINT `fk_employee_type_has_pages_pages1`
                                FOREIGN KEY (`pages_idpages`)
                                REFERENCES `newpro`.`pages` (`idpages`)
                                ON DELETE CASCADE
                                ON UPDATE CASCADE  ");

        $stmt1->execute();
        $stmt2->execute();
        $stmt3->execute();
        $stmt4->execute();


        $GLOBALS["conn" ]=null;
    }


   public static function setID($pages_idpages, $employee_type_idemployee_type){
    try {
      connect();


    $stmt = $GLOBALS["conn"]->prepare("INSERT INTO employee_type_has_pages (pages_idpages, employee_type_idemployee_type)VALUES (:pages_idpages , :employee_type_idemployee_type)");

    $stmt->bindParam(':pages_idpages', $pages_idpages);

    $stmt->bindParam(':employee_type_idemployee_type', $employee_type_idemployee_type);

    $stmt->execute();


    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }



}
static function updatePages_idpages($pages_idpage, $type_id){
    try{
        connect();
           employee_type_has_pages::deteleIdemployeetype($type_id);
           employee_type_has_pages::setID($pages_idpage, $type_id);

      $GLOBALS["conn" ]=null;




         echo "Connected successfully";
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }



}

 static function updatEpemployee_type_idmployee_type($employee_type_idemployee_type,$pages_idpage){
    try{
        connect();
        employee_type_has_pages::deteleIdpages($employee_type_idemployee_type);
        employee_type_has_pages::setID($pages_idpage, $employee_type_idemployee_type);
      $GLOBALS["conn" ]=null;




         echo "Connected successfully";
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }

}
static function deteleIdpages($pages_idpages){
                try{
                    connect();
         $stmt = $GLOBALS["conn"]->prepare("DELETE FROM employee_type_has_pages WHERE $pages_idpages=pages_idpages");
                     $stmt->bindParam(':pages_idpage', $pages_idpage);

         $stmt->execute();

        echo "record deleted successfully";
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }


    }




static function deteleIdemployeetype($employee_type_idemployee_type){
                try{
                    connect();
         $stmt = $GLOBALS["conn"]->prepare("DELETE FROM employee_type_has_pages WHERE $employee_type_idemployee_type=employee_type_idemployee_type");
                     $stmt->bindParam(':employee_type_idemployee_type', $employee_type_idemployee_type);

         $stmt->execute();

        echo "record deleted successfully";
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }


    }

 function getpage_url($idEmployee)
    {
        try {
            connect();
            $stmt = $GLOBALS["conn"]->prepare(" SELECT pages.page_url FROM pages INNER JOIN  employee_type_has_pages on idpages = pages_idpages JOIN Employee  WHERE Employee.idEmployee = $idEmployee");
            $stmt->execute();

            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchall();
            }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            }

    }








 function gettype($idEmployee)
    {
        try {
            connect();
            $stmt = $GLOBALS["conn"]->prepare("SELECT employee_type.type FROM employee_type INNER JOIN  employee_type_has_pages on idemployee_type = employee_type_idemployee_type JOIN Employee WHERE employee.idEmployee= $idEmployee ");


            $stmt->execute();

            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchall();
            }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            }

    }


}
?>
