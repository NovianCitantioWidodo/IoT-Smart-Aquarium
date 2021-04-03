import processing.serial.*;
PImage termo, botol;
float Suhu = 0;        
float LDR = 0;    
float Tinggi = 0;
Serial myPort;
int val;
int ButtonValueY = 0;
int ButtonValueR = 0;
int ButtonValueG = 0;
int ButtonValueB = 0;
int clickflag = 0;
String r, g, b, k;

void setup() {
  size(550, 300); 
  smooth();
  String portName = Serial.list()[0];
  myPort = new Serial(this, portName, 9600);
  background(255, 255, 255);
}

void draw() {
  r = "TERMOMETER";
  g = "INTENSITAS\n   CAHAYA";
  b = "         LEVEL\nKETINGGIAN AIR";
  k = "R              E             A             L             -             M             I";
  fill (255, 0, 0);  text (r, 30, 200);
  fill (255, 255, 0);  text (g, 205, 200);
  fill (0, 0, 255);  text (b, 395, 200);
  fill (0, 0, 0);  text (k, 120, 290);
  termo = loadImage("termo.jpg");
  botol = loadImage("botol.jpg");
  
  String inString = myPort.readStringUntil('\n');
  if (inString != null) {
    inString = trim(inString);
    float[] sensor = float(split(inString, ","));
    if (sensor.length >=3) {
    Suhu = map(sensor[0], 0, 100, 0, 100);
    LDR = map(sensor[1], 0, 1023, 0, 100);
    Tinggi = map(sensor[2], 0, 50, 0, 100);
    }
    println(Suhu + "   " + LDR + "   " + Tinggi);
//baris1
image(termo, -50, 0, 250, 150);
image(botol, 320, 0, 250, 150);
         if (Suhu > 50) {  
            fill(240,0,0);
            rect(52, 25, 22, 30);
            fill(240,200,0);
            rect(52, 55, 22, 30);
            fill(0,240,0);
            rect(52, 85, 22, 40);
            fill(0,240,0);
            ellipse(63, 135, 50, 20);
            }
         else if ((Suhu > 30) && (Suhu <= 50)) {
            fill(240,200,0);
            rect(52, 55, 22, 30);
            fill(0,240,0);
            rect(52, 85, 22, 40);
            fill(0,240,0);
            ellipse(63, 135, 50, 20);
           }
         else if (Suhu < 30) {
            fill(0,240,0);
            rect(52, 85, 22, 40);
            fill(0,240,0);
            ellipse(63, 135, 50, 20);
           }
         if (LDR > 10) {
          fill(255,255,0);
          ellipse(240, 80, 150, 150);
          fill(160,160,0);
          ellipse(240, 80, 100, 100);
          fill(100,100,0);
          ellipse(240, 80, 50, 50);
            }
         else if ((LDR > 1) && (LDR <= 10)) {
          fill(255,255,255);
          ellipse(240, 80, 150, 150);
          fill(160,160,0);
          ellipse(240, 80, 100, 100);
          fill(100,100,0);
          ellipse(240, 80, 50, 50);
           }
         else if (LDR < 3) {
          fill(255,255,255);
          ellipse(240, 80, 150, 150);
          fill(255,255,255);
          ellipse(240, 80, 100, 100);
          fill(100,100,0);
          ellipse(240, 80, 50, 50);
           }
         if (Tinggi > 50) {
            fill(255,255,255);
            rect(395, 55, 99, 25);
            fill(255,255,255);
            rect(395, 80, 99, 30);
            fill(0,0,160);
            rect(395, 110, 99, 30);
            }
         else if ((Tinggi > 30) && (Tinggi <= 50)) {
            fill(255,255,255);
            rect(395, 55, 99, 25);
            fill(0,0,220);
            rect(395, 80, 99, 30);
            fill(0,0,160);
            rect(395, 110, 99, 30);
           }
         else if (Tinggi < 30) {
            fill(0,0,250);
            rect(395, 55, 99, 25);
            fill(0,0,220);
            rect(395, 80, 99, 30);
            fill(0,0,160);
            rect(395, 110, 99, 30);
           }
         else {
         
         }
  }
}
