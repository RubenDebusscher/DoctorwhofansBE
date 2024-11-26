<?php
class tables_content__gallery {
  function beforeInsert(Dataface_Record $record){
    $user = Dataface_AuthenticationTool::getInstance()->getLoggedInUser();
    if ( $user and !$record->val('Gallery_Owner_Id') ){
        $record->setValue('Gallery_Owner_Id', $user->val('user_Id'));
        $record->setValue('Gallery_Last_modifier', $user->val('user_Id'));
    }
  }
  function beforeUpdate(Dataface_Record $record){
    $user = Dataface_AuthenticationTool::getInstance()->getLoggedInUser();
    if ($user){
        $record->setValue('gallery_Last_modifier', $user->val('user_Id'));

    }
  }
  function Gallery_Last_modifier__default(){
    return 0;
  }
  function Gallery_Owner_Id__default(){
    return 0;
  }

  function htmlValue($fieldname, $index=0, $where=0, $sort=0,$params=array()){
      $recid = $this->getId();
      $uri = $recid.'#'.$fieldname;
      $domid = $uri.'-'.rand();
      if (is_string($params)) {
          parse_str($params, $tmp);
          $params = $tmp;
      }


    $delegate =& $this->_table->getDelegate();
    if ( isset($delegate) && method_exists($delegate, $fieldname.'__htmlValue') ){
      $methodname = $fieldname.'__htmlValue';
      $res = $delegate->$methodname($this);
      //$res = call_user_func(array(&$delegate, $fieldname.'__htmlValue'), $this);
      if ( is_string($res) and DATAFACE_USAGE_MODE == 'edit' and $this->checkPermission('edit', array('field'=>$fieldname)) and !$this->_table->isMetaField($fieldname) ){
        $res = '<span id="'.df_escape($domid).'" df:id="'.df_escape($uri).'" class="df__editable">'.$res.'</span>';
      }
      return $res;
    }

        $event = new StdClass;
        $event->record = $this;
        $event->fieldname = $fieldname;
        $event->index = $index;
        $event->where = $where;
        $event->sort = $sort;
        $event->params = $params;
        $event->out = null;

        Dataface_Application::getInstance()->fireEvent('Dataface_Record__htmlValue', $event);
        if ( isset($event->out) ){
            return $event->out;
        }

      $parent =& $this->getParentRecord();
      if ( isset($parent) and $parent->_table->hasField($fieldname) ){
       return $parent->htmlValue($fieldname, $index, $where, $sort, $params);
      }
        if (!@$params['thumbnail']) {
            $val = $this->display($fieldname, $index, $where, $sort);
        } else {
            $thumb = @$params['thumbnail'];
            $orBust = true;
            if ($thumb[strlen($thumb)-1] == '?') {
                $orBust = false;
                $thumb = substr($thumb, 0, -1);
            }
            $val = $this->thumbnail($fieldname, $thumb);
            if (!$val and !$orBust) {
                $val = $this->display($fieldname, $index, $where, $sort);
            }
        }

        $strval = $this->strval($fieldname, $index, $where, $sort);
    $field = $this->_table->getField($fieldname);
    if ( !@$field['passthru'] and $this->escapeOutput) {
        if (@$field['allowable_tags']) {
            $val = strip_tags($val, explode(',', $field['allowable_tags']));
        }
        $val = nl2br(df_escape($val));
    }
    if ( $this->secureDisplay and !Dataface_PermissionsTool::view($this, array('field'=>$fieldname)) ){
      $del =& $this->_table->getDelegate();
      if ( $del and method_exists($del, 'no_access_link') ){
        $link = $del->no_access_link($this, array('field'=>$fieldname));
        return '<a href="'.df_escape($link).'">'.$val.'</a>';
      }
    }


    //if ( $field['widget']['type'] != 'htmlarea' ) $val = htmlentities($val,ENT_COMPAT, 'UTF-8');
    //if ( $this->_table->isText($fieldname) and $field['widget']['type'] != 'htmlarea' and $field['contenttype'] != 'text/html' ) $val = nl2br($val);
        $isImage = $this->isImage($fieldname, $index, $where, $sort);
    if ($isImage or $this->_table->isBlob($fieldname) or $this->_table->isContainer($fieldname) ){
      if ( $this->getLength($fieldname, $index,$where,$sort) > 0 ){
        if ( $isImage ){
                    
          $val = '<img class="xf-container-field TEST" src="'.$val.'"';
                                        if ( !isset($params['alt']) ){
                                            $params['alt'] = $strval;
                                        }
          if ( !isset($params['width']) and isset($field['width']) ){
            $params['width'] = $field['width'];
          }
          foreach ($params as $pkey=>$pval){
            $val .= ' '.df_escape($pkey).'="'.df_escape($pval).'"';
          }
          $val .= '/>';
        } else {
          $file_icon = df_translate(
            $this->getMimetype($fieldname,$index,$where,$sort).' file icon',
            df_absolute_url(DATAFACE_URL).'/images/document_icon.gif'
            );
          $val = '<img class="xf-container-field" src="'.df_escape($file_icon).'"/><a href="'.$val.'" target="_blank"';
          foreach ($params as $pkey=>$pval){
            $val .= ' '.df_escape($pkey).'="'.df_escape($pval).'"';
          }
          $val .= '>'.df_escape($strval).' ('.df_escape($this->getMimetype($fieldname, $index,$where,$sort)).')</a>';
        }
      } else {
        $val = "(Empty)";
      }
    }
    if ( is_string($val) and DATAFACE_USAGE_MODE == 'edit' and $this->checkPermission('edit', array('field'=>$fieldname))  and !$this->_table->isMetaField($fieldname)){
      $val = '<span id="'.df_escape($domid).'" df:id="'.df_escape($uri).'" class="df__editable">'.$val.'</span>';
    }
    return $val;



  }









}
?>