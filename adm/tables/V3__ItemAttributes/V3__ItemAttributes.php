<?php
class tables_V3__ItemAttributes {
  function beforeInsert(Dataface_Record $record){
    $user = Dataface_AuthenticationTool::getInstance()->getLoggedInUser();
    if ( $user and !$record->val('created_by') ){
        $record->setValue('created_by', $user->val('user_Id'));
        $record->setValue('updated_by', $user->val('user_Id'));
    }
  }
  function beforeUpdate(Dataface_Record $record){
    $user = Dataface_AuthenticationTool::getInstance()->getLoggedInUser();
    if ( $user){
        $record->setValue('updated_by', $user->val('user_Id'));

    }
  }
  function updated_by__default(){
    return 0;
  }
  function created_by__default(){
    return 0;
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

    $record = new Dataface_Record('V3__ItemAttributes', array());

    // Start out with the default values and build from there.
    $record->setValues($defaultValues);

    $record->setValues(
              array(
                  'ItemID'=>(int)$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, $ligne)->getValue(),
                  'AttributeID'=>(int)$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, $ligne)->getValue(),
                  'Value'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2, $ligne)->getValue(),
                  'NumberValue'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(3, $ligne)->getValue(),
                  'DateValue'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(4, $ligne)->getValue(),
                  'BoolValue'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(5, $ligne)->getValue(),
                  'LookupValue'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(6, $ligne)->getValue()
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