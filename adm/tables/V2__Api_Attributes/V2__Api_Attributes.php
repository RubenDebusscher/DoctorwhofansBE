<?php
class tables_V2__Api_Attributes {
  function beforeInsert(Dataface_Record $record){
    $user = Dataface_AuthenticationTool::getInstance()->getLoggedInUser();
    if ( $user and !$record->val('apiA_Owner_Id') ){
        $record->setValue('apiA_Owner_Id', $user->val('user_Id'));
        $record->setValue('apiA_Last_modifier', $user->val('user_Id'));
    }
  }
  function beforeUpdate(Dataface_Record $record){
    $user = Dataface_AuthenticationTool::getInstance()->getLoggedInUser();
    if ( $user){
        $record->setValue('apiA_Last_modifier', $user->val('user_Id'));

    }
  }


}
?>