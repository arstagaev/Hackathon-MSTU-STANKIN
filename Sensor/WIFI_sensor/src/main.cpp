/*программа датчика на ESP12 тока сети  и включения реле*/
#include <Arduino.h>
#include <Arduino.h>
#include "ACS712.h"
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>

const char* ssid     = "Keenetic-6756"; //для теста
const char* password = "03403blo";

#define DEBUG

#define relay D2 
ACS712 sensor(ACS712_20A, A0);

String PostData(String);
String PostData(String ,String );
String GetData(String getHost, String getUrl,int  getHttpPort);
String GetData(String getHost, String getUrl);
void   SerialPrint(String str);

void setup() {
  Serial.begin(9600);

  //подключение к WIFI
  Serial.print("\n\rConnecting to "+ String(ssid));
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);

 while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  SerialPrint("\n\rWiFi connected\n\rstart");

  //настройка портов
  pinMode(LED_BUILTIN,1);
  pinMode(A0,0);
  pinMode(relay,1);
  int zero = sensor.calibrate();
  SerialPrint("Done! c="+String(zero));

}


void loop() {
  String host = "pmelikov.ru";
  String url = "46050/php/status.php";
  digitalWrite(LED_BUILTIN,0);

  //считывае показания тока
  String str1=String((float)analogRead(A0));  
  String Current = String(sensor.getCurrentDC());
  SerialPrint("A = "+ Current);
  SerialPrint("Requesting GET:");
  String gstr = GetData(host,url);
  if(gstr!=(String)NULL)  SerialPrint(gstr);
  else                    SerialPrint("ERROR");

  delay(500);
  //отправляем показания тока
  SerialPrint("Requesting POST:");
  SerialPrint(PostData(host+url,Current));

  //считываем статус реле 
  String getStr = GetData(host, url);
  int relauIndex = getStr.indexOf("relau1:");
  if(getStr[relauIndex+8]==1) digitalWrite(relay,0);
  else                        digitalWrite(relay,1);

  SerialPrint("closing connection");
  digitalWrite(LED_BUILTIN,1);
  delay(500);
}

//////////////////////////////////////////////////

///принимает адрес и данные для передачи и возвращает статус передачи (200 -- успешно)
String PostData(String data){
  HTTPClient http;
  http.begin("http://pmelikov.ru:46050/php/buttons.php");
  http.addHeader("Content-Type","text/plain");
  int httpCode = http.POST(data);
  String payLoad= http.getString();

  http.end();
  return String(httpCode)+" "+payLoad;
}

///принимает адрес и данные для передачи и возвращает статус передачи (200 -- успешно)
String PostData(String hosturl,String data){
  HTTPClient http;
  http.begin(hosturl);
  http.addHeader("Content-Type","text/plain");
  int httpCode = http.POST(data);
  String payLoad= http.getString();

  http.end();
  return String(httpCode)+" "+payLoad;
}

///принимает адрес и возвращает принятые данные
String GetData(String getHost, String getUrl,int  getHttpPort){
  WiFiClient client;
    
  if (!client.connect(getHost, getHttpPort)) {
    return (String)NULL;
  }
  // отправляем запрос на сервер
  client.print(String("GET ")+getUrl+" HTTP/1.1\r\nHost: "+getHost+"\r\nConnection: close\r\n\r\n");
  client.flush();     
  String str = client.readString();

  client.stop();
  delay(100); 
  if (client.connected()) { 
    client.stop();  
  }
  return str;
}

String GetData(String getHost, String getUrl){

  return GetData( getHost,  getUrl,80);
}

void SerialPrint(String str){
  #ifdef DEBUG
    Serial.println(str);
  #endif
}