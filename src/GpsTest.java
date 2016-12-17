import jssc.SerialPort;
import jssc.SerialPortException;

import java.util.regex.Matcher;
import java.util.regex.Pattern;

/**
 * Created by lapost48 on 12/16/2016.
 */
public class GpsTest {

    public static void main(String[] args) {

        SerialPort gpsPort = new SerialPort("COM4");
        Pattern p = Pattern.compile("GPGLL,.*A...");

        try {
            gpsPort.openPort();

            while (true) {
                byte[] bytes;
                String[] location = null;
                if((bytes = gpsPort.readBytes()) != null) {
                    String data = new String(bytes);
                    if(data.contains("GPGLL")) {
                        Matcher m = p.matcher(data);
                        m.find();
                        location = m.group(0).split(",");
                    }
                }
                if(location != null) {
                    float lat = Float.parseFloat(location[1]);
                    lat *= (location[2].equals("N")) ? 1 : -1;
                    float lon = Float.parseFloat(location[3]);
                    lon *= (location[4].equals("E")) ? 1 : -1;

                    lat = convertToDecimal(lat);
                    lon = convertToDecimal(lon);

                    System.out.println("(" + lat + ", " + lon + ")");
                }
            }
        } catch (SerialPortException e) {
            e.printStackTrace();
        }

    }

    private static float convertToDecimal(float coord) {
        int coord_deg = (int) coord / 100;
        int coord_min = (int) coord % 100;
        int coord_sec = (int) (coord * 100) % 100;
        return coord_deg + (coord_min / (float) 60.0) + (coord_sec / (float) 60.0 / (float) 60.0);
    }

}
