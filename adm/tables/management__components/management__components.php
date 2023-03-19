<?php
  class tables_management__components {
    function beforeInsert(Dataface_Record $record){
      $user = Dataface_AuthenticationTool::getInstance()->getLoggedInUser();
      if ( $user and !$record->val('component_Owner_Id') ){
          $record->setValue('component_Owner_Id', $user->val('user_Id'));
          $record->setValue('component_Last_modifier', $user->val('user_Id'));
      }
    }
    function beforeUpdate(Dataface_Record $record){
      $user = Dataface_AuthenticationTool::getInstance()->getLoggedInUser();
      if ( $user){
          $record->setValue('component_Last_modifier', $user->val('user_Id'));

      }
    }
    function component_Last_modifier__default(){
      return 0;
    }
    function component_Owner_Id__default(){
      return 0;
    }
  }
?>