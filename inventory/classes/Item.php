<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class Item extends BaseObject{
   const TABLENAME = 'Item';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Name;
    public $Condition;
    public $AdditionalInfo;
    public $Code;
    public $Status;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Name,`Condition`,AdditionalInfo,Code,LockField,`Status`) VALUES('".$mySQLi->real_escape_string($this->Name)."','".$mySQLi->real_escape_string($this->Condition)."','".$mySQLi->real_escape_string($this->AdditionalInfo)."','".$mySQLi->real_escape_string($this->Code)."','".$mySQLi->real_escape_string($this->LockField)."','".$mySQLi->real_escape_string($this->Status)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Name = '".$mySQLi->real_escape_string($this->Name)."', `Condition` = '".$mySQLi->real_escape_string($this->Condition)."', AdditionalInfo = '".$mySQLi->real_escape_string($this->AdditionalInfo)."', Code = '".$mySQLi->real_escape_string($this->Code)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."', `Status` = '".$mySQLi->real_escape_string($this->Status)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }
   public function get_ItemLocationHistory($page=0,$totalitem=0){
       return ItemLocationHistory::LoadCollection($this->get_mySQLi(),"Item = ".$this->Id,'Id DESC',$page,$totalitem);
   }
   public function get_ItemLocationMutation($page=0,$totalitem=0){
       return ItemLocationMutation::LoadCollection($this->get_mySQLi(),"Item = ".$this->Id,'Id DESC',$page,$totalitem);
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpItem = new Item($mySQLi);
               $tmpItem->Id = $row['Id'];
               $tmpItem->Name = $row['Name'];
               $tmpItem->Condition = $row['Condition'];
               $tmpItem->AdditionalInfo = $row['AdditionalInfo'];
               $tmpItem->Code = $row['Code'];
               $tmpItem->Status = $row['Status'];
               $tmpItem->LockField = $row['LockField'];
               return $tmpItem;
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
           $Items = array();
           while ($row = $result->fetch_array()){
               $tmpItem = new Item($mySQLi);
               $tmpItem->Id = $row['Id'];
               $tmpItem->LockField = $row['LockField'];
               $tmpItem->Name = $row['Name'];
               $tmpItem->Condition = $row['Condition'];
               $tmpItem->AdditionalInfo = $row['AdditionalInfo'];
               $tmpItem->Code = $row['Code'];
               $tmpItem->Status = $row['Status'];
               $Items[] = $tmpItem;
           }
           return $Items;
       }
       else
       {
           throw new InvalidQueryException;
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