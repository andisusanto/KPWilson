<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class ItemLocationHistory extends BaseObject{
   const TABLENAME = 'ItemLocationHistory';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Since;
    public $Location;
    public $Item;
    public $Until;
    public $Admin;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Since,Location,Item,Until,Admin, LockField) VALUES('".$mySQLi->real_escape_string($this->Since)."','".$mySQLi->real_escape_string($this->Location)."','".$mySQLi->real_escape_string($this->Item)."','".$mySQLi->real_escape_string($this->Until)."','".$mySQLi->real_escape_string($this->Admin)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Since = '".$mySQLi->real_escape_string($this->Since)."', Location = '".$mySQLi->real_escape_string($this->Location)."', Item = '".$mySQLi->real_escape_string($this->Item)."', Until = '".$mySQLi->real_escape_string($this->Until)."', Admin = '".$mySQLi->real_escape_string($this->Admin)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpItemLocationHistory = new ItemLocationHistory($mySQLi);
               $tmpItemLocationHistory->Id = $row['Id'];
               $tmpItemLocationHistory->Since = $row['Since'];
               $tmpItemLocationHistory->Location = $row['Location'];
               $tmpItemLocationHistory->Item = $row['Item'];
               $tmpItemLocationHistory->Until = $row['Until'];
               $tmpItemLocationHistory->Admin = $row['Admin'];
               $tmpItemLocationHistory->LockField = $row['LockField'];
               return $tmpItemLocationHistory;
           }
           else
           {
               return false;
           }
       }
       else
       {
           throw new InvalidQueryException;
       }
   }
   
   public static function LoadCollection($mySQLi, $Criteria = '1 = 1',$sort='',$page=0,$totalitem=0){
       $tmpQuery = "SELECT  * FROM ".self::TABLENAME." WHERE ".$Criteria;
       if ($sort != ''){ $tmpQuery .= " "."ORDER BY ".$sort; }
       if ($page > 0 && $totalitem > 0){
           $start = ($page-1) * $totalitem;
           $tmpQuery .= " LIMIT ".$start.",".$totalitem;
       }
       if ($result = $mySQLi->query($tmpQuery)){
           $ItemLocationHistorys = array();
           while ($row = $result->fetch_array()){
               $tmpItemLocationHistory = new ItemLocationHistory($mySQLi);
               $tmpItemLocationHistory->Id = $row['Id'];
               $tmpItemLocationHistory->LockField = $row['LockField'];
               $tmpItemLocationHistory->Since = $row['Since'];
               $tmpItemLocationHistory->Location = $row['Location'];
               $tmpItemLocationHistory->Item = $row['Item'];
               $tmpItemLocationHistory->Until = $row['Until'];
               $tmpItemLocationHistory->Admin = $row['Admin'];
               $ItemLocationHistorys[] = $tmpItemLocationHistory;
           }
           return $ItemLocationHistorys;

       }
       else
       {
           echo $tmpQuery;//throw new InvalidQueryException;
       }
   }
   public static function Delete($mySQLi,$Id){
       if ($result = $mySQLi->query("DELETE FROM ".self::TABLENAME." WHERE Id=".$mySQLi->real_escape_string($Id))){
           if ($mySQLi->affected_rows == 0){
               throw new ObjectNotFoundException;
           }
       }
       else
       {
           throw new InvalidQueryException;
       }
   }
}
?>