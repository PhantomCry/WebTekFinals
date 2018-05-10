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
import javax.servlet.http.HttpSession;

/**
 *
 * @author User
 */
@WebServlet(name = "VerifyUser", urlPatterns = {"/VerifyUser"})
public class Login extends HttpServlet {

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
        PrintWriter out = response.getWriter();
        if (userName != null) {
            ServletContext context = this.getServletContext();
            Connection dbConn = (Connection) context.getAttribute("dbconn");
            String query = "Select username, userpassword from user where username = ? AND  userpassword = ?";
            try {
                PreparedStatement ps = dbConn.prepareStatement(query);
                ps.setString(1, userName);
                ps.setString(2, password);

                ResultSet rs = ps.executeQuery();
                rs.last();

                if (rs.getRow() == 1) {
                    HttpSession session = request.getSession(true);
                    session.setAttribute("username", userName);
                    out.println("Hello");
                    rs.close();
                    ps.close();
                }
                response.sendRedirect("index");
            } catch (SQLException ex) {
                Logger.getLogger(Login.class.getName()).log(Level.SEVERE, null, ex);
            }
        }
    }
}
