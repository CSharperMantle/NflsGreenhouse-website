<?php
  /*
   * Copyright (c) 2018 Ningbo Foreign Language School
   * This part of program should be delivered with the whole project.
   * Partly use is not allowed.
   * Licensed under GPL-v3 Agreement
   */
  require 'assets\\php\\shared_sql.php';
  require 'assets\\php\\shared_db.php';
  require 'assets\\php\\shared_html.php';
  require 'assets\\php\\shared_xml.php';
  require 'assets\\php\\shared_const.php';
  
  $state = run_query_fetch($db, FETCH_LATEST_STATE_SQL);
  $water_pump_state = $state['water_pump'];
  $fan_one_state = $state['fan_one'];
  $fan_two_state = $state['fan_two'];
  $air_cooler_state = $state['air_cooler'];
?>

