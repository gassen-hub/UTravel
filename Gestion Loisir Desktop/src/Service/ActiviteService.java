/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Service;

import java.sql.Connection;
import java.sql.Date;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import utils.MyDB;
import Entities.Activite;
/**
 *
 * @author Gaston
 */
public class ActiviteService {
    private Connection cnx;
    
    
   
    public void ajouter(Activite e) throws SQLException{

 String req = "INSERT INTO `activite` (`nom_activite`,`type_activite`,`prix_activite`,`nb_pers`,`date_debut`,`date_fin`,`fiche_descriptive`,`place`,`pays`) VALUES (?,?,?,?,?,?,?,?,?)"; 
 PreparedStatement pst = MyDB.getInstance().getCnx().prepareStatement(req);
        pst.setString(1, e.getNom_activite());
         pst.setString(2, e.getType_activite());
        pst.setString(3, e.getPrix_activite());
        pst.setString(4, e.getNb_pers());
         pst.setString(5, e.getDate_debut());
          pst.setString(6, e.getDate_fin());
            pst.setString(7, e.getFiche_descriptive());
             pst.setString(8, e.getPlace());
              pst.setString(9, e.getPays());
        pst.executeUpdate();
    }

public ObservableList <Activite> showEvent() {
    
            ObservableList<Activite> myList = FXCollections.observableArrayList();
            String req = "SELECT * FROM activite";
            try{
                PreparedStatement pst = MyDB.getInstance().getCnx().prepareStatement(req);
                ResultSet rs = pst.executeQuery(req);

                while(rs.next()){
                    Activite e = new Activite();
                    e.setId(rs.getInt(1));
                    e.setNom_activite(rs.getString(2));
                    e.setType_activite(rs.getString(3));
                    e.setPrix_activite(rs.getString(4));
                    e.setNb_pers(rs.getString(5));
                    e.setDate_debut(rs.getString(6));
                    e.setDate_fin(rs.getString(7));
                    e.setFiche_descriptive(rs.getString(8));
                  
                    myList.add(e);
                }
            }catch (SQLException ex){
                System.out.println("Error"+ex.getMessage());
            }
            return myList;
            
        }
 public void DeleteEvent (int x) throws SQLException  {
        String req ="DELETE FROM activite WHERE id= '"+x+"'";
        PreparedStatement pst = MyDB.getInstance().getCnx().prepareStatement(req);
        pst.executeUpdate();
                          System.out.println("event Supprimée");

    }
}
