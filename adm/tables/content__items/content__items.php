<?php
class tables_content__items {
  function beforeInsert(Dataface_Record $record){
    $user = Dataface_AuthenticationTool::getInstance()->getLoggedInUser();
    if ( $user and !$record->val('item_Owner_Id') ){
        $record->setValue('item_Owner_Id', $user->val('user_Id'));
        $record->setValue('item_Last_modifier', $user->val('user_Id'));
    }
  }
  function beforeUpdate(Dataface_Record $record){
    $user = Dataface_AuthenticationTool::getInstance()->getLoggedInUser();
    if ( $user){
        $record->setValue('item_Last_modifier', $user->val('user_Id'));

    }
  }
  function item_Last_modifier__default(){
    return 0;
  }
  function item_Owner_Id__default(){
    return 0;
  }

  function css__tableRowClass( $record ){
    if ( $record->val('item_Active') == 1 ) return 'active-row';
    else return 'dormant-row';
  }



  function __import__csv(&$data, $defaultValues=array()){
    // build an array of Dataface_Record objects that are to be inserted based
    // on the CSV file data.
    $records = array();
    
    // first split the CSV file into an array of rows.
    $rows = explode("\n", $data);
    foreach ( $rows as $row ){
        // We iterate through the rows and parse the name, phone number, and email 
        // addresses to that they can be stored in a Dataface_Record object.
        list($page, $type, $value,$level,$active,$class,$belongs) = explode(',', $row);
        $record = new Dataface_Record('content__items', array());
        
        // We insert the default values for the record.
        $record->setValues($defaultValues);
        
        // Now we add the values from the CSV file.
        $record->setValues(
            array(
                'item_Page'=>$page,
                'item_Type'=>$type,
                'item_Value'=>$value,
                'item_Level'=>$level,
                'item_Active'=>$active,
                'item_Class'=>$class,
                'item_Belongs_To'=>$belongs
                 )
            );
        
        // Now add the record to the output array.
        $records[] = $record;
    }
    
    // Now we return the array of records to be imported.
    return $records;
  }






  function __import__excel_spreadsheet($data, $defaultValues=array()){
    import(DATAFACE_SITE_PATH."/include/PHPExcel/Classes/PHPExcel.php");
    $records = array();  // the array that will hold the records to be imported.
        
    // First let's import the excel parser and parse the data into a 
    // data structure so we can work with it.
    $tempdir = DATAFACE_SITE_PATH.'/templates_c';
    $tmpnam = tempnam($tempdir, 'import_excel');
    $handle = fopen($tmpnam,'w');
    fwrite($handle,$data);
    fclose($handle);

    //PHPexcel parser		
    $objReader = PHPExcel_IOFactory::createReader('Excel2007');
    $objReader->setReadDataOnly(true);
    $objPHPExcel = $objReader->load($tmpnam);
    $objWorksheet = $objPHPExcel->getActiveSheet();

      
    $app = Dataface_Application::getInstance();

  $ligne=2; // starting line for reading cells
  while ($objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, $ligne)!=""){
  
    $record = new Dataface_Record('content__items', array());
  
    // Start out with the default values and build from there.
    $record->setValues($defaultValues);
  
  $record->setValues(
            array(
                'item_Page'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, $ligne)->getValue(),
                'item_Type'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, $ligne)->getValue(),
                'item_Value'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2, $ligne)->getValue(),
                'item_Level'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(3, $ligne)->getValue(),
                'item_Active'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(4, $ligne)->getValue(),
                'item_Class'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(5, $ligne)->getValue(),
                'item_Belongs_To'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(6, $ligne)->getValue(),
                    )
            );
            $records[] =$record;
            
            //unset($record);  // necessary to prevent PHP from writing over the last record
    
    $ligne++;
    } 
 
   // Return our array of records and let Xataface handle the rest.
    return $records;
    
}

}
?>