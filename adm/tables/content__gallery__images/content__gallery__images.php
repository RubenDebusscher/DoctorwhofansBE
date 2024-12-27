<?php
class tables_content__gallery__images {
  function beforeInsert(Dataface_Record $record){
    $user = Dataface_AuthenticationTool::getInstance()->getLoggedInUser();
    if ( $user and !$record->val('image_Owner_Id') ){
        $record->setValue('image_Owner_Id', $user->val('user_Id'));
        $record->setValue('image_Last_modifier', $user->val('user_Id'));
    }
  }
  function beforeUpdate(Dataface_Record $record){
    $user = Dataface_AuthenticationTool::getInstance()->getLoggedInUser();
    if ($user){
        $record->setValue('image_Last_modifier', $user->val('user_Id'));

    }
  }
  function image_Owner_Id__default(){
    return 0;
  }
  function image_Last_modifier__default(){
    return 0;
  }











  function __import__csv($data, $defaultValues=array()){
    $records = array();
    $rows = explode("\n", $data);
    foreach ( $rows as $row ){
        list($image_File,$image_Folder,$image_Caption,$image_active,$Image_Order,$Gallery_Id) = explode(',', $row);
        $record = new Dataface_Record('content__gallery__images', array());
        $record->setValues($defaultValues);
        $record->setValues(
            array(
                'image_File'=>$image_File,
                'image_Folder'=>$image_Folder,
                'image_Caption'=>$image_Caption,
                'image_active'=>(int)$image_active,
                'Image_Order'=>(int)$Image_Order,
                'Gallery_Id'=>(int)$Gallery_Id
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

    $record = new Dataface_Record('content__gallery__images', array());

    // Start out with the default values and build from there.
    $record->setValues($defaultValues);

    $record->setValues(
              array(
                  'image_File'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, $ligne)->getValue(),
                  'image_Folder'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, $ligne)->getValue(),
                  'image_Caption'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2, $ligne)->getValue(),
                  'image_active'=>(int)$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(3, $ligne)->getValue(),
                  'Image_Order'=>(int)$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(4, $ligne)->getValue(),
                  'Gallery_Id'=>(int)$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(5, $ligne)->getValue()
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