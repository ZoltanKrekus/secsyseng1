import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;
import javax.xml.parsers.ParserConfigurationException;
import javax.xml.xpath.XPath;
import javax.xml.xpath.XPathConstants;
import javax.xml.xpath.XPathExpression;
import javax.xml.xpath.XPathExpressionException;
import javax.xml.xpath.XPathFactory;

import org.w3c.dom.Document;
import org.w3c.dom.Node;
import org.xml.sax.SAXException;


public class Login {

	private static String CONFIG_FILE = "config.xml",
						  DATABASE_URL = "jdbc:hsqldb:mem:test",
						  DATABASE_USER = "sa",
						  DATABASE_PW = "";
        
        private static boolean DATABASE_SETUP = true;
        
	/**
	 * @param args
	 */
	public static void main(String[] args) {

		//Make sure the jdbcDriver is available, if not exit
		try {
			Class.forName("org.hsqldb.jdbcDriver");
		} catch (ClassNotFoundException e1) {
			e1.printStackTrace();
			return;
		}
		
		// Standard of reading a XML file
		try {
			DocumentBuilderFactory factory = DocumentBuilderFactory.newInstance();
			factory.setNamespaceAware(true);
			DocumentBuilder builder;
			Document doc = null;
			XPathExpression expr = null;
	
			builder = factory.newDocumentBuilder();
			doc = builder.parse(CONFIG_FILE);
	
			// Create a XPathFactory
			XPathFactory xFactory = XPathFactory.newInstance();
	
			// Create a XPath object
			XPath xpath = xFactory.newXPath();
                        
                        // Read Database Configuration			
			expr = xpath.compile("//database/url/text()");
			Node result = (Node) expr.evaluate(doc, XPathConstants.NODE);
			if(result!=null)
				DATABASE_URL = result.getNodeValue();

			expr = xpath.compile("//database/user/text()");
			result = (Node) expr.evaluate(doc, XPathConstants.NODE);
			if(result!=null)
				DATABASE_USER = result.getNodeValue();

			expr = xpath.compile("//database/pw/text()");
			result = (Node) expr.evaluate(doc, XPathConstants.NODE);
			if(result!=null)
				DATABASE_PW = result.getNodeValue();
			
			expr = xpath.compile("//database/setup/text()");
			result = (Node) expr.evaluate(doc, XPathConstants.NODE);
			if(result!=null)
				DATABASE_SETUP = Boolean.parseBoolean(result.getNodeValue());
			
		} catch (ParserConfigurationException e) {e.printStackTrace(); return;
		} catch (SAXException e) {e.printStackTrace(); return;
		} catch (IOException e) { e.printStackTrace(); return;
		} catch (XPathExpressionException e) {	e.printStackTrace(); return;
		}

		try {
			Connection c = DriverManager.getConnection(DATABASE_URL, DATABASE_USER, DATABASE_PW);

			Statement s = c.createStatement();

			if(DATABASE_SETUP)
			{
				s.executeUpdate("CREATE TABLE users (name VARCHAR(30) PRIMARY KEY, pw VARCHAR(30) NOT NULL, message VARCHAR(1000) NOT NULL)");
				s.executeUpdate("INSERT INTO users VALUES ('admin', 'test', 'Injection Successful!'), ('user', 'whatever', 'users have no power')");
			}
			
			PreparedStatement ps = c.prepareStatement("SELECT * FROM users WHERE name = ? AND pw = ?");
			PreparedStatement update = c.prepareStatement("UPDATE users SET message = ? WHERE name = ?");

			ResultSet rs = s.executeQuery("SELECT * FROM users");

			System.out.println("Welcome to the SecretMessage System!");
                        
			BufferedReader in = new BufferedReader(new InputStreamReader(System.in));		

			String username;

			while(true)
			{

				System.out.println("\nReady to log-in.\nUsername: ");
				username = in.readLine();
				System.out.println("Password: ");
				String password = in.readLine();

                                String query = "SELECT * FROM users WHERE name = '"
                                        + username + "' AND pw = '"
                                        + password + "'";

                                System.out.println("Executing Query " + query);

                                rs = s.executeQuery(query); //SQL INJECTION!!!
				
				if(!rs.next())
				{
					System.out.println("Login Incorrect!");
					continue;
				}else{
					System.out.println("Welcome, " + rs.getString(1) + "!");
					System.out.println("Your message is: " + rs.getString(3));
				}				

				System.out.println("\nSet new message: ");
				String message = in.readLine();

				update.setString(1, message);
				update.setString(2, username);
				update.execute(); //SQL INJECTION

				System.out.println("\nYou are now logged out.\n");
			}			

		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}
}

