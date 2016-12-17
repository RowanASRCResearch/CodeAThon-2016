import jssc.SerialPort;
import jssc.SerialPortException;

import net.sf.marineapi.nmea.parser.SentenceFactory;

/**
 * Created by lapost48 on 12/16/2016.
 */
public class GpsTest {

    public static void main(String[] args) {

        SerialPort gpsPort = new SerialPort("COM3");


        try {
            gpsPort.openPort();

            while (true) {
                byte[] bytes;
                if((bytes = gpsPort.readBytes()) != null) {
                    //SentenceFactory.getInstance().createParser();
                    System.out.println(bytes);
//                    for (byte b : bytes)
//                        System.out.println(b);
                }
            }
        } catch (SerialPortException e) {
            e.printStackTrace();
        }

    }

}
