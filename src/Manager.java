import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.net.URL;
import java.net.URLConnection;
import java.util.concurrent.Semaphore;

/**
 * Created by lapost48 on 12/16/2016.
 */
public class Manager {

    private static boolean testHTTPS = false;
    private static boolean testGPS = false;
    private static boolean testGUI = true;

    private static final int fadeDelay = 3000;
    private static final int delay = 57000;


    private static JFrame frame = new JFrame("Rescue Manager - Vessel");
    private static JLabel l = new JLabel("");
    private static JPanel lp = new JPanel(new GridBagLayout());
    private static JPanel pp = new JPanel(new GridBagLayout());
    private static JLabel pl = new JLabel();
    private static int vesselID;

    public static void main(String[] args) throws Exception {
        vesselID = Integer.parseInt(args[0]);

        if(testHTTPS) {
            System.out.println("Point Test\n");
            updatePoint();
            System.out.println("\n\nFlag Test\n");
            testFlag();
        }

        if(testGPS) {
            for(int i = 0; i < 20; i++)
                for(float f : getGPS())
                    System.out.print(f + " ");
        }

        if(testGUI) {
            initFrame();

            while (true)
                try {
                    updatePoint();
                    Thread.sleep(fadeDelay);
                    fade();
                    Thread.sleep(delay);
                } catch (Exception e) {

                }
        }
    }

    private static void fade() {
        lp.setBackground(null);
        l.setText("");
        pp.setBackground(null);
        pl.setText("");
    }

    private static float[] getGPS() {
        float[] coords = new float[2];
        coords[0] = (float) (Math.random() * 180) - 90;
        coords[1] = (float) (Math.random() * 360) - 90;
        return coords;
    }

    private static void updatePoint() {
        Request request = new Request(Table.POINT);
        request.addParameter("vessel", vesselID);
        float[] latlon = getGPS();
        request.addParameter("lat", latlon[0]);
        request.addParameter("lon", latlon[1]);
        try {
            request.sendRequest();
            pp.setBackground(Color.GREEN);
            pl.setText("Location Updated!");
        } catch(Exception e) {
            pp.setBackground(Color.RED);
            pl.setText("Update Failed!");
        }
    }

    private static void testFlag() throws Exception {
        Request request = new Request(Table.FLAG);
        request.addParameter("vessel", 91);
        request.addParameter("lat", 10);
        request.addParameter("lon", -65);
        request.addParameter("type", FlagType.HAZARD);
        request.addParameter("desc", "TestFlag");
        request.sendRequest();
    }

    private static void initFrame() {
        frame.setLayout(new GridLayout(3, 1));
        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        frame.setSize(500, 500);

        lp.add(l);

        JPanel p = new JPanel(new GridBagLayout());
        JButton b = new JButton("Create Flag");
        b.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                Request flagRequest = new Request(Table.FLAG);
                flagRequest.addParameter("vessel", vesselID);
                float[] latlon = getGPS();
                flagRequest.addParameter("lat", latlon[0]);
                flagRequest.addParameter("lon", latlon[1]);
                FlagType t = (FlagType) JOptionPane.showInputDialog(null, "Flag Type", "Type", JOptionPane.PLAIN_MESSAGE,
                                                                    null, FlagType.values(), FlagType.CAUTION);
                while(t == null);
                flagRequest.addParameter("type", t);
                String s = JOptionPane.showInputDialog(null, "Enter Description",
                                                                "Description");
                while(s == null);
                flagRequest.addParameter("desc", s);

                try {
                    flagRequest.sendRequest();
                    l.setText("Successfully Entered Flag!");
                    lp.setBackground(Color.GREEN);
                } catch(Exception ex) {
                    l.setText("Flag not Entered!");
                    lp.setBackground(Color.RED);
                }
            }
        });
        p.add(b);
        pp.add(pl);
        frame.add(lp);
        frame.add(p);
        frame.add(pp);
        frame.setVisible(true);
    }

}
