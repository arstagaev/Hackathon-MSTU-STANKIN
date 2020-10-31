# Hackathon-MSTU-STANKIN

[![N|Solid](https://images-ext-1.discordapp.net/external/NdmgWy6xtpQzabOfffVcNDvS8tPiwunbaRklhy5TbzQ/http/s.pmelikov.ru/stankin_logo.png)](https://stankin.ru/)

## Описанние

   Система оптимизации и мониторинга энергопотребления, которая позволяет автоматически собирать и агрегировать данные о потреблении электроэнергии устройствами и отображать текущие данные, предсказательные данные, рекомендательные советы по снижению затрат на электропотребление, дает возможность управлять подключением устройств к электросети. 
   И все это через приложение для мобильного устройства на Android и через веб интерфейс.
   Так же есть функционал для обработки аномальных ситуаций, таких как отключение питания при перенапряжении или не запланированной нагрузке на сеть и многое другое.

**Стек решения:** *python, flask, influxdb, kotlin, php, C/С++, JS*

## Модули

### Sensor

В файле [Untitled Sketch.fzz]-- разводка платы для умной розетки.
В папке WIFI_sensor содержится проет с кодом для модуля esp8266, написанный в VS code с использованием platformIO.

### HUB

**core** - основное ядро автоматизации, написанное на языке СИ. Оно управляет GPIO интерфейсом одноплатного компьютера.
**mjpg_streamer** - локальная копия утилиты mjpg_streamer , которая осуществляет фото трансляцию в реальном времени с минимальными затратами ресурсов одноплатного компьютера
**site** - папка с самописанным фронтом и беком на php хаба.

###Server

Серввер занииается сбором информации получаемой от хаба взаимодействуя с БД, ее обработкой, а также предоставляет API для клиентских приложений и внешних систем. 


### Mobile App

