<?php
class tables_api__magazines {
  function getTitle($record){
		return $record->val('magazine_Issue').': '.$record->val('magazine_CoverDate');
  }
  function beforeInsert(Dataface_Record $record){
    $user = Dataface_AuthenticationTool::getInstance()->getLoggedInUser();
    if ( $user and !$record->val('magazine_Owner_Id') ){
        $record->setValue('magazine_Owner_Id', $user->val('user_Id'));
        $record->setValue('magazine_Last_modifier', $user->val('user_Id'));
    }
  }
  function beforeUpdate(Dataface_Record $record){
    $user = Dataface_AuthenticationTool::getInstance()->getLoggedInUser();
    if ( $user){
        $record->setValue('magazine_Last_modifier', $user->val('user_Id'));
    }
  }
  
  function __import__csv($data, $defaultValues=array()){
    $records = array();
    $rows = explode("\n", $data);
    foreach ( $rows as $row ){
      list($magazine_Issue,$magazine_Type,$magazine_CoverDate,$magazine_ReleaseDate,$magazine_Format) = explode(',', $row);
      $record = new Dataface_Record('api__magazines', array());
      $record->setValues($defaultValues);
      $record->setValues(
        array(
          'magazine_Issue'=>$magazine_Issue,
          'magazine_Type'=>$magazine_Type,
          'magazine_CoverDate'=>$magazine_CoverDate,
          'magazine_ReleaseDate'=>$magazine_ReleaseDate,

          'magazine_Format'=>$magazine_Format,
          'magazine_ReleaseDate'=>$magazine_ReleaseDate,
          'magazine_Image'=>''
        )
      );
      $records[] = $record;
    }
    return $records;
  }
/*
  function __import__excel_spreadsheet($data, $defaultValues=array()){
    import(DATAFACE_SITE_PATH."/include/PHPExcel/Classes/PHPExcel.php");
    $records = array();  // the array that will hold the records to be imported.
    $tempdir = DATAFACE_SITE_PATH.'/templates_c';
    $tmpnam = tempnam($tempdir, 'import_excel');
    $handle = fopen($tmpnam,'w');
    fwrite($handle,$data);
    fclose($handle);
    $objReader = PHPExcel_IOFactory::createReader('Excel2007');
    $objReader->setReadDataOnly(true);
    $objPHPExcel = $objReader->load($tmpnam);
    $objWorksheet = $objPHPExcel->getActiveSheet();
    $app = Dataface_Application::getInstance();
    $ligne=2; // starting line for reading cells
    while ($objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, $ligne)!=""){
      $record = new Dataface_Record('api__magazines', array());
      $record->setValues($defaultValues);
      $record->setValues(
        array(
          'magazine_Issue'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, $ligne)->getValue(),
          'magazine_Type'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, $ligne)->getValue(),
          'magazine_CoverDate'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2, $ligne)->getValue(),
          'magazine_ReleaseDate'=>$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(3, $ligne)->getValue()

          )
      );
      $records[] =$record;
      $ligne++;
    }
      // Return our array of records and let Xataface handle the rest.
      return $records;
  }
 */
  
}
?>