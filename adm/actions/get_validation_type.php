<?php
class actions_get_validation_type {
  function handle($params) {
      header("Content-Type: application/json");
      echo json_encode(["status" => "success", "message" => "Action is loaded"]);

      // Debugging: Print permissions
      $user = Dataface_AuthenticationTool::getInstance()->getLoggedInUser();
      if (!$user) {
          echo json_encode(["error" => "No user logged in"]);
          exit;
      }

      $permissions = $user->getPermissions();
      if (!$permissions['read']) {
          echo json_encode(["error" => "Insufficient permissions"]);
          exit;
      }

      if (!isset($_GET['rule_id'])) {
          echo json_encode(["error" => "No rule ID provided"]);
          exit;
      }

      $ruleID = intval($_GET['rule_id']);
      $app = Dataface_Application::getInstance();
      $query = "SELECT Type FROM V3__Validationrules WHERE ValidationRuleID = ?";
      $stmt = df_db_query($query, [$ruleID]);

      if ($row = df_db_fetch($stmt)) {
          echo json_encode(["type" => $row['Name']]);
      } else {
          echo json_encode(["type" => "text"]); // Default type if not found
      }
  }
}

?>