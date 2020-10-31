#include <sys/types.h>
#include <sys/stat.h>
#include <sys/fcntl.h>
#include <unistd.h>    // read/write usleep
#include <inttypes.h>  // uint8_t, etc
#include <stdio.h>
#include <stdlib.h>
#include <linux/i2c-dev.h>
#include <sys/ioctl.h>
#include <fcntl.h>
#include <unistd.h>
#include <wiringPi.h>
#include <wiringPiI2C.h>
#include <stdlib.h> //shell commands

#include <mcp23017.h>
#include <stdlib.h> //shell commands
#define START_EXTERNAL_GPIO_NUMERATION_FROM 100
#define PIN_LED_1 (START_EXTERNAL_GPIO_NUMERATION_FROM+0)
#define PIN_LED_2 (START_EXTERNAL_GPIO_NUMERATION_FROM+1)
#define PIN_LED_3 (START_EXTERNAL_GPIO_NUMERATION_FROM+2)
#define PIN_LED_4 (START_EXTERNAL_GPIO_NUMERATION_FROM+3)
#define PIN_LED_5 (START_EXTERNAL_GPIO_NUMERATION_FROM+4)
#define PIN_LED_6 (START_EXTERNAL_GPIO_NUMERATION_FROM+5)
#define PIN_LED_7 (START_EXTERNAL_GPIO_NUMERATION_FROM+6)
#define PIN_LED_8 (START_EXTERNAL_GPIO_NUMERATION_FROM+7)
#define PIN_BUTTON_1 (START_EXTERNAL_GPIO_NUMERATION_FROM+11)
#define PIN_BUTTON_2 (START_EXTERNAL_GPIO_NUMERATION_FROM+12)
#define PIN_BUTTON_3 (START_EXTERNAL_GPIO_NUMERATION_FROM+13)
#define PIN_BUTTON_4 (START_EXTERNAL_GPIO_NUMERATION_FROM+14)
#define PIN_BUTTON_5 (START_EXTERNAL_GPIO_NUMERATION_FROM+15)

int gpio_number = 100; //100-условно. Нумерация gpio mcp23017 будет начинаться после этого числа
int n[8] = //LEDS ARRAY
{
PIN_LED_1,
PIN_LED_2,
PIN_LED_3,
PIN_LED_4,
PIN_LED_5,
PIN_LED_6,
PIN_LED_7,
PIN_LED_8,
};

#define PIN_RELAY0 0 //пин, реле обогревателя 
#define PIN_RELAY1 1 //пин,реле освещения 
#define PIN_RELAY2 7 //пин,реле вентиляции 
#define PIN_RELAY3 2 //пин,реле увлажнителя 
#define PIN_BIPPER 3 //пин, пищалка

/////////////csv_read/////////
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#define MAXFLDS 200     /* maximum possible number of fields */
#define MAXFLDSIZE 32   /* longest possible field + 1 = 31 byte field */
//////////////csv_read/////////


int handle0, handle1;
int lux, word_id,  lux0, lux1;
float cTemp;
float fTemp;
float humidity;
float cTemp1;
float fTemp1;
float humidity1;
		
 //char manual_turn_on0, manual_turn_on1, manual_turn_on2, manual_turn_on3;

double settings_array[2][40]; //3 строки csv файла, но используем только две
int allow_array[6]; //массив разрешений

/////////////////ads1015///////////////////
int i2c_handle_ads1015; //для хранения i2c сессии с АЦП ads1015
float gas_array[6]; //для хранения значений содержиния газов
float gas_current_array[6]; //массив с текущими показателями с датчиков газа
// Note ads1015 defaults to 0x48!
int asd_address = 0x48;
const float VPS = 4.096 / 32768.0; // volts per step
int16_t val;
uint8_t writeBuf[3];
uint8_t readBuf[2];
float myfloat; //myfloat -газ в милливольтах
/////////////////ads1015///////////////////

int trigger[4];//чтобы кнопки сделать с зещёлкой

int digitalInvertedRead (int pin)
{
	switch(pin) {
case PIN_RELAY0:
     if (digitalRead(pin)) {digitalWrite  (PIN_LED_1, 1);} else {digitalWrite  (PIN_LED_1, 0);}
   break;
case PIN_RELAY1:
	if (digitalRead(pin)) {digitalWrite  (PIN_LED_2, 1);} else {digitalWrite  (PIN_LED_2, 0);}
   break;
case PIN_RELAY2:
	if (digitalRead(pin)) {digitalWrite  (PIN_LED_3, 1);} else {digitalWrite  (PIN_LED_3, 0);}
   break;
case PIN_RELAY3:
	if (digitalRead(pin)) {digitalWrite  (PIN_LED_4, 1);} else {digitalWrite  (PIN_LED_4, 0);}
	break;
  }
	return (!digitalRead(pin));
	//return (digitalRead(pin));
}

int digitalInvertedWrite (int pin, int state)
{
	if (state == 0) 
	{
	if (digitalInvertedRead (pin))
	{
		digitalWrite (pin, 1);
	digitalWrite (PIN_BIPPER, 1);
	delay (20);
	digitalWrite (PIN_BIPPER, 0);
	}
	}
	else 
	{
	if (!digitalInvertedRead (pin))
	{
	digitalWrite (pin, 0);
	digitalWrite (PIN_BIPPER, 1);
	delay (20);
	digitalWrite (PIN_BIPPER, 0);
	}
	}
	
	//digitalWrite (pin, state);
}
//////bh1750/////
int get_sht30 (int handle_id)
{   

   //wiringPiI2CWrite(handle, 0x10); // Continously measurement at 1 lx resolution. Measurement Time is typically 120ms.
    wiringPiI2CWrite(handle_id, 0x21);   // One-time measurement at 0.5 lx resolution. Measurement Time is typically 120ms. It is automatically set to Power Down mode after measurement.
    delay (130);
    word_id = wiringPiI2CReadReg16(handle_id, 0x00);
    lux = ((word_id & 0xff00)>>8) | ((word_id & 0x00ff)<<8);
//    printf("%d Lux %d\n", lux, handle_id);
	return (lux);
}
//////bh1750/////

//////csv_read/////
void parse( char *record, char *delim, char arr[][MAXFLDSIZE],int *fldcnt)
{
    char*p=strtok(record,delim);
    int fld=0;
    
    while(p)
    {
        strcpy(arr[fld],p);
		fld++;
		p=strtok('\0',delim);
	}		
	*fldcnt=fld;
}
//////csv_read/////

//////csv_read_settings/////
int parse_settings_function (char *field, int recordcnt, int i)
{
	double x = atof(field); //преобразуем char в double
	//printf("%f\n", x); 
	switch(recordcnt) {
case 1:
     return -1; //первую строку csv файла игнорируем
   break;
case 2:
		settings_array[0][i]=x;
	//	printf("settings_array[0][%d]: %f\n", i, settings_array[0][i]);
   break;
case 3:
		settings_array[1][i]=x;
	//	printf("settings_array[1][%d]: %f\n", i, settings_array[1][i]);
   break;
  }
}

//////csv_read_settings/////

int check_auto (int pin, int check_for_what, int state) //check_for_what=0, если проверяет ручн. - при авто = 1
{
if (check_for_what == 0)  //ручной режим, определяем разрешаем вкл. выкл пин
{	
	if (state == 1) //если ручной режим хочет что-то включить
	{	
	switch(pin) {
	case PIN_RELAY2: //вентиляция
		return 1;
		break;
		
	case PIN_RELAY0:	//обогреватель
		if ( settings_array[1][6] == 1)
		{if (/*settings_array[0][12] <  cTemp && */settings_array[0][13] > cTemp) {return 1;} else {return 0;}}
		else {return 1;}
	case PIN_RELAY3:	//влажность
		if ( settings_array[1][7] == 1)
		{if (settings_array[0][15] > humidity) {return 1;} else {return 0;}}
		else {return 1;}
	case PIN_RELAY1:	//освещенность
		if ( settings_array[1][8] == 1)
		{if (settings_array[0][17] > lux0) {return 1;} else {return 0;}}
		else {return 1;}
		//return 1;
		break;
	}
	}	
    else
	{
	switch(pin) {
	case PIN_RELAY2: //вентиляция
		if ( settings_array[1][0] == 1)
		{if (settings_array[0][1] > gas_current_array[0]) {allow_array[0]=1;} else {allow_array[0]=0;}}
		if ( settings_array[1][1] == 1)
		{if (settings_array[0][3] > gas_current_array[1]) {allow_array[1]=1;} else {allow_array[1]=0;}}
		if ( settings_array[1][2] == 1)
		{if (settings_array[0][5] > gas_current_array[2]) {allow_array[2]=1;} else {allow_array[2]=0;}}
		if ( settings_array[1][3] == 1)
		{if (settings_array[0][7] > gas_current_array[3]) {allow_array[3]=1;} else {allow_array[3]=0;}}
		if ( settings_array[1][4] == 1)
		{if (settings_array[0][9] > gas_current_array[4]) {allow_array[4]=1;} else {allow_array[4]=0;}}
		if ( settings_array[1][5] == 1)
		{if (settings_array[0][11] > gas_current_array[5]) {allow_array[5]=1;} else {allow_array[5]=0;}}
		if (allow_array[0]==0&&allow_array[1]==0&&allow_array[2]==0&&allow_array[3]==0&&allow_array[4]==0&&allow_array[5]==0){return 1;}
		else {return 1;}		
		break;
	case PIN_RELAY0:	//обогреватель
		if ( settings_array[1][6] == 1)
		{if (/*settings_array[0][12] <  cTemp && */settings_array[0][13] > cTemp) {return 1;} else {return 0;}}
		else {return 1;}
	case PIN_RELAY3:	//влажность
		if ( settings_array[1][7] == 1)
	{if (settings_array[0][14] <  humidity || !(settings_array[0][15] >  humidity)) {return 1;} else {return 0;}}
		else {return 1;}
	case PIN_RELAY1:	//освещенность
		if ( settings_array[1][8] == 1)
	{if (settings_array[0][16] <  lux0 && lux1 > settings_array[0][22]) {return 1;} else {return 0;}} //lux1 -снаружи

		else {return 1;}
	}		
	}  
}
if (check_for_what == 1) //значит авто и не просто разрешаем вкл. выкл пин, а непосредственно включаем или выключаем его
{
	if (state == 1) //если авто режим хочет что-то включить
	{
	//return 1;
	//delay (500);
	switch(pin) {
	case PIN_RELAY2: //вентиляция
		if ( settings_array[1][0] == 1.0)
		{if (settings_array[0][1] < gas_current_array[0]) {allow_array[0]=1;} else {allow_array[0]=0;}}
		else {allow_array[0]=0;}
		if ( settings_array[1][1] == 1.0)
		{if (settings_array[0][3] < gas_current_array[1]) {allow_array[1]=1;} else {allow_array[1]=0;}}
		else {allow_array[1]=0;}
		if ( settings_array[1][2] == 1.0)
		{if (settings_array[0][5] < gas_current_array[2]) {allow_array[2]=1;} else {allow_array[2]=0;}}
		else {allow_array[2]=0;}
		if ( settings_array[1][3] == 1.0)
		{if (settings_array[0][7] < gas_current_array[3]) {allow_array[3]=1;} else {allow_array[3]=0;}}
		else {allow_array[3]=0;}	
		if ( settings_array[1][4] == 1.0)
		{if (settings_array[0][9] < gas_current_array[4]) {allow_array[4]=1;} else {allow_array[4]=0;}}
		else {allow_array[4]=0;}	
		if ( settings_array[1][5] == 1.0)
		{if (settings_array[0][11] < gas_current_array[5]) {allow_array[5]=1;} else {allow_array[5]=0;}}
		else {allow_array[5]=0;}	
		if (allow_array[0]==1||allow_array[1]==1||allow_array[2]==1||allow_array[3]==1||allow_array[4]==1||allow_array[5]==1){return 1;}
		else {return 0;}
		break;
		
	case PIN_RELAY0:	//обогреватель
		if ( settings_array[1][6] == 1.0)
		{if (/*settings_array[0][12] <  cTemp && */settings_array[0][12] > cTemp) {return 1;} else {return 0;}}
		else {return 0;}
	case PIN_RELAY3:	//влажность
		if ( settings_array[1][7] == 1.0)
		{if ((settings_array[0][14] >  humidity) && (settings_array[0][15] > humidity)) {return 1;} else {return 0;}}
		else {return 0;}
	case PIN_RELAY1:	//освещенность
		if ( settings_array[1][8] == 1.0)
		{
		if (settings_array[0][16] > lux0 || lux1 < settings_array[0][22]) {return 1;} else {return 0;}}
		else {return 0;}
		//return 1;
		break;
	}
	}
	if (state == 0) //если авто режим хочет что-то выключить
	{
	switch(pin) {
	case PIN_RELAY2: //вентиляция
		if ( settings_array[1][0] == 1.0)
		{if (settings_array[0][0] > gas_current_array[0]) {allow_array[0]=1;} else {allow_array[0]=0;}}
		if ( settings_array[1][1] == 1.0)
		{if (settings_array[0][2] > gas_current_array[1]) {allow_array[1]=1;} else {allow_array[1]=0;}}
		if ( settings_array[1][2] == 1.0)
		{if (settings_array[0][4] > gas_current_array[2]) {allow_array[2]=1;} else {allow_array[2]=0;}}
		if ( settings_array[1][3] == 1.0)
		{if (settings_array[0][6] > gas_current_array[3]) {allow_array[3]=1;} else {allow_array[3]=0;}}
		if ( settings_array[1][4] == 1.0)
		{if (settings_array[0][8] > gas_current_array[4]) {allow_array[4]=1;} else {allow_array[4]=0;}}
		if ( settings_array[1][5] == 1.0)
		{if (settings_array[0][9] > gas_current_array[5]) {allow_array[5]=1;} else {allow_array[5]=0;}}
		if (allow_array[0]==1&&allow_array[1]==1&&allow_array[2]==1&&allow_array[3]==1&&allow_array[4]==1&&allow_array[5]==1){return 1;}
		else {return 0;}
		break;
	case PIN_RELAY0:	//обогреватель
		if ( settings_array[1][6] == 1.0)
		{if (/*settings_array[0][12] <  cTemp && */settings_array[0][13] <= cTemp) {return 1;} else {return 0;}}
		else {return 0;}
	case PIN_RELAY3:	//влажность
		if ( settings_array[1][7] == 1.0)
	{if (settings_array[0][15] <=  humidity) {return 1;} else {return 0;}}
		else {return 0;}
	case PIN_RELAY1:	//освещенность
		if ( settings_array[1][8] == 1.0)
	{
		if (lux1 > settings_array[0][22]) {return 1;} else {return 0;}} //lux1 -снаружи
		else {return 0;}
	}		
	}
}

//return 1;
}

//////buttons/////
int buttons_function (char *manual_turn_on, int recordcnt)
{ 
if (recordcnt == 1)
{	
if (atoi(manual_turn_on)==1) 
{if ( /*digitalInvertedRead  (PIN_RELAY0) &&*/ check_auto (PIN_RELAY0, 0, 1))
	{digitalInvertedWrite  (PIN_RELAY0, 1);}
} 
else 
{if (atoi(manual_turn_on)==0 &&check_auto (PIN_RELAY0, 0, 0))
	{digitalInvertedWrite  (PIN_RELAY0, 0);}
}
}


if (recordcnt == 2)
{	
if (atoi(manual_turn_on)==1) 
{if ( /*digitalInvertedRead  (PIN_RELAY1) &&*/ check_auto (PIN_RELAY1, 0, 1))
	{digitalInvertedWrite  (PIN_RELAY1, 1);}
} 
else 
{if (atoi(manual_turn_on)==0 &&check_auto (PIN_RELAY1, 0, 0))
	{digitalInvertedWrite  (PIN_RELAY1, 0);}
}
}


if (recordcnt == 3)
{	
if (atoi(manual_turn_on)==1) 
{if ( /*digitalInvertedRead  (PIN_RELAY2) &&*/ check_auto (PIN_RELAY2, 0, 1))
	{digitalInvertedWrite  (PIN_RELAY2, 1);}
} 
else 
{if (atoi(manual_turn_on)==0 &&check_auto (PIN_RELAY2, 0, 0))
	{digitalInvertedWrite  (PIN_RELAY2, 0);}
}
}


if (recordcnt == 4)
{	
if (atoi(manual_turn_on)==1) 
{if ( /*digitalInvertedRead  (PIN_RELAY0) &&*/ check_auto (PIN_RELAY3, 0, 1))
	{digitalInvertedWrite  (PIN_RELAY3, 1);}
} 
else 
{if (atoi(manual_turn_on)==0 &&check_auto (PIN_RELAY3, 0, 0))
	{digitalInvertedWrite  (PIN_RELAY3, 0);}
}
}
}
//////buttons/////

/////////////////ads1015///////////////////
void read_ads1015() {
  // open device on /dev/i2c-1 the default on Raspberry Pi B
  if ((i2c_handle_ads1015 = open("/dev/i2c-1", O_RDWR)) < 0) {
    printf("Error: Couldn't open device ads1015! %d\n", i2c_handle_ads1015);
    exit(1);
  }

  // connect to ADS1115 as i2c slave
  if (ioctl(i2c_handle_ads1015, I2C_SLAVE, asd_address) < 0) {
    printf("Error: Couldn't find device on address ads1015!\n");
    exit(1);
  }

  // set config register and start conversion
  // AIN0 and GND, 4.096v, 128s/s
  // Refer to page 16 area of spec sheet

  writeBuf[0] = 1; // config register is 1
  writeBuf[2] = 0b10000101; // bits 7-0  0x85
  // Bits 7-5 data rate default to 100 for 128SPS
  // Bits 4-0  comparator functions see spec sheet.

  int analog_in; // храним номер канала

  for (analog_in = 0; analog_in < 4; analog_in++) {

    switch (analog_in) {
    case 0:
      writeBuf[1] = 0xC2;
      // writeBuf[1] = 0b11000010; // 0xC2 single shot off //100- 0 канал
      // bit 15 flag bit for single shot not used here
      // Bits 14-12 input selection:
      // 100 ANC0; 101 ANC1; 110 ANC2; 111 ANC3
      // Bits 11-9 Amp gain. Default to 010 here 001 P19
      // Bit 8 Operational mode of the ADS1115.
      // 0 : Continuous conversion mode
      // 1 : Power-down single-shot mode (default)
      break;

    case 1:
      writeBuf[1] = 0xD2; //101- 1 канал
      break;

    case 2:
      writeBuf[1] = 0xE2; //110- 2 канал
      break;

    case 3:
      writeBuf[1] = 0xF2; //111- 3 канал
      break;

    }

    // begin conversion
    if (write(i2c_handle_ads1015, writeBuf, 3) != 3) {
      perror("Write to register 1");
      exit(1);
    }

    delay(20);

    // set pointer to 0
    readBuf[0] = 0;
    if (write(i2c_handle_ads1015, readBuf, 1) != 1) {
      perror("Write register select");
      exit(-1);
    }

    // read conversion register
    if (read(i2c_handle_ads1015, readBuf, 2) != 2) {
      perror("Read conversion");
      exit(-1);
    }

    // could also multiply by 256 then add readBuf[1]
    val = readBuf[0] << 8 | readBuf[1];

    // with +- LSB sometimes generates very low neg number.
    if (val < 0) val = 0;

    myfloat = val * VPS; // convert to voltage

    //printf("Канал %d: %4.3f volts.\n", analog_in, myfloat);

    switch (analog_in) {
    case 0:
      gas_current_array[0] = (((10000.0 / 3.3) * myfloat) + 200)/300; //пропан mq-5 ppm
      break;

    case 1:
     // gas_current_array[4] = ((10000.0 / 3.3) * myfloat) + 50; //алкоголь mq-3 мг/м3
	  gas_current_array[4] = (((5220.0 / 3.3) * myfloat) + 	25)/750; //алкоголь (этанол) mq-3 ppm
      break;

    case 2:
      gas_current_array[1] = (((5000.0 / 3.3) * myfloat) + 300)*0.7; //бутан mq-2 ppm
      gas_current_array[2] = 0; //метан mq-2 ppm
      gas_current_array[3] = 0; ////водород mq-2 ppm
      break;

    case 3:
      gas_current_array[5] = (((2000.0 / 3.3) * myfloat) + 20)*2.9; //угарный газ mq-7 ppm
      break;

    }

  }

  // power down ASD1115
  writeBuf[0] = 1; // config register is 1
  writeBuf[1] = 0b11000011; // bit 15-8 0xC3 single shot on
  writeBuf[2] = 0b10000101; // bits 7-0  0x85
  if (write(i2c_handle_ads1015, writeBuf, 3) != 3) {
    perror("Write to register 1");
    exit(1);
  }

  close(i2c_handle_ads1015);
/* for (int i = 0; i < 6; i++) {
    printf("gas_current_array[%d] %4.3f \n", i, gas_current_array[i]);
  }
*/
}
/////////////////ads1015///////////////////



int main(void) 
{
	
	wiringPiI2CSetup(0x20);
	 wiringPiSetup () ;
	 
	pinMode (PIN_RELAY0, OUTPUT); 
	pinMode (PIN_RELAY1, OUTPUT);
	pinMode (PIN_RELAY2, OUTPUT);
	pinMode (PIN_RELAY3, OUTPUT);
	pinMode (PIN_BIPPER, OUTPUT);
	
	mcp23017Setup (START_EXTERNAL_GPIO_NUMERATION_FROM, 0x20) ;

 for (int i = 0 ; i < 8 ; ++i)
{
	pinMode (n[i], OUTPUT);
}

for (int i = 0 ; i < 8 ; ++i)
{
        digitalWrite  (n[i], 1);
}

pinMode (PIN_BUTTON_1, INPUT);
pinMode (PIN_BUTTON_2, INPUT);
pinMode (PIN_BUTTON_3, INPUT);
pinMode (PIN_BUTTON_4, INPUT);
pinMode (PIN_BUTTON_5, INPUT);
			
		FILE * fp;
   int i;
	// Create I2C bus
	int file;
	char *bus = "/dev/i2c-1";
	int file1;
	char *bus1 = "/dev/i2c-1";
	
	int temp0;
	int temp1;
	char config0[2] = {0};
	char config1[2] = {0};
	char data1[6] = {0};
	char data[6] = {0};
	
	//////bh1750/////
	handle0 = wiringPiI2CSetup(0x23);
	 handle1 = wiringPiI2CSetup(0x5C);
	//////bh1750///// 
	 
	 
	 //////csv_read/////
	char tmp[1024]={0x0};
	int fldcnt=0;
	char arr[MAXFLDS][MAXFLDSIZE]={0x0};
	int recordcnt=0;
	FILE *in;
	  //////csv_read/////
	  
	  
	while (1)
	{
		
	if ((file = open(bus, O_RDWR)) < 0) 
	{
		printf("Failed to open the bus. \n");
		exit(1);
	}
	
	// Get I2C device, SHT30 I2C address is 0x44(68)
	ioctl(file, I2C_SLAVE, 0x44);

	// Send measurement command(0x2C)
	// High repeatability measurement(0x06)
	
	config0[0] = 0x2c;
	config0[1] = 0x06;
	write(file, config0, 2);
	delay(20);

	// Read 6 bytes of data
	// Temp msb, Temp lsb, Temp CRC, Humididty msb, Humidity lsb, Humidity CRC
	
	if(read(file, data, 6) != 6)
	{
		printf("Erorr : Input/output Erorr \n");
	}
	else
	{
		// Convert the data
		temp0 = (data[0] * 256 + data[1]);
		cTemp = -45 + (175 * temp0 / 65535.0);
		fTemp = -49 + (315 * temp0 / 65535.0);
		 humidity = 100 * (data[3] * 256 + data[4]) / 65535.0;

		// Output data to screen
	//	printf("Humidity: %.2f RH \n", humidity);
	//	printf("Temperature: %.2f C \n", cTemp);
	}
	close(*bus);
	close (file);
		
	
	if ((file1 = open(bus1, O_RDWR)) < 0) 
	{
		printf("Failed to open the bus. \n");
		exit(1);
	}
	
	// Get I2C device, SHT30 I2C address is 0x44(68)
	ioctl(file1, I2C_SLAVE, 0x45);

	// Send measurement command(0x2C)
	// High repeatability measurement(0x06)
	
	config1[0] = 0x2c;
	config1[1] = 0x06;
	write(file1, config1, 2);
	delay(20);

	// Read 6 bytes of data
	// Temp msb, Temp lsb, Temp CRC, Humididty msb, Humidity lsb, Humidity CRC
	
	if(read(file1, data1, 6) != 6)
	{
		printf("Erorr : Input/output Erorr \n");
	}
	else
	{
		// Convert the data
		temp1 = (data1[0] * 256 + data1[1]);
		cTemp1 = -45 + (175 * temp1 / 65535.0);
		fTemp1 = -49 + (315 * temp1 / 65535.0);
		 humidity1 = 100 * (data1[3] * 256 + data1[4]) / 65535.0;

		// Output data to screen
	//	printf("Humidity1: %.2f RH \n", humidity1);
	//	printf("Temperature1: %.2f C \n", cTemp1);
	}
	close(*bus1);
	close (file1);

	
//////bh1750/////
 lux0 = get_sht30 (handle0);
 lux1 = get_sht30 (handle1);
//////bh1750/////

	
	//////csv_read_settings/////
		in=fopen("/thesis/site/csv/settings.csv","r");         /* open file on command line */
	
	if(in==NULL)
	{
		perror("File open error");
		exit(EXIT_FAILURE);
	}
	recordcnt = 0;
	while(fgets(tmp,sizeof(tmp),in)!=0) /* read a record */
	{
	    int i=0;
	    recordcnt++;
		//printf("Record number: %d\n",recordcnt);
		parse(tmp,",",arr,&fldcnt);    /* whack record into fields */
		for(i=0;i<fldcnt;i++)
		{                              // print each field 
		for (char * p = arr[i]; * p; p ++) if (* p == '\n') putchar (* p= '\0'); /*сложный
		способ убрать лишние переводы строк =)*/
			//printf("%s,", arr[i]);
			parse_settings_function (arr[i], recordcnt, i);
		}
		
	}
	fclose(in);
	//buttons_function (arr[0], arr[1], arr[2], arr[3]);
	//////csv_read_settings/////
	
	//////csv_read/////
		in=fopen("/thesis/site/csv/turn_on.csv","r");         /* open file on command line */
	
	if(in==NULL)
	{
		perror("File open error");
		exit(EXIT_FAILURE);
	}
	recordcnt = 0;
	while(fgets(tmp,sizeof(tmp),in)!=0) /* read a record */
	{
	    int i=0;
	    recordcnt++;
		//printf("Record number: %d\n",recordcnt);
		parse(tmp,",",arr,&fldcnt);    /* whack record into fields */
		
		for(i=0;i<fldcnt;i++)
		{                              // print each field 
		for (char * p = arr[i]; * p; p ++) if (* p == '\n') putchar (* p= '\0'); /*сложный
		способ убрать лишние переводы строк =)*/
			//printf("%s", arr[i]);
			buttons_function (arr[i], recordcnt);
		}
		
	}
	fclose(in);
	//////csv_read/////
	
	read_ads1015();
	
   fp = fopen ("/thesis/site/csv/status.csv","w");
    fprintf (fp, "\n%.2f,%.2f,%.2f,%.2f,%.2f,%.2f,%.2f,%.2f,%d,%.2f,%.2f,%d,%d,%d,%d,%d\n",
	gas_current_array[0],gas_current_array[1],gas_current_array[2],gas_current_array[3],
	gas_current_array[4],gas_current_array[5], cTemp1,humidity1,lux0,cTemp,humidity,lux1,
	digitalInvertedRead  (PIN_RELAY0),digitalInvertedRead  (PIN_RELAY1),
	digitalInvertedRead  (PIN_RELAY2), digitalInvertedRead  (PIN_RELAY3));
    fclose (fp);
		
	 fp = fopen ("/thesis/site/csv/turn_on.csv","w");
    fprintf (fp, "-1\n-1\n-1\n-1");
    fclose (fp);
	
	if (check_auto (PIN_RELAY0, 1, 1)) {digitalInvertedWrite  (PIN_RELAY0, 1);} else {if (check_auto (PIN_RELAY0, 1, 0)) {digitalInvertedWrite  (PIN_RELAY0, 0);}}
	if (check_auto (PIN_RELAY1, 1, 1)) {digitalInvertedWrite  (PIN_RELAY1, 1);} else {if (check_auto (PIN_RELAY1, 1, 0)) {digitalInvertedWrite  (PIN_RELAY1, 0);}}
	if (check_auto (PIN_RELAY2, 1, 1)) {digitalInvertedWrite  (PIN_RELAY2, 1);} else {if (check_auto (PIN_RELAY2, 1, 0)) {digitalInvertedWrite  (PIN_RELAY2, 0);}}
	if (check_auto (PIN_RELAY3, 1, 1)) {digitalInvertedWrite  (PIN_RELAY3, 1);} else {if (check_auto (PIN_RELAY3, 1, 0)) {digitalInvertedWrite  (PIN_RELAY3, 0);}}
	
	
	if (digitalRead  (PIN_BUTTON_1) == 1 && trigger[0]==0)
	{
	trigger[0] = 1;
	}
	if (digitalRead  (PIN_BUTTON_1) == 0 && trigger[0]==1)
	{
	if 	(digitalInvertedRead(PIN_RELAY0)) {if (check_auto (PIN_RELAY0, 0, 0)) {digitalInvertedWrite  (PIN_RELAY0, 0);}}
	else {if (check_auto (PIN_RELAY0, 0, 1)) {digitalInvertedWrite  (PIN_RELAY0, 1);}}
	trigger[0] = 0;
	}
	
	if (digitalRead  (PIN_BUTTON_2) == 1 && trigger[1]==0)
	{
	trigger[1] = 1;
	}
	if (digitalRead  (PIN_BUTTON_2) == 0 && trigger[1]==1)
	{
	if 	(digitalInvertedRead(PIN_RELAY1)) {if (check_auto (PIN_RELAY1, 0, 0)) {digitalInvertedWrite  (PIN_RELAY1, 0);}}
	else {if (check_auto (PIN_RELAY1, 0, 1)) {digitalInvertedWrite  (PIN_RELAY1, 1);}}
	trigger[1] = 0;
	}
	
	if (digitalRead  (PIN_BUTTON_3) == 1 && trigger[2]==0)
	{
	trigger[2] = 1;
	}
	if (digitalRead  (PIN_BUTTON_3) == 0 && trigger[2]==1)
	{
	if 	(digitalInvertedRead(PIN_RELAY2)) {if (check_auto (PIN_RELAY2, 0, 0)) {digitalInvertedWrite  (PIN_RELAY2, 0);}}
	else {if (check_auto (PIN_RELAY2, 0, 1)) {digitalInvertedWrite  (PIN_RELAY2, 1);}}
	trigger[2] = 0;
	}
	
	if (digitalRead  (PIN_BUTTON_4) == 1 && trigger[3]==0)
	{
	trigger[3] = 1;
	}
	if (digitalRead  (PIN_BUTTON_4)== 0 && trigger[3]==1)
	{
	if 	(digitalInvertedRead(PIN_RELAY3)) {if (check_auto (PIN_RELAY3, 0, 0)) {digitalInvertedWrite  (PIN_RELAY3, 0);}}
	else {if (check_auto (PIN_RELAY3, 0, 1)) {digitalInvertedWrite  (PIN_RELAY3, 1);}}
	trigger[3] = 0;
	}
	
	if (digitalRead  (PIN_BUTTON_5) == 1)
	{
	 for (int i = 7 ; i > -1 ; --i)
	{
	digitalWrite  (PIN_BIPPER, 1);
	digitalWrite  (n[i], 0);
	delay (50);
	digitalWrite  (PIN_BIPPER, 0);
	digitalWrite  (n[i], 1);
	}
	digitalWrite  (PIN_BIPPER, 1);
	delay (350);
	digitalWrite  (PIN_BIPPER, 0);
	system("poweroff");
	}

	/////////лампочка индикации цикла/////////
		digitalWrite  (PIN_LED_5, 0);
	delay (50);
	digitalWrite  (PIN_LED_5, 1);
		
	} 
   return 0;

}
