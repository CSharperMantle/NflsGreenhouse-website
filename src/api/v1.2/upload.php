<?php
    /*
    * Copyright (c) 2018 Ningbo Foreign Language School
    * This part of program should be delivered with the whole project.
    * Partly use is not allowed.
    * Licensed under GPL-v3 Agreement
    */
    require '..\\..\\assets\\php\\shared_db.php';
    require '..\\..\\assets\\php\\shared_util.php';
    require '..\\..\\assets\\php\\shared_sql.php';
    require '..\\..\\assets\\php\\shared_json.php';
    require '..\\..\\assets\\php\\shared_const.php';

    $raw_content = file_get_contents('php://input');
    $json_content = json_decode($raw_content, true);
    $version = $json_content['version'];
    $timestamp = $json_content['timestamp'];
    $hour = $timestamp['hour'];
    $min = $timestamp['minute'];
    $sec = $timestamp['second'];
    $data = $json_content['data'];
    $air_temp = $data[0]['data_content'];
    $air_hum = $data[1]['data_content'];
    $light_value = $data[2]['data_content'];
    $ground_hum = $data[3]['data_content'];
    $state = $json_content['state'];
    $water_pump_state = $state[0]['state'];
    $fan_one_state = $state[1]['state'];
    $fan_two_state = $state[2]['state'];
    $air_cooler_state = $state[3]['state'];
    if ($state[4]['state'] == 1 && $state[5]['state'] == 0) {
        $side_window_state = 1;
    } 
    else {
        $side_window_state = 0;
    }
    if ($state[6]['state'] == 1 && $state[7]['state'] == 0) {
        $top_window_one_state = 1;
    }
    else {
        $top_window_one_state = 0;
    }
    if ($state[8]['state'] == 1 && $state[9]['state'] == 0) {
        $top_window_two_state = 1;
    }
    else {
        $top_window_two_state = 0;
    }
    if ($state[10]['state'] == 1 && $state[11]['state'] == 0) {
        $sheet_outer_state = 1;
    }
    else {
        $sheet_outer_state = 0;
    }
    if ($state[12]['state'] == 1 && $state[13]['state'] == 0) {
        $sheet_inner_state = 1;
    }
    else {
        $sheet_inner_state = 0;
    }

    $db = DBConnectionSingleton::getInstance();
    $sql_value = array($air_temp, $air_hum, $light_value, $ground_hum);
    run_query($db, INSERT_DATA_SQL, $sql_value);

    //temp
    if ($air_temp > airTempSwitchValveHigh) {
        run_query($db, INSERT_ALERT_SQL, array(AlertType::AIR_TEMP, AlertType::HIGH));
    }
    elseif ($air_temp < airHumSwitchValveLow) {
        run_query($db, INSERT_ALERT_SQL, array(AlertType::AIR_TEMP, AlertType::LOW));
    }
    else {
      run_query($db, INSERT_ALERT_SQL, array(AlertType::AIR_TEMP, AlertType::OK));
    }
    //hum
    if ($air_hum > airHumSwitchValveHigh) {
      run_query($db, INSERT_ALERT_SQL, array(AlertType::AIR_HUM, AlertType::HIGH));
    }
    elseif ($air_hum < airHumSwitchValveLow) {
      run_query($db, INSERT_ALERT_SQL, array(AlertType::AIR_HUM, AlertType::LOW));
    }
    else {
      run_query($db, INSERT_ALERT_SQL, array(AlertType::AIR_HUM, AlertType::OK));
    }
    //light
    if ($light_value > airLightSwitchValveHigh) {
      run_query($db, INSERT_ALERT_SQL, array(AlertType::AIR_LIGHT, AlertType::HIGH));
    }
    elseif ($light_value < airLightSwitchValveLow) {
      run_query($db, INSERT_ALERT_SQL, array(AlertType::AIR_LIGHT, AlertType::LOW));
    }
    else {
      run_query($db, INSERT_ALERT_SQL, array(AlertType::AIR_LIGHT, AlertType::OK));
    }
    //Ground checks - hum
    if ($ground_hum > groundHumSwitchValveHigh) {
      run_query($db, INSERT_ALERT_SQL, array(AlertType::GROUND_HUM, AlertType::LOW));
    }
    elseif ($ground_hum < groundHumSwitchValveLow) {
      run_query($db, INSERT_ALERT_SQL, array(AlertType::GROUND_HUM, AlertType::HIGH));
    }
    else {
      run_query($db, INSERT_ALERT_SQL, array(AlertType::GROUND_HUM, AlertType::OK));
    }

    $sql_value = array($water_pump_state, $fan_one_state, $fan_two_state, $air_cooler_state, $side_window_state, $top_window_one_state, $top_window_two_state,$sheet_outer_state, $sheet_inner_state); 
    run_query($db, INSERT_STATE_SQL, $sql_value);

?>
