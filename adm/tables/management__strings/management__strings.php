<?php
  class tables_management__strings {
    function beforeInsert(Dataface_Record $record){
      $user = Dataface_AuthenticationTool::getInstance()->getLoggedInUser();
      if ( $user and !$record->val('string_Owner_Id') ){
          $record->setValue('string_Owner_Id', $user->val('user_Id'));
          $record->setValue('string_Last_modifier', $user->val('user_Id'));
      }
    }
    function beforeUpdate(Dataface_Record $record){
      $user = Dataface_AuthenticationTool::getInstance()->getLoggedInUser();
      if ( $user){
          $record->setValue('string_Last_modifier', $user->val('user_Id'));

      }
    }
    function string_Last_modifier__default(){
      return 0;
    }
    function string_Owner_Id__default(){
      return 0;
    }
  }
?>