/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package web.servlets;

import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.ServletContext;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 *
 * @author User
 */
@WebServlet(name = "VerifyUser", urlPatterns = {"/VerifyUser"})
public class VerifyUser extends HttpServlet {

    /**
     * Processes requests for both HTTP <code>GET</code> and <code>POST</code>
     * methods.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        String userName = request.getParameter("username");
        String password = request.getParameter("password");

        ServletContext context = this.getServletContext();
        Connection dbConn = (Connection) context.getAttribute("dbconn");
        String query = "Select username, password from user where username = ? AND where password = ?";
        try {
            PreparedStatement ps = dbConn.prepareStatement(query);
            ps.setString(1, userName);
            ps.setString(2, password);

            ResultSet rs = ps.executeQuery();
            rs.last();

            if (rs.getRow() == 1) {
                response.sendRedirect("index");
                rs.close();
                ps.close();
            } else {

            }
        } catch (SQLException ex) {
            Logger.getLogger(VerifyUser.class.getName()).log(Level.SEVERE, null, ex);
        }
    }
}
