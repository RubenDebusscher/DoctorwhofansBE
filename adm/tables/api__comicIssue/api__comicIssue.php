<?php
class tables_api__comicIssue {
  
  function beforeInsert(Dataface_Record $record){
    $user = Dataface_AuthenticationTool::getInstance()->getLoggedInUser();
    if ( $user and !$record->val('issue_Owner_Id') ){
        $record->setValue('issue_Owner_Id', $user->val('user_Id'));
        $record->setValue('issue_Last_modifier', $user->val('user_Id'));
    }
  }
  function beforeUpdate(Dataface_Record $record){
    $user = Dataface_AuthenticationTool::getInstance()->getLoggedInUser();
    if ( $user){
        $record->setValue('issue_Last_modifier', $user->val('user_Id'));
    }
  }

}