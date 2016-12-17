import javax.swing.*;
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.net.URL;
import java.net.URLConnection;

/**
 * Created by lapost48 on 12/16/2016.
 */
public class Manager {

    private static JFrame frame = new JFrame("Rescue Manager - Vessel");

    public static void main(String[] args) throws Exception {

        testPoint();

        System.out.println("\n\nFlag Test\n");

        testFlag();
        //initFrame();
    }

    private static void testPoint() throws Exception {
        Request request = new Request(Table.POINT);
        request.addParameter("vessel", 100);
        request.addParameter("lat", 10);
        request.addParameter("lon", -65);
        request.sendRequest();
    }

    private static void testFlag() throws Exception {
        Request request = new Request(Table.FLAG);
        request.addParameter("vessel", 1);
        request.addParameter("lat", 10);
        request.addParameter("lon", -65);
        request.addParameter("type", FlagType.HAZARD);
        request.addParameter("desc", "TestFlag");
        request.sendRequest();
    }

    private static void initFrame() {
        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        frame.setSize(500, 500);
        frame.setVisible(true);
    }

}
