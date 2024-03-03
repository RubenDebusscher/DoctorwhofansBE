<?php
  class tables_management__strings_languages {
    function beforeInsert(Dataface_Record $record){
      $user = Dataface_AuthenticationTool::getInstance()->getLoggedInUser();
      if ( $user and !$record->val('SL_Owner_Id') ){
          $record->setValue('SL_Owner_Id', $user->val('user_Id'));
          $record->setValue('SL_Last_modifier', $user->val('user_Id'));
      }
    }
    function beforeUpdate(Dataface_Record $record){
      $user = Dataface_AuthenticationTool::getInstance()->getLoggedInUser();
      if ( $user){
          $record->setValue('SL_Last_modifier', $user->val('user_Id'));

      }
    }
    function SL_Last_modifierr__default(){
      return 0;
    }
    function SL_Last_modifier__default(){
      return 0;
    }
  }
?>