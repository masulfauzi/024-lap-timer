const int slaveSelectPin = 9; // Setup data pins for rx5808 comms
const int spiDataPin = 8;
const int spiClockPin = 13;
int lap = 1;



struct {
  uint16_t volatile vtxFreq = 5732;
} settings;

// Define vtx frequencies in mhz and their hex code for setting the rx5808 module
int vtxFreqTable[] = {
  5865, 5845, 5825, 5805, 5785, 5765, 5745, 5725, // Band A
  5733, 5752, 5771, 5790, 5809, 5828, 5847, 5866, // Band B
  5705, 5685, 5665, 5645, 5885, 5905, 5925, 5945, // Band E
  5740, 5760, 5780, 5800, 5820, 5840, 5860, 5880, // Band F
  5658, 5695, 5732, 5769, 5806, 5843, 5880, 5917  // Band C / Raceband
};
uint16_t vtxHexTable[] = {
  0x2A05, 0x299B, 0x2991, 0x2987, 0x291D, 0x2913, 0x2909, 0x289F, // Band A
  0x2903, 0x290C, 0x2916, 0x291F, 0x2989, 0x2992, 0x299C, 0x2A05, // Band B
  0x2895, 0x288B, 0x2881, 0x2817, 0x2A0F, 0x2A19, 0x2A83, 0x2A8D, // Band E
  0x2906, 0x2910, 0x291A, 0x2984, 0x298E, 0x2998, 0x2A02, 0x2A0C, // Band F
  0x281D, 0x288F, 0x2902, 0x2914, 0x2987, 0x2999, 0x2A0C, 0x2A1E  // Band C / Raceband
};

// Defines for fast ADC reads
#define cbi(sfr, bit) (_SFR_BYTE(sfr) &= ~_BV(bit))
#define sbi(sfr, bit) (_SFR_BYTE(sfr) |= _BV(bit))

// Initialize program
void setup() {
  Serial.begin(115200); // Start serial for output/debugging

  pinMode (slaveSelectPin, OUTPUT); // RX5808 comms
  pinMode (spiDataPin, OUTPUT);
  pinMode (spiClockPin, OUTPUT);
  digitalWrite(slaveSelectPin, HIGH);

  while (!Serial) {
  }; // Wait for the Serial port to initialise
//  Serial.print("Ready: ");
  Serial.println("Lap Timer Ready");



  // set ADC prescaler to 16 to speedup ADC readings
    sbi(ADCSRA,ADPS2);
    cbi(ADCSRA,ADPS1);
    cbi(ADCSRA,ADPS0);

  setRxModule(settings.vtxFreq); // Setup rx module to default frequency
}

// Functions for the rx5808 module
void SERIAL_SENDBIT1() {
  digitalWrite(spiClockPin, LOW);
  delayMicroseconds(300);
  digitalWrite(spiDataPin, HIGH);
  delayMicroseconds(300);
  digitalWrite(spiClockPin, HIGH);
  delayMicroseconds(300);
  digitalWrite(spiClockPin, LOW);
  delayMicroseconds(300);
}
void SERIAL_SENDBIT0() {
  digitalWrite(spiClockPin, LOW);
  delayMicroseconds(300);
  digitalWrite(spiDataPin, LOW);
  delayMicroseconds(300);
  digitalWrite(spiClockPin, HIGH);
  delayMicroseconds(300);
  digitalWrite(spiClockPin, LOW);
  delayMicroseconds(300);
}
void SERIAL_ENABLE_LOW() {
  delayMicroseconds(100);
  digitalWrite(slaveSelectPin,LOW);
  delayMicroseconds(100);
}
void SERIAL_ENABLE_HIGH() {
  delayMicroseconds(100);
  digitalWrite(slaveSelectPin,HIGH);
  delayMicroseconds(100);
}

// Set the frequency given on the rx5808 module
void setRxModule(int frequency) {
  uint8_t i; // Used in the for loops

  uint8_t index; // Find the index in the frequency lookup table
  for (i = 0; i < sizeof(vtxFreqTable); i++) {
    if (frequency == vtxFreqTable[i]) {
      index = i;
      break;
    }
  }

  uint16_t vtxHex; // Get the hex value to send to the rx module
  vtxHex = vtxHexTable[index];

  // bit bash out 25 bits of data / Order: A0-3, !R/W, D0-D19 / A0=0, A1=0, A2=0, A3=1, RW=0, D0-19=0
  SERIAL_ENABLE_HIGH();
  delay(2);
  SERIAL_ENABLE_LOW();
  SERIAL_SENDBIT0();
  SERIAL_SENDBIT0();
  SERIAL_SENDBIT0();
  SERIAL_SENDBIT1();
  SERIAL_SENDBIT0();

  for (i = 20; i > 0; i--) SERIAL_SENDBIT0(); // Remaining zeros

  SERIAL_ENABLE_HIGH(); // Clock the data in
  delay(2);
  SERIAL_ENABLE_LOW();

  // Second is the channel data from the lookup table, 20 bytes of register data are sent, but the
  // MSB 4 bits are zeros register address = 0x1, write, data0-15=vtxHex data15-19=0x0
  SERIAL_ENABLE_HIGH();
  SERIAL_ENABLE_LOW();

  SERIAL_SENDBIT1(); // Register 0x1
  SERIAL_SENDBIT0();
  SERIAL_SENDBIT0();
  SERIAL_SENDBIT0();

  SERIAL_SENDBIT1(); // Write to register

  // D0-D15, note: loop runs backwards as more efficent on AVR
  for (i = 16; i > 0; i--) {
    if (vtxHex & 0x1) { // Is bit high or low?
      SERIAL_SENDBIT1();
    }
    else {
      SERIAL_SENDBIT0();
    }
    vtxHex >>= 1; // Shift bits along to check the next one
  }

  for (i = 4; i > 0; i--) // Remaining D16-D19
    SERIAL_SENDBIT0();

  SERIAL_ENABLE_HIGH(); // Finished clocking data in
  delay(2);

  digitalWrite(slaveSelectPin,LOW);
  digitalWrite(spiClockPin, LOW);
  digitalWrite(spiDataPin, LOW);
}


// Read the RSSI value for the current channel
int rssiRead() {
  return analogRead(0);
}

// Main loop
void loop() {
  float nilai_rssi = rssiRead();

  if(nilai_rssi >= 200)
  {
    Serial.print("Lap ");
    Serial.println(lap);
    lap ++;
    delay(2000);
  }

}
