/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package javafxapplication15;

import java.net.URL;
import java.util.ResourceBundle;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Button;
import javafx.scene.control.TextField;
import javafx.scene.image.ImageView;
import javafx.scene.input.DragEvent;
import Entities.Activite;
import Service.ActiviteService;
import java.sql.Date;
import java.sql.SQLException;
/**
 * FXML Controller class
 *
 * @author Gaston
 */
public class RealFormController implements Initializable {
    @FXML
    private TextField fPrix;
    @FXML
    private TextField fNom;
    @FXML
    private TextField fType;
    @FXML
    private TextField fNB;
    @FXML
    private TextField fDD;
    @FXML
    private TextField fDF;
    @FXML
    private TextField fFiche;
    @FXML
    private Button btnInsert;
 ActiviteService cr = new ActiviteService();
    @FXML
    private TextField ftplace;
    @FXML
    private TextField ftpays;
    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        // TODO
    }    

    @FXML
    void AddCommande(ActionEvent event)throws SQLException {
       
       
        /*
        Activite ev = new Activite();
       
        ev.setNom_activite(fNom.getText());
        ev.setType_activite(fType.getText());
        ev.setPrix_activite(fPrix.getText());
        ev.setNb_pers(fNB.getText());
        ev.setDate_debut(fDD.getText());
        ev.setDate_fin(fDF.getText());
        ev.setFiche_descriptive(fFiche.getText());
        
         e.ajouter(ev);
     
        fNom.setText("");
        fType.setText("");
        fPrix.setText("");
        fNB.setText(""); 
        fDD.setText("");
        fDF.setText("");
         fFiche.setText("");


        */
       String nom_activite = fNom.getText();
       String type_activite = fType.getText();
        String prix_activite = fPrix.getText();
        String nb_pers = fNB.getText();
        String date_debut = fDD.getText();
        String date_fin = fDF.getText();
        String fiche_descriptive = fDF.getText();
        String pays = ftplace.getText();
        String place = ftpays.getText();
        
        Activite e = new Activite(nom_activite, type_activite, prix_activite, nb_pers, date_debut, date_fin, fiche_descriptive,pays,place);
        cr.ajouter(e);
        
                 }
}
