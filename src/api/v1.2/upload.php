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
    $raw_content = '{
        "version": "1.2.0",
        "timestamp":
        {
            "hour": 12,
            "minute": 44,
            "second": 21
        },
        "data":
        [
            {
                "data_type": 0,
                "data_content": 124
            },
            {
                "data_type": 1,
                "data_content": 423
            },
            {
                "data_type": 2,
                "data_content": 183
            },
            {
                "data_type": 3,
                "data_content": 1020
            }
        ],
        "devices":
        [
            {
                "device_id": 0,
                "device_ip": "192.168.1.100",
                "status": 0
            },
            {
                "device_id": 1,
                "device_ip": "192.168.1.101",
                "status": 1
            }
        ],
        "state":
        [
            {
                "pin_id": 22,
                "state": 0
            },
            {
                "pin_id": 23,
                "state": 1
            }
            {
                "pin_id": 23,
                "state": 1
            }
            {
                "pin_id": 23,
                "state": 1
            }
            {
                "pin_id": 23,
                "state": 1
            }
            {
                "pin_id": 23,
                "state": 1
            }
            {
                "pin_id": 23,
                "state": 1
            }
            {
                "pin_id": 23,
                "state": 1
            }
            {
                "pin_id": 23,
                "state": 1
            }
            v
            {
                "pin_id": 23,
                "state": 1
            }
            {
                "pin_id": 23,
                "state": 1
            }
            {
                "pin_id": 23,
                "state": 1
            }
            {
                "pin_id": 23,
                "state": 1
            }
            {
                "pin_id": 23,
                "state": 1
            }
        ]
    }';
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
    $db_connect = new DBConnectionSingleton();
    $db_connect->
?>
