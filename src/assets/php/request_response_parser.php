<?php
    /*
     * Copyright (c) 2018 Ningbo Foreign Language School
     * This part of program should be delivered with the whole project.
     * Partly use is not allowed.
     * Licensed under GPL-v3 Agreement
     */

    class RequestResponseParser
    {
        private $_raw_data;
        private $_parsed_object;

        private $_version;

        public function __construct(string $raw_data) {
            $this->$_raw_data = $raw_data;
            $this->$_parsed_object = json_decode($_raw_data);
        }

        private function initializeObject() {
            $this->_version = $_parsed_object['version'];
            switch ($this->_version) {
                case RequestVersion::VERSION_1_2:
                    # code...
                    break;
                
                default:
                    throw new ParsingException('Invalid version');
            }
        }
    }

    class RequestVersion {
        public const VERSION_1_0 = '1.0.0';
        public const VERSION_1_1 = '1.1.0';
        public const VERSION_1_2 = '1.2.0';
    }

    class ParsingException extends Exception {
        public const ERRNO_VERSION = 0xFFFFFF00;

        public function __construct($message, $code = 0, Exception $previous = null) {
            parent::__construct($message, $code, $previous);
        }
    }
    
?>