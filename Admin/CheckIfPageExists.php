    <div>
        <script>$(document).ready(function(){
                 GetListLinks();
                });</script>
        <h2>Controles</h2>
        <h3>Kijk of pagina voorkomt in content(rood=komt voor op andere pagina's, wit= geen references)</h3>
        <?php
            function fetchCategoryTreeList($parent = 0, $user_tree_array = '') {
$verbinding =mysqli_connect("doctorwhofans.be.mysql", "doctorwhofans_be", "RicatechApp", "doctorwhofans_be");

    if (!is_array($user_tree_array))
    $user_tree_array = array();

  $sql = "SELECT `id`, `topic`, `parent_id`,`link`,`Uitklapbaar` FROM `Topics` WHERE `parent_id` = $parent ORDER BY Uitklapbaar desc,topic,id ASC";
  $query = mysqli_query($verbinding,$sql);
  if (mysqli_num_rows($query) > 0) {
     $user_tree_array[] = "<ol class='itemsSitemap'>";
    while ($row = mysqli_fetch_object($query)) {
        if($row->Uitklapbaar ==1){
           $user_tree_array[] = "<li class='item parent' id='".$row->link."'>".$row->id.": ". $row->topic."( ".$row->link.")</li>"; 
        }else{
            if($row->topic =="Forum"){
                $user_tree_array[] = "<li class='item parent' id='".$row->link."'>".$row->id.": ". $row->topic."( ".$row->link.")</li>";
            }else{
                $user_tree_array[] = "<li class='item parent' id='".$row->link."'>".$row->id.": ". $row->topic."( ".$row->link.")</li>";
            }
        }
	  
      $user_tree_array = fetchCategoryTreeList($row->id, $user_tree_array);
    }
	$user_tree_array[] = "</ol>";
  }
  return $user_tree_array;
}
            $res = fetchCategoryTreeList();
            foreach ($res as $r) {
                echo  $r;
            }  
        ?>
        <h3>Kijk of pagina bestaat(groen= pagina bestaat, wit=pagina bestaat niet)/</h3>
        <ul id=Links></ul>
        <ol id=items></ol>
    </div>
