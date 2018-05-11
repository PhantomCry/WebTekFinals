package web.servlets;

import java.io.IOException;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.ServletContext;
import javax.servlet.ServletException;
import javax.servlet.ServletOutputStream;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

@WebServlet(name = "GetImageFromDB", urlPatterns = {"/dbimages/*"})
public class GetImage extends HttpServlet {

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
        ServletContext context = this.getServletContext();

        Connection dbConn = (Connection) context.getAttribute("dbconn");

        String transId = request.getPathInfo().substring(1);
        
        String query = "SELECT unit_pic " +
                       "FROM units " +
                       "WHERE trans_id = ?";
        
        try {
            PreparedStatement ps = dbConn.prepareStatement(query);
            ps.setString(1, transId);
            
            ResultSet rs = ps.executeQuery();
            rs.first();
            byte[] imageData = rs.getBytes("unit_pic");
            
            rs.close();
            ps.close();
            
            response.setStatus(HttpServletResponse.SC_OK);
            response.setContentType("image");
            ServletOutputStream sos = response.getOutputStream();
            sos.write(imageData);
            sos.close();
            
        } catch (Exception ex) {
            Logger.getLogger(GetImage.class.getName()).log(Level.SEVERE, null, ex);
            
            response.setStatus(HttpServletResponse.SC_NOT_FOUND);
        }
    }
}
