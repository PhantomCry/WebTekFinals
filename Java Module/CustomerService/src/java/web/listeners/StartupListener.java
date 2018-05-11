package web.listeners;

import javax.servlet.ServletContext;
import javax.servlet.ServletContextEvent;
import javax.servlet.ServletContextListener;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;

public class StartupListener implements ServletContextListener {

    @Override
    public void contextInitialized(ServletContextEvent sce) {
        ServletContext context = sce.getServletContext();
        
        String dbDriver = "com.mysql.jdbc.Driver";
        String connStr = "jdbc:mysql://localhost:3306/transient?user=root&pwd=";
        
        // alternatively, the database connection information can be
        //   retrieved from the 'standard deployment descriptor' file..
        //   (see 'web.xml' file in the 'WEB-INF' folder..
        //
        // String dbDriver = context.getInitParameter("dbdriver");
        // String connStr = context.getInitParameter("connstr");
        
        try {
            Class.forName(dbDriver);
            
            Connection dbConn = DriverManager.getConnection(connStr);
            
            context.setAttribute("dbconn", dbConn);
            
        } catch (Exception ex) {
            throw new RuntimeException("Database connection error.");
        }
    }

    @Override
    public void contextDestroyed(ServletContextEvent sce) {
        ServletContext context = sce.getServletContext();
        
        Connection dbConn = (Connection) context.getAttribute("dbconn");
        
        try {
            dbConn.close();
            
        } catch (SQLException ex) {
            Logger.getLogger(StartupListener.class.getName()).log(Level.SEVERE, null, ex);
        }
    }
}
