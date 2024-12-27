<?php
class tables_api__comicLine {
  function getTitle($record){
		return $record->val('Line_Id').': '.$record->val('line_Name');
    }
  function beforeInsert(Dataface_Record $record){
    $user = Dataface_AuthenticationTool::getInstance()->getLoggedInUser();
    if ( $user and !$record->val('line_Owner_Id') ){
        $record->setValue('line_Owner_Id', $user->val('user_Id'));
        $record->setValue('line_Last_modifier', $user->val('user_Id'));
    }
  }
  function beforeUpdate(Dataface_Record $record){
    $user = Dataface_AuthenticationTool::getInstance()->getLoggedInUser();
    if ( $user){
        $record->setValue('line_Last_modifier', $user->val('user_Id'));
    }
  }
  

 
  
}
?>