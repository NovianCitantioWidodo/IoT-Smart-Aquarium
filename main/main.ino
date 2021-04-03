#include <ESP8266WiFi.h>
#include <WiFiClient.h>
#include <ESP8266HTTPClient.h>
#include <ArduinoJson.h>
#include <OneWire.h>
#include <DallasTemperature.h>
#include <Servo.h>

const char * wifiName = "House2White";
const char * wifiPass = "hematair";
const char * host = "http://karyasa.web.id/app/fetch.php";
const int oneWireBus = D8;

Servo servo;
OneWire oneWire(oneWireBus);
DallasTemperature sensors( & oneWire);
int LDR = A0, statusAuto, statusPompa, statusLampu, statusPakan;
String jam;
float NilaiJarak = 0, temperatureC = 0, NilaiLDR = 0;
#define echoPin D6 //12
#define trigPin D7 //11
long duration, distance; //waktu untuk kalkulasi jarak

void setup() {
  Serial.begin(9600);
  Serial.print("Connecting to ");
  Serial.println(wifiName);
  WiFi.begin(wifiName, wifiPass);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP()); //You can get IP address assigned to ESP

  pinMode(trigPin, OUTPUT);
  pinMode(echoPin, INPUT);
  pinMode(D1, OUTPUT);
  pinMode(D2, OUTPUT);
  pinMode(LDR, INPUT);
  sensors.begin();
  servo.attach(D0);
  servo.write(0);
}

void loop() {
  HTTPClient http; //Declare object of class HTTPClient
//  Serial.print("Request Link:");
//  Serial.println(host);
  http.begin(host); //Specify request destination
  int httpCode = http.GET(); //Send the request
  String payload = http.getString(); //Get the response payload from server
  //  Serial.print("Response Code:"); //200 is OK
  //  Serial.println(httpCode); //Print HTTP return code
  //  Serial.print("Returned data from Server:");
  //  Serial.println(payload); //Print request response payload
  if (httpCode == 200) {
    const size_t capacity = JSON_OBJECT_SIZE(9);
    DynamicJsonBuffer jsonBuffer(capacity);
    JsonObject & root = jsonBuffer.parseObject(payload);
    if (!root.success()) {
      Serial.println(F("Parsing failed!"));
      return;
    }
    statusAuto = root["otomatis"];
    statusPompa = root["pompa"];
    statusLampu = root["lampu"];
    statusPakan = root["pakan"];
    KatupPakan();
    SensorSuhu();
    SensorCahaya();
    SensorTinggi();
    String request = "http://karyasa.web.id/app/sensor.php?jarak=" + String(NilaiJarak) + "&suhu=" + String(temperatureC) + "&intensitas=" + String(NilaiLDR) + "&pompa=" + String(statusPompa) + "&lampu=" + String(statusLampu) + "&pakan=" + String(statusPakan);
    Serial.print("\n");
//    Serial.println(request);
    http.begin(request);
    http.GET();
    http.end(); //Close connection
  } else {
    Serial.println("Error in response");
  }
  delay(1000);
}

float SensorTinggi() {
  digitalWrite(trigPin, LOW);
  delayMicroseconds(2);
  digitalWrite(trigPin, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin, LOW);
  duration = pulseIn(echoPin, HIGH);
  NilaiJarak = duration / 29.1;
//  Serial.print("Tinggi: ");
  Serial.print(",");
  Serial.print(NilaiJarak);
  if (statusAuto == 1) {
    if (NilaiJarak >= 0 && NilaiJarak <= 10) {
//      Serial.print(" Full!! ;");
      digitalWrite(D2, HIGH);
      statusPompa = 0;
//      Serial.print(" Pompa Mati ;");
    } else if (NilaiJarak >= 11) {
//      Serial.print(" Hampir Meluap ;");
      digitalWrite(D2, LOW);
      statusPompa = 1;
//      Serial.print(" Pompa Nyala ;");
    }
  } else {
    digitalWrite(D2, !statusPompa);
  }
}

float SensorSuhu() {
  sensors.requestTemperatures();
  temperatureC = sensors.getTempCByIndex(0);
  temperatureC = 29.4;
  Serial.print(temperatureC);
//  Serial.print("29");
}

float SensorCahaya() {
  int InputSensor = analogRead(LDR);
  NilaiLDR = InputSensor;
//  Serial.print(" LDR = ");
  Serial.print(",");
  Serial.print(NilaiLDR);
  if (statusAuto == 1) {
    if (NilaiLDR < 10) {
      digitalWrite(D1, LOW);
      statusLampu = 0;
//      Serial.print(" Lampu Dekorasi Nyala ");
    } else if (NilaiLDR >= 10) {
      digitalWrite(D1, HIGH);
      statusLampu = 1;
//      Serial.print(" Lampu Dekorasi Mati ");
    }
  } else {
    digitalWrite(D1, statusLampu);
  }
}
void KatupPakan() {
  if (statusAuto == 1) {
    servo.write(0);
    if (jam == "07:00" || jam == "16:00") {
//      Serial.print("; Servo On");
      statusPakan = 1;
  servo.write(60);
      delay(150);
  servo.write(0);
      delay(150);
    } else
    statusPakan = 0;
    servo.write(0);
  }
  
  else{
    if (statusPakan == 1) {
//      Serial.print("; Servo On");
  servo.write(60);
      delay(150);
  servo.write(0);
      delay(150);
    }
    else {
//      Serial.print("; Servo Off");
  servo.write(0);
    }
  }
}
