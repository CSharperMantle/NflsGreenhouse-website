# Smart Greenhouse Project of NFLS - Website Module

## General introduction
The Smart Greenhouse Project is built for NFLS. This project is a part of NFLS' Smart Campus roadmap.
This project consists of 3 modules, the SoC module, the Website module and the Distributed Data Collection module.

## Introduction to this module
This module contains the essential code for the web service. A GUI and DB operating system is included.

## Installation & requirements
* PHP7+ required
* `session.auto_start=1` required
* Should add `.../NflsWatering/src/pages-404.html` as the 404-error page

## API
APIs are provided in RESTful or XML-like styles.
```
website |--api
        |   |--v1.0 = SOAP APIs
        |   |   |--upload.php
        |   |--v1.1 = RESTful APIs
        |   |   |--upload.php
        |   |--v2.0 = RESTful APIs, master-slave seperated
        |   |   |--upload.php
        |   |   |--fetch.php
        |   |--internal = Internal APIs
```
