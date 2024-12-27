<?php
class tables_V2__Api__Types {
  function beforeInsert(Dataface_Record $record){
    $user = Dataface_AuthenticationTool::getInstance()->getLoggedInUser();
    if ( $user and !$record->val('apiT_Owner_Id') ){
        $record->setValue('apiT_Owner_Id', $user->val('user_Id'));
        $record->setValue('apiT_Last_modifier', $user->val('user_Id'));
    }
  }
  function beforeUpdate(Dataface_Record $record){
    $user = Dataface_AuthenticationTool::getInstance()->getLoggedInUser();
    if ( $user){
        $record->setValue('apiT_Last_modifier', $user->val('user_Id'));

    }
  }


}
?>