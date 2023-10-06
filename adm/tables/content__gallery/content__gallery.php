<?php
class tables_content__gallery {
  function beforeInsert(Dataface_Record $record){
    $user = Dataface_AuthenticationTool::getInstance()->getLoggedInUser();
    if ( $user and !$record->val('Gallery_Owner_Id') ){
        $record->setValue('Gallery_Owner_Id', $user->val('user_Id'));
        $record->setValue('Gallery_Last_modifier', $user->val('user_Id'));
    }
  }
  function beforeUpdate(Dataface_Record $record){
    $user = Dataface_AuthenticationTool::getInstance()->getLoggedInUser();
    if ($user){
        $record->setValue('gallery_Last_modifier', $user->val('user_Id'));

    }
  }
  function Gallery_Last_modifier__default(){
    return 0;
  }
  function Gallery_Owner_Id__default(){
    return 0;
  }











}
?>