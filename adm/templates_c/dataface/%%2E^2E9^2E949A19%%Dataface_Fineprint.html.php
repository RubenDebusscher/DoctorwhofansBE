<?php /* Smarty version 2.6.18, created on 2020-12-21 15:16:35
         compiled from Dataface_Fineprint.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date', 'Dataface_Fineprint.html', 21, false),array('block', 'translate', 'Dataface_Fineprint.html', 22, false),)), $this); ?>
<div class="fineprint">
<?php ob_start(); ?><?php echo ((is_array($_tmp='Y')) ? $this->_run_mod_handler('date', true, $_tmp) : date($_tmp)); ?>
<?php $this->_smarty_vars['capture']['currYear'] = ob_get_contents();  $this->assign('currYear', ob_get_contents());ob_end_clean(); ?>
<?php $this->_tag_stack[] = array('translate', array('id' => "templates.Dataface_Fineprint.POWERED_BY_DATAFACE")); $_block_repeat=true;$this->_plugins['block']['translate'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Powered by <a href="http://xataface.com">Xataface</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['translate'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><br/>
<?php $this->_tag_stack[] = array('translate', array('id' => "templates.Dataface_Fineprint.COPYRIGHT",'year' => "2005-".($this->_tpl_vars['currYear']))); $_block_repeat=true;$this->_plugins['block']['translate'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>(c) 2005-<?php echo $this->_tpl_vars['currYear']; ?>
 Web Lite Solutions Corp., All rights reserved<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['translate'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</div>