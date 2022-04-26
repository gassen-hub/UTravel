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
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import Entities.* ; 
import Service.* ; 
import java.io.IOException;
import java.sql.SQLException;
import java.util.Optional;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.control.Alert;
import javafx.scene.control.ButtonType;
import javafx.scene.control.TextField;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.scene.web.WebEngine;
import javafx.scene.web.WebView;
import javafx.stage.Stage;




import java.io.BufferedInputStream;
import java.io.BufferedOutputStream;
import java.io.BufferedWriter;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.OutputStream;
import java.net.URL;
import java.sql.Connection;
import java.sql.Date;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ResourceBundle;
import javafx.beans.property.ReadOnlyObjectWrapper;
import javafx.beans.value.ObservableValue;
import javafx.collections.ObservableList;
import javafx.event.ActionEvent;
import javafx.event.EventHandler;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Button;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.TextField;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.scene.image.ImageView;
import javafx.scene.input.MouseEvent;
import javafx.util.Callback;
import java.time.format.DateTimeFormatter;
import java.util.Random;
import javafx.collections.FXCollections;
import javafx.fxml.FXMLLoader;
import javafx.scene.Node;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Alert;
import javafx.scene.control.ComboBox;
import javafx.scene.control.DatePicker;
import javafx.scene.image.Image;
import javafx.scene.input.KeyEvent;
import javafx.stage.FileChooser;
import javafx.stage.Stage;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.FileWriter;
import java.io.Writer;
import static java.nio.file.Files.list;
import static java.rmi.Naming.list;
import static java.util.Collections.list;
import javafx.stage.StageStyle;
import org.apache.poi.hssf.usermodel.HSSFWorkbook;
import org.apache.poi.sl.usermodel.Sheet;
import org.apache.poi.ss.usermodel.Row;
import org.apache.poi.ss.usermodel.Workbook;
import org.apache.poi.ss.usermodel.WorkbookFactory;
import java.util.List;
import java.util.Optional;
import javafx.scene.control.ButtonType;
import javafx.scene.paint.Color;
import javafx.scene.web.WebEngine;
import javafx.scene.web.WebView;
import javafx.util.Duration;
import tray.animations.AnimationType;
import tray.notification.NotificationType;
import tray.notification.TrayNotification;

/**
 * FXML Controller class
 *
 * @author Gaston
 */
public class FXMLController implements Initializable {

    @FXML
    private TableView<Activite> Table;
    @FXML
    private TableColumn<?, ?> cNom;
    @FXML
    private TableColumn<?, ?> cType;
    @FXML
    private TableColumn<?, ?> cPrix;
    @FXML
    private TableColumn<?, ?> cNb;
    @FXML
    private TableColumn<?, ?> cDB;
    @FXML
    private TableColumn<?, ?> cDF;
    @FXML
    private TableColumn<?, ?> cFD;
    @FXML
    private Button btnDelete;
    @FXML
    private Button btnEdit;
        ActiviteService cr = new ActiviteService();
    @FXML
    private TextField fNom;
    @FXML
    private TextField fType;
    @FXML
    private TextField fPrix;
    @FXML
    private TextField fNB;
    @FXML
    private TextField fDD;
    @FXML
    private TextField fDF;
    @FXML
    private TextField fFiche;
    
    static String gouv;
    static String endro;
    @FXML
    private Button btnMap;
    @FXML
    private Button btnDelete1;
    /**
     * Initializes the controller class.
     * @param url
     * @param rb
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        // TODO
        afficherEvent() ; 
    }    

    @FXML
    private void event(ActionEvent event) {
    }
    public void afficherEvent() {
        cNom.setCellValueFactory(new PropertyValueFactory<>("nom_activite"));
        cType.setCellValueFactory(new PropertyValueFactory<>("type_activite"));
        cPrix.setCellValueFactory(new PropertyValueFactory<>("prix_activite"));
        cNb.setCellValueFactory(new PropertyValueFactory<>("nb_pers"));
        cDB.setCellValueFactory(new PropertyValueFactory<>("date_debut"));
        cDF.setCellValueFactory(new PropertyValueFactory<>("date_fin"));
        cFD.setCellValueFactory(new PropertyValueFactory<>("fiche_descriptive"));
        Table.setItems(null);
        Table.setItems(cr.showEvent());
    }
    
    @FXML
    private void deleteEvent(ActionEvent event) throws SQLException {
        if (!Table.getSelectionModel().isEmpty()) {
            Alert alert = new Alert(Alert.AlertType.CONFIRMATION);
            alert.setTitle("Delete event ?");
            alert.setHeaderText("Are you sure you want to delete this Sponsore : " + Table.getSelectionModel().getSelectedItem().getNom_activite() + " ?");
            Optional<ButtonType> result = alert.showAndWait();
            if (result.get() == ButtonType.OK) {
                
                cr.DeleteEvent(Table.getSelectionModel().getSelectedItem().getId());
               afficherEvent();
               // EmptyFields(event);

            }
        } else {
            Alert alert = new Alert(Alert.AlertType.CONFIRMATION);
            alert.setTitle("Erreur");
            alert.setHeaderText("Would you select a activte ! !");
            Optional<ButtonType> result = alert.showAndWait();
        }
         
       // EmptyFields(event);
    }
     @FXML
    private void ShowMap(ActionEvent event) {
       if (!Table.getSelectionModel().getSelectedItems().isEmpty()) {

            endro = Table.getSelectionModel().getSelectedItem().getPlace();
            gouv = Table.getSelectionModel().getSelectedItem().getPays();
            FXMLLoader loader = new FXMLLoader(getClass().getResource("MapFXML.fxml"));
            try {
                Parent root = loader.load();
                MapFXMLController dc = loader.getController();
                btnMap.getScene().setRoot(root);
            } catch (IOException ex) {
                Logger.getLogger(MapFXMLController.class.getName()).log(Level.SEVERE, null, ex);
            }
        } else {
            Alert alert = new Alert(Alert.AlertType.WARNING);
            alert.setTitle("Erreur");
            alert.setHeaderText("Would you select an event !");
            Optional<ButtonType> result = alert.showAndWait();
        }

    }
@FXML
    private void SendSMS (ActionEvent event) {
    
         Stage stage = new Stage ();
        final WebView webView = new WebView();
        final WebEngine webEngine = webView.getEngine();
        webEngine.load(getClass().getResource("googleMaps.html").toString());
       
        // create scene
       // stage.getIcons().add(new Image("/Assets/logo.png"));
        stage.setTitle("localisation");
        Scene scene = new Scene(webView,1000,700, Color.web("#666970"));
        stage.setScene(scene);
        // show stage
        stage.show();
    
    
    }
     
}
