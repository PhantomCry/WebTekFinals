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
import web.beans.Unit;

@WebServlet(name = "ToJSON", urlPatterns = {"/ToJSON"})
public class ToJSON extends HttpServlet {

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
        String capacity = request.getParameter("cap");
        ArrayList<Unit> units = (ArrayList<Unit>) request.getAttribute("units");
        
        String json = "", separator = "";
        for (Unit unit : units) {
            String unitId = unit.getUnitId();
            String condoName = unit.getCondoName();
            String desc = unit.getDesc();
            String address = unit.getAddress();
            int noOfBeds = unit.getNoOfBeds();
            BigDecimal ratePerNight = unit.getRatePerNight();
            
            json += separator +
                    String.format("  {\"trans_id\": \"%s\", " +
                                  "\"condo_name\": \"%s\", " +
                                  "\"unit_description\": \"%s\", " +
                                  "\"unit_capacity\": \"%s\", " +
                                  "\"unit_address\": \"%s\", " +
                                  "\"no_of_beds\": \"%s\", " +
                                  "\"price_per_night\": %s}",
                            unitId, condoName, desc, capacity, address, noOfBeds, ratePerNight);
            separator = ",\n";
        }
        
        json = "[\n" + json + "\n]";
        
        response.setStatus(HttpServletResponse.SC_OK);
        response.setContentType("application/json");
        
        try (PrintWriter out = response.getWriter()) {
            out.println(json);
        }
    }
}
