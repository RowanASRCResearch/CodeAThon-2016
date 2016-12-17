import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLConnection;
import java.nio.charset.StandardCharsets;

/**
 * Created by lapost48 on 12/16/2016.
 */
public class Request {

    private static String baseURL = "http://www.3volution.io/rescue_manager/php/insert.php";

    private String tableInitial;
    private String jsonString;

    private String query;

    public Request(Table table) {
        switch(table) {
            case POINT:
                tableInitial = "p";
                break;
            case FLAG:
                tableInitial = "f";
                break;
        }
        jsonString = "";
    }

    public void sendRequest() throws Exception {
        jsonString = "{ " + jsonString + "}";
        //System.out.println(jsonString);
        URL url = new URL(baseURL + "?flag=" + tableInitial);
        URLConnection connection = url.openConnection();
        HttpURLConnection http = (HttpURLConnection)connection;
        http.setRequestMethod("POST");
        http.setDoOutput(true);

        byte[] out = jsonString.getBytes(StandardCharsets.UTF_8);
        int length = out.length;

        http.setFixedLengthStreamingMode(length);
        http.setRequestProperty("Content-Type", "application/json; charset=UTF-8");
        http.connect();
        try(OutputStream os = http.getOutputStream()) {
            os.write(out);
        }

        BufferedReader in = new BufferedReader(
                new InputStreamReader(
                        connection.getInputStream()));
        String inputLine;
        if((inputLine = in.readLine()) != null)
            System.out.println(inputLine);
        in.close();
    }

    public void addParameter(String name, Object value) {
        if(!jsonString.equals(""))
            jsonString += ", ";
        jsonString += "\"" + name + "\"" + ":" + String.valueOf(value);
    }

}
