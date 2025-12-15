<?php

//
// Copyright (C) 2018-2020 ProgSI (contact@progsi.ma)
//

if (!defined('KANPROSPECTS_VERSION'))
  define('KANPROSPECTS_VERSION', '1.7');

if (!defined('module'))
  define('module', 'kanprospects');

if (!defined('LIB_URL_ROOT'))
  define('LIB_URL_ROOT', KANPROSPECTS_URL_ROOT . '/lib');

if (!defined('mytitle'))
  define('mytitle', 'Kanban');

// raccourci pour le MAIN_DB_PREFIX
if (!defined('LLX_'))
  define('LLX_', MAIN_DB_PREFIX);


include_once('rights.php');

