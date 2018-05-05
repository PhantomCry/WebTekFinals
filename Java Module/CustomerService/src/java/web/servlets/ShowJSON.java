package web.servlets;

import java.io.IOException;
import java.io.PrintWriter;
import java.math.BigDecimal;
import java.util.ArrayList;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import web.beans.Product;

@WebServlet(name = "ShowJSON", urlPatterns = {"/ShowJSON"})
public class ShowJSON extends HttpServlet {

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
        String category = request.getParameter("cat");
        ArrayList<Product> products = (ArrayList<Product>) request.getAttribute("products");
        
        String json = "", separator = "";
        for (Product product : products) {
            String prodId = product.getProdId();
            String description = product.getDescription();
            BigDecimal price = product.getPrice();
            
            json += separator +
                    String.format("  {\"prodid\": \"%s\", " +
                                  "\"category\": \"%s\", " +
                                  "\"description\": \"%s\", " +
                                  "\"price\": %s}",
                            prodId, category, description, price);
            separator = ",\n";
        }
        
        json = "[\n" + json + "\n]";
        
        response.setStatus(HttpServletResponse.SC_OK);
        response.setContentType("application/json");
        
        PrintWriter out = response.getWriter();
        out.println(json);
        
        out.close();
    }
}
