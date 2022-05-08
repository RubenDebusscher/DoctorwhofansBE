<?php
class tables_content__videos {
  function beforeInsert(Dataface_Record $record){
    $user = Dataface_AuthenticationTool::getInstance()->getLoggedInUser();
    if ( $user and !$record->val('video_Owner_Id') ){
        $record->setValue('video_Owner_Id', $user->val('user_Id'));
        $record->setValue('video_Last_modifier', $user->val('user_Id'));
    }
  }
  function beforeUpdate(Dataface_Record $record){
    $user = Dataface_AuthenticationTool::getInstance()->getLoggedInUser();
    if ( $user){
        $record->setValue('video_Last_modifier', $user->val('user_Id'));

    }
  }
  function video_Last_modifier__default(){
    return 0;
  }
  function video_Owner_Id__default(){
    return 0;
  }




}
?>