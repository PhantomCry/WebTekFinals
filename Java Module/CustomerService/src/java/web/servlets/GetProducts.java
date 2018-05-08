package web.servlets;

import java.io.IOException;
import java.math.BigDecimal;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.RequestDispatcher;
import javax.servlet.ServletContext;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import web.beans.Product;

@WebServlet(name = "ShowProducts", urlPatterns = {"/GetProducts"})
public class GetProducts extends HttpServlet {

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
        String category = request.getParameter("cat");
        String view = request.getParameter("view");
        
        ServletContext context = this.getServletContext();
        Connection dbConn = (Connection) context.getAttribute("dbconn");
        
        String query = "SELECT prodid, description, price " +
                       "FROM products " +
                       "WHERE category = ? " +
                       "ORDER BY description";
        
        try {
            PreparedStatement ps = dbConn.prepareStatement(query);
            ps.setString(1, category);
            
            ResultSet rs = ps.executeQuery();
            
            ArrayList<Product> products = new ArrayList<>();
            
            if (rs.first()) {
                do {
                    String prodid = rs.getString("prodid");
                    String description = rs.getString("description");
                    BigDecimal price = rs.getBigDecimal("price");
                    
                    Product product = new Product(prodid, category, description, price);
                    products.add(product);
                } while (rs.next());
            }
            
            rs.close();
            ps.close();
            
            request.setAttribute("products", products);
            
            RequestDispatcher rd = null;
            
            if (view.equalsIgnoreCase("html")) {
                rd = request.getRequestDispatcher("ShowHTML");
            } else if (view.equalsIgnoreCase("json")) {
                rd = request.getRequestDispatcher("ShowJSON");
            }
            
            if (rd == null) {
                response.sendError(400);
            } else {
                rd.forward(request, response);
            }
            
        } catch (SQLException ex) {
            Logger.getLogger(GetProducts.class.getName()).log(Level.SEVERE, null, ex);
            
            response.setStatus(HttpServletResponse.SC_INTERNAL_SERVER_ERROR);
        }
    }
}
