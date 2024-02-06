
![Banner](https://github.com/parikshitpagare/parcel-tracking-rtos/assets/80714882/b583883e-9307-42d7-95ae-83d136bc14aa)

<p align="center">
   <img src="https://img.shields.io/badge/ESPRESSIF-ESP32-E7352C?style=for-the-badge&logo=espressif&logoColor=white" >
   <img src="https://img.shields.io/badge/FreeRTOS-4bbb4f?style=for-the-badge">
   <img src="https://img.shields.io/badge/APACHE2-D22128?style=for-the-badge&logo=apache&logoColor=white"">
   <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white"">
   <img src="https://img.shields.io/badge/MYSQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white"">
   <img src="https://img.shields.io/badge/LICENSE-MIT-green?style=for-the-badge" >
</p>

<p align="center">
Parcel tracking and monitoring system developed on ESP32 microcontroller using FreeRTOS that can track location, sense vibration and monitor temperature. The system transmits data via GPRS to a web server for displaying real time updates on a website.
</p>

# About

- A system is developed that can be used by a logistic company to track the exact location during transport of sensitive goods and also monitor the environment on a continuous basis in real time.
  
- For monitoring the environment and visualizing the data collected from all the sensors, a website is developed and deployed on a server. 
  
- The web server receives the data periodically from the GSM module and the data is displayed on the website.

- A dynamic website is implemented where a user can view updated data without the need to refresh the page. The user can see real time graphical updates as well as the previous data received
for better understanding of the conditions.

# Features

- Location Tracking using Quectel L89H GNSS module
- Temperature sensing using DHT11 sensor
- Vibration intensity sensing using ADXL335 accelerometer
- Activity monitoring on OLED display
- Dedicated Website for real time visual updates
- Wireless data transfer to Web Server using SIM800L GSM module

# Proposed System and Overview

The project implementation requires a combination of hardware and software which is developed separately.

The implementation is divided in two categories,

- Embedded System
- Web Development

## Embedded System

The Embedded system is based on a 32-bit high performance microcontroller which is the
brain of the system. For performing all the tasks simultaneously, Real Time Operating System (RTOS)
is running on top of the bare metal microcontroller. The tasks are implemented as follows,

<p align="center">
	<img src="https://github.com/parikshitpagare/parcel-tracking-rtos/assets/80714882/230a8215-18b8-4757-a96c-3a3f6fe07222" width="80%" height="80%">
</p>

- For temperature monitoring a digital temperature sensor is integrated with one of the GPIO pins of the microcontroller.

- For sensing vibration a 3-axis accelerometer is integrated with ADC pins of the microcontroller which can compute the intensity of vibration in X, Y and Z axis.

- To get an exact location, a GNSS module is used which can acquire and track multiple satellite systems like GPS, IRNSS, GLONASS, BeiDou, Galileo and QZSS. The integration with microcontroller is done using UART communication protocol.

- To transmit the data collected from above sensors to a web server, a GSM module is integrated using the UART communication protocol. The data is sent to the web server wirelessly via GPRS.

- To get visual updates, a small OLED display is integrated with the microcontroller using I2C communication protocol.

- A RGB led is also used to indicate the status of the system.


## Web Development

### Web Server Overview

For transferring the data to the web server, HTTP protocol is implemented which is based on the request-response model of communication. All the data is sent from GSM module via a URL to
the web server.

- All the operations for parsing and storing the data is done at back-end which is popularly known as server-side processing.

- The client-side processing involves displaying the data on the website page which is accessible to the user.

  <p align="center">
	<img src="https://github.com/parikshitpagare/parcel-tracking-rtos/assets/80714882/e6aaf996-78f5-4700-8ff2-18d352d89711" width="85%" height="85%">
</p>

# Embedded System Requirements

## Hardware

- ESP32 Microcontroller
- DHT11 Temperature sensor
- ADXL335 Accelerometer
- Quectel L89H GNSS module
- SIM800L V2.0 GSM module
- OLED display
- RGB Led

## Schematic

<p align="center">
	<img src="schematic_parcel_tracking_rtos.png" width="80%" height="80%">
</p>

## Software

To program the microcontroller **Arduino IDE** is used which is compatible with ESP32. 

### How to connect ESP32 with Arduino IDE?

- Download and install the Arduino IDE
- Install the ESP32 Library at `File -> Preference -> Additional Boards Manager URLs:` https://raw.githubusercontent.com/espressif/arduino-esp32/gh-pages/package_esp32_index.json
- Then in the `Tools -> Board Manager` -> search for ESP32 and install

### Libraries 

Certain libraries are required for proper functioning of the microcontroller and interfaced components.

<table>
  <tr>
    <th>Components/Modules</th>
    <th>Library</th>
  </tr>
  <tr>
    <td>DHT 11</td>
    <td>Adafruit Unified Sensor, Adafruit DHT Sensor</td>
  </tr>
  <tr>
    <td>L89H GNSS</td>
    <td>TinyGPSPlus</td>
  </tr>
  <tr>
    <td>OLED Display</td>
    <td>Adafruit SSD1306, Adafruit BusIO, Adafruit GFX </td>
  </tr>
</table>

<br>

<table>
  <tr>
    <th>Protocol</th>
    <th>Library</th>
  </tr>
  <tr>
    <td>UART</td>
    <td>Hardware Serial (Part of Arduino IDE)</td>
  </tr>
  <tr>
    <td>I2C</td>
    <td>Wire (Part of Arduino IDE)</td>
  </tr>
</table>

## Power

- Each sensor/module have different power requirements which need to be considered in the design. Most of the breakout boards used in the project have a voltage regulator which enables use of common voltage of 5V available on the microcontroller development board itself.

- But there is a limitation of current that can be drawn from the microcontroller. To tackle this problem, two **18650 Li-Ion batteries** coupled with a **AP62301 5V 2A buck converter** is implemented.

# Web Development Requirements

## Hardware

For the website to be online and available, it is required to be hosted on a server. There are two options that can be implemented.

- Shared Hosting (GoDaddy, Hostinger, etc.).
- Virtual Private Server (VPS) which is provided as ‘Infrastructure as a Service (IaaS)’ by many vendors (Digital Ocean, Linode, etc.).

The website for this project is deployed on a VPS provided by Digital Ocean.

## Web Application Stack

The VPS is a bare-metal server with an operating system installed on top of it. For deploying the website following packages are installed,

<table>
  <tr>
    <th>Package</th>
    <th>Use</th>
  </tr>
  <tr>
    <td>Ubuntu 22.04 (LTS) x64</td>
    <td>Operating system</td>
  </tr>
  <tr>
    <td>Apache2</td>
    <td>Web server</td>
  </tr>
  <tr>
    <td>PHP</td>
    <td>Server-side scripting engine</td>
  </tr>
  <tr>
    <td>MySQL</td>
    <td>RDBMS to store all the incoming data</td>
  </tr>
  <tr>
    <td>phpMyAdmin</td>
    <td>GUI to handle the administration of MySQL over the web</td>
  </tr>
</table>

This stack is commonly known as the LAMP Stack where,

 - L : Linux
 - A : Apache
 - M : MySQL
 - P : PHP

## Dependencies

For developing the front-end and back-end of the website, few frameworks and API’s are made use of. Instead of installing a package manager to use the frameworks, the CDN’s of these frameworks are included, which are placed in the header tag of the HTML document.

<table>
  <tr>
    <th>Dependencies</th>
    <th>Use</th>
  </tr>
  <tr>
    <td>Bootstrap</td>
    <td>Front-end toolkit for front-end development</td>
  </tr>
  <tr>
    <td>jQuery</td>
    <td>JavaScript Library for simpler Javascript coding</td>
  </tr>
  <tr>
    <td>Chart.js</td>
    <td>JavaScript charting library for creating graphs and charts</td>
  </tr>
  <tr>
    <td>Datatables</td>
    <td>Plug-in for the jQuery Javascript library to build advanced tables</td>
  </tr>
  <tr>
    <td>Leaflet</td>
    <td>JavaScript library for mobile-friendly interactive maps</td>
  </tr>
</table>

# Implementation & Working

## RTOS Implementation

The Real Time Operating System (RTOS) used in this project is called FreeRTOS which is a class of RTOS that is designed to be small enough to run on a microcontroller.

<p align="center">
	<img src="https://github.com/parikshitpagare/parcel-tracking-rtos/assets/80714882/cfe3aa7c-00a0-42d4-9bd6-ae1c280785a0" width="85%" height="85%">
</p>

### Scheduler

- In the application developed for this project, all tasks are given same priorities giving each task equal importance. 

- Some tasks like temperature monitoring and acquiring location are given a
delay of 5000ms as there is no need for them to be executed every 1ms.

Creating a task delay in FreeRTOS using the API `vTaskDelay()`,

`vTaskDelay(5000 / portTICK_PERIOD_MS);`

### Tasks

Tasks are small pieces of code that run independently based on the scheduling algorithm implemented in the RTOS. In FreeRTOS a task is created using the API `xTaskCreatePinnedToCore()`

### Queues and Data Passing

A queue in RTOS is a kernel object that is capable of passing information between tasks without incurring overwrites from other tasks or entering into a race condition. 

<p align="center">
	<img src="https://github.com/parikshitpagare/parcel-tracking-rtos/assets/80714882/f8d0b57e-77bc-4612-9df0-1ac16fb687c8" width="85%" height="85%">
</p>

A queue has following API’s in FreeRTOS which are implemented in the application,

 - `xQueueCreate()` : Create a queue.
 - `xQueueSend()` : Send data through the queue.
 - `xQueueRecieve()` : Receive data from the queue.

## Location Tracking

