<?php
class tables_V3__Items {
  function beforeInsert(Dataface_Record $record){
    $user = Dataface_AuthenticationTool::getInstance()->getLoggedInUser();
    if ( $user and !$record->val('created_by') ){
        $record->setValue('created_by', $user->val('user_Id'));
        $record->setValue('updated_by', $user->val('user_Id'));
    }
  }
  function beforeUpdate(Dataface_Record $record){
    $user = Dataface_AuthenticationTool::getInstance()->getLoggedInUser();
    if ( $user){
        $record->setValue('updated_by', $user->val('user_Id'));

    }
  }

  
//item_Page,item_Type,item_Value,item_Level,item_Active,item_Class,item_Belongs_To,item_Owner_Id,item_Created_at,item_Last_modifier,item_Last_modified_at
function __import__csv($data, $defaultValues=array()){
  $records = array();
  $rows = explode("\n", $data);
  foreach ( $rows as $row ){
      list($Name,$Type,$Image,) = explode(';', $row);
      if($Name!=""){
        $record = new Dataface_Record('V3__Items', array());
      $record->setValues($defaultValues);
      $decodedString = urldecode($Image); // Converts %0D to "\r"
      $cleanString = str_replace("\r", "", $decodedString);
      $record->setValues(
          array(
              'Name'=>$Name,
              'Type'=>$Type,
              'Image'=>$cleanString
               )
          );
        
      }
      
     
      $records[] = $record;
  }
  return $records;
}



}
?>