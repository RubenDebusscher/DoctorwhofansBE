<?php
class tables_V3__Attributes {
  function beforeInsert(Dataface_Record $record){
    $user = Dataface_AuthenticationTool::getInstance()->getLoggedInUser();
    if ( $user and !$record->val('created_by') ){
        $record->setValue('created_by', $user->val('user_Id'));
        $record->setValue('updated_by ', $user->val('user_Id'));
    }
  }
  function beforeUpdate(Dataface_Record $record){
    $user = Dataface_AuthenticationTool::getInstance()->getLoggedInUser();
    if ( $user){
        $record->setValue('updated_by', $user->val('user_Id'));

    }
  }




  function getFormHtml(&$record, $field) {
    if ($field == 'AttributeValue') {
        $validationRuleID = $record->val('ValidationRuleID');
        $type = "text"; // Default type

        switch ($validationRuleID) {
            case "1": 
                $type = "number";
                break;
            case "2": 
                $type = "text";
                break;
            case "3": 
                $type = "date";
                break;
        }

        return '<input type="'.$type.'" name="AttributeValue" id="AttributeValue">';
    }
}

}
?>