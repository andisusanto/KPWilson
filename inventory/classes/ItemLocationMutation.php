<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class ItemLocationMutation extends BaseObject{
   const TABLENAME = 'ItemLocationMutation';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Admin;
    public $EffectiveDate;
    public $Note;
    public $Code;
    public $Item;
    public $ToLocation;
    public $TransDate;
    public $ItemLocationHistory;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Admin,EffectiveDate,Note,Code,Item,ToLocation,TransDate,LockField, ItemLocationHistory) VALUES('".$mySQLi->real_escape_string($this->Admin)."','".$mySQLi->real_escape_string($this->EffectiveDate)."','".$mySQLi->real_escape_string($this->Note)."','".$mySQLi->real_escape_string($this->Code)."','".$mySQLi->real_escape_string($this->Item)."','".$mySQLi->real_escape_string($this->ToLocation)."','".$mySQLi->real_escape_string($this->TransDate)."','".$mySQLi->real_escape_string($this->LockField)."','".$mySQLi->real_escape_string($this->ItemLocationHistory)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Admin = '".$mySQLi->real_escape_string($this->Admin)."', EffectiveDate = '".$mySQLi->real_escape_string($this->EffectiveDate)."', Note = '".$mySQLi->real_escape_string($this->Note)."', Code = '".$mySQLi->real_escape_string($this->Code)."', Item = '".$mySQLi->real_escape_string($this->Item)."', ToLocation = '".$mySQLi->real_escape_string($this->ToLocation)."', TransDate = '".$mySQLi->real_escape_string($this->TransDate)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."', ItemLocationHistory = '".$mySQLi->real_escape_string($this->ItemLocationHistory)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpItemLocationMutation = new ItemLocationMutation($mySQLi);
               $tmpItemLocationMutation->Id = $row['Id'];
               $tmpItemLocationMutation->Admin = $row['Admin'];
               $tmpItemLocationMutation->EffectiveDate = $row['EffectiveDate'];
               $tmpItemLocationMutation->Note = $row['Note'];
               $tmpItemLocationMutation->Code = $row['Code'];
               $tmpItemLocationMutation->Item = $row['Item'];
               $tmpItemLocationMutation->ToLocation = $row['ToLocation'];
               $tmpItemLocationMutation->TransDate = $row['TransDate'];
               $tmpItemLocationMutation->ItemLocationHistory = $row['ItemLocationHistory'];
               $tmpItemLocationMutation->LockField = $row['LockField'];
               return $tmpItemLocationMutation;
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
           $ItemLocationMutations = array();
           while ($row = $result->fetch_array()){
               $tmpItemLocationMutation = new ItemLocationMutation($mySQLi);
               $tmpItemLocationMutation->Id = $row['Id'];
               $tmpItemLocationMutation->LockField = $row['LockField'];
               $tmpItemLocationMutation->Admin = $row['Admin'];
               $tmpItemLocationMutation->EffectiveDate = $row['EffectiveDate'];
               $tmpItemLocationMutation->Note = $row['Note'];
               $tmpItemLocationMutation->Code = $row['Code'];
               $tmpItemLocationMutation->Item = $row['Item'];
               $tmpItemLocationMutation->ToLocation = $row['ToLocation'];
               $tmpItemLocationMutation->TransDate = $row['TransDate'];
               $tmpItemLocationMutation->ItemLocationHistory = $row['ItemLocationHistory'];
               $ItemLocationMutations[] = $tmpItemLocationMutation;
           }
           return $ItemLocationMutations;
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