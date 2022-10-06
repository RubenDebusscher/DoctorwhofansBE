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







//item_Page,item_Type,item_Value,item_Level,item_Active,item_Class,item_Belongs_To,item_Owner_Id,item_Created_at,item_Last_modifier,item_Last_modified_at
  function __import__csv($data, $defaultValues=array()){
    $records = array();
    $rows = explode("\n", $data);
    foreach ( $rows as $row ){
        list($Pagina,$Type,$Value,$Level,$Active,$CSSClass,$BelongsTo,) = explode(',', $row);
        $record = new Dataface_Record('content__items', array());
        $record->setValues($defaultValues);
        $record->setValues(
            array(
                'item_Page'=>(int)$Pagina,
                'item_Type'=>(int)$Type,
                'item_Value'=>$Value,
                'item_Level'=>$Level,
                'item_Active'=>$Active,
                'item_Class'=>$CSSClass,
                'item_Belongs_To'=>$BelongsTo
                 )
            );
        $records[] = $record;
    }
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
                'item_Page'=>(int)$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, $ligne)->getValue(),
                'item_Type'=>(int)$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, $ligne)->getValue(),
                'item_Value'=>(int)$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2, $ligne)->getValue(),
                'item_Level'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(3, $ligne)->getValue(),
                'item_Active'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(4, $ligne)->getValue(),
                'item_Class'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(5, $ligne)->getValue(),
                'item_Belongs_To'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(6, $ligne)->getValue()
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