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
import web.beans.Unit;

@WebServlet(name = "ShowHomes", urlPatterns = {"/GetHomes"})
public class GetHomes extends HttpServlet {

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        String capacity = request.getParameter("cap");
        String view = request.getParameter("view");

        ServletContext context = this.getServletContext();
        Connection dbConn = (Connection) context.getAttribute("dbconn");

        String query = "SELECT * "
                + "FROM units "
                + "WHERE unit_capacity = ? "
                + "ORDER BY trans_id";

        try {
            PreparedStatement ps = dbConn.prepareStatement(query);
            ps.setString(1, capacity);

            ResultSet rs = ps.executeQuery();

            ArrayList<Unit> units = new ArrayList<>();

            if (rs.first()) {
                do {
                    String unitId = rs.getString("trans_id");
                    String condoName = rs.getString("condo_name");
                    String desc = rs.getString("unit_description");
                    String address = rs.getString("unit_address");
                    int cap = rs.getInt("unit_capacity");
                    int noOfBeds = rs.getInt("no_of_beds");
                    BigDecimal ratePerNight = rs.getBigDecimal("price_per_night");
                    String vacancy = rs.getString("vacancy");
                    
                    Unit unit = new Unit(unitId, condoName, desc, address, cap, noOfBeds, ratePerNight, vacancy);
                    units.add(unit);
                } while (rs.next());
            }

            rs.close();
            ps.close();

            request.setAttribute("units", units);

            RequestDispatcher rd = null;

             if (view.equalsIgnoreCase("json")) {
                rd = request.getRequestDispatcher("ToJSON");
            }

            if (rd == null) {
                response.sendError(400);
            } else {
                rd.forward(request, response);

            }

        } catch (SQLException ex) {
            Logger.getLogger(GetHomes.class
                    .getName()).log(Level.SEVERE, null, ex);

            response.setStatus(HttpServletResponse.SC_INTERNAL_SERVER_ERROR);
        }
    }
}
