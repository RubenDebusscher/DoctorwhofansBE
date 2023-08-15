<?php
class tables_api__serials_charactersActors {
  
  function beforeInsert(Dataface_Record $record){
    $user = Dataface_AuthenticationTool::getInstance()->getLoggedInUser();
    if ( $user and !$record->val('serials_characters_Owner_Id') ){
        $record->setValue('serials_characters_Owner_Id', $user->val('user_Id'));
        $record->setValue('serials_characters_Last_modifier', $user->val('user_Id'));


    }
  }
  function beforeUpdate(Dataface_Record $record){
    $user = Dataface_AuthenticationTool::getInstance()->getLoggedInUser();
    if ( $user){
        $record->setValue('serials_characters_Last_modifier', $user->val('user_Id'));

    }
  }

}
?>