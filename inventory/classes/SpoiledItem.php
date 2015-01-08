<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class SpoiledItem extends BaseObject{
   const TABLENAME = 'SpoiledItem';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Item;
    public $TransDate;
    public $Note;
    public $Admin;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Item,TransDate,Note,Admin,LockField) VALUES('".$mySQLi->real_escape_string($this->Item)."','".$mySQLi->real_escape_string($this->TransDate)."','".$mySQLi->real_escape_string($this->Note)."','".$mySQLi->real_escape_string($this->Admin)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Item = '".$mySQLi->real_escape_string($this->Item)."', TransDate = '".$mySQLi->real_escape_string($this->TransDate)."', Note = '".$mySQLi->real_escape_string($this->Note)."', Admin = '".$mySQLi->real_escape_string($this->Admin)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }
   
   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpSpoiledItem = new SpoiledItem($mySQLi);
               $tmpSpoiledItem->Id = $row['Id'];
               $tmpSpoiledItem->Item = $row['Item'];
               $tmpSpoiledItem->TransDate = $row['TransDate'];
               $tmpSpoiledItem->Note = $row['Note'];
               $tmpSpoiledItem->Admin = $row['Admin'];
               $tmpSpoiledItem->LockField = $row['LockField'];
               return $tmpSpoiledItem;
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
       $tmpQuery = "SELECT  * FROM ".self::TABLENAME." WHERE ".$mySQLi->real_escape_string($Criteria);
       if ($sort != ''){ $tmpQuery .= " "."ORDER BY ".$sort; }
       if ($page > 0 && $totalitem > 0){
           $start = ($page-1) * $totalitem;
           $tmpQuery .= " LIMIT ".$start.",".$totalitem;
       }
       if ($result = $mySQLi->query($tmpQuery)){
           $SpoiledItems = array();
           while ($row = $result->fetch_array()){
               $tmpSpoiledItem = new SpoiledItem($mySQLi);
               $tmpSpoiledItem->Id = $row['Id'];
               $tmpSpoiledItem->LockField = $row['LockField'];
               $tmpSpoiledItem->Item = $row['Item'];
               $tmpSpoiledItem->TransDate = $row['TransDate'];
               $tmpSpoiledItem->Note = $row['Note'];
               $tmpSpoiledItem->Admin = $row['Admin'];
               $SpoiledItems[] = $tmpSpoiledItem;
           }
           return $SpoiledItems;
       }
       else
       {
          echo $tmpQuery;
           //throw new InvalidQueryException;
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