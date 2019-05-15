<?php
    /*
     * Copyright (c) 2018 Ningbo Foreign Language School
     * This part of program should be delivered with the whole project.
     * Partly use is not allowed.
     * Licensed under GPL-v3 Agreement
     */

     //TODO
    class RequestResponseParser
    {
        private $_raw_data;
        private $_parsed_object;

        /**
         * The $_version field use a 6-digit number to indicate versions.
         * For example, v1.1.0 will be translated into 010100, and
         * v1.2.13 will be 010213.
         */
        private $_version;

        public function __construct(string $raw_data) {
            $this->$_raw_data = $raw_data;
            $this->$_parsed_object = json_decode($_raw_data);
            
            $this->initializeVersion();
        }

        private function initializeVersion() {
            $this->_version = $_parsed_object['version'];
            switch ($this->_version) {
                case RequestVersion::VERSION_1_2:
                    $this->_version = 010200;
                    break;
                
                default:
                    throw new ParsingException('Invalid version');
            }
        }

        private function checkVersionAbove($toCompare) {
            if ($this->$_version < $toCompare) {
                throw new ParsingException('Not supported on this version:' . $this->$_version,
                        ParsingException::ERRNO_NOT_SUPPORTED);
            }
        }

        public function getTimestamp() {
            $timestamp_obj = $this->_parsed_object['timestamp'];
            return new Timestamp($timestamp_obj['hour'], $timestamp_obj['minute'], $timestamp_obj['second']);
        }
    }

    class Timestamp {
        private $_hour;
        private $_minute;
        private $_second;

        public function __construct(int $hour, $minute, $second) {
            $this->$_hour = $hour;
            $this->$_minute = $minute;
            $this->$_second = $second;
        }

        public function getHour() {
            return $this->$_hour;
        }

        public function getMinute() {
            return $this->$_minute;
        }

        public function getSecond() {
            return $this->$_second;
        }
    }

    class RequestVersion {
        public const VERSION_1_0 = '1.0.0';
        public const VERSION_1_1 = '1.1.0';
        public const VERSION_1_2 = '1.2.0';
    }

    class ParsingException extends Exception {
        public const ERRNO_VERSION = 0xFFFFFF00;
        public const ERRNO_NOT_SUPPORTED = 0xFFFFFF01;

        private $_parsing_errno;

        public function __construct($message, $parsing_errno, $code = 0, Exception $previous = null) {
            $this->$_parsing_errno = $parsing_errno;

            parent::__construct($message, $code, $previous);
        }

        public function getParsingErrno() {
            return $this->$_parsing_errno;
        }
    }
    
?>