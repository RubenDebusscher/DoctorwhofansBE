<?php
class tables_V3__ContentTypes {
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


}
?>