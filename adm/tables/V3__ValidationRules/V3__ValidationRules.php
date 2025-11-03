<?php

class tables_V3__ValidationRules {
  function getPermissions($record) {
      return Dataface_PermissionsTool::ALL();
  }
}

?>