import java.io.IOException;
import java.net.DatagramPacket;
import java.net.MulticastSocket;
import java.net.InetAddress;
import java.net.NetworkInterface;
import java.net.InetSocketAddress;


public class MulticastClient {

    public static void main(String[] args) {
        while(true){
            try{
                MulticastSocket mcs = new MulticastSocket(12345);
                InetAddress grp = InetAddress.getByName("239.0.0.1");
                InetSocketAddress group = new InetSocketAddress(grp, 12345);
                NetworkInterface netIf = NetworkInterface.getByName("wlp1s0");
                mcs.joinGroup(grp,netIf);
                byte rec[] = new byte[256];
                DatagramPacket pkg = new DatagramPacket(rec, rec.length);
                mcs.receive(pkg);

                String data = new String(pkg.getData());
                System.out.println("Dados recebidos:" + data);

            }
            catch(Exception e){
                System.out.println("Erro: " + e.getMessage());
            }
        }
    }
}
