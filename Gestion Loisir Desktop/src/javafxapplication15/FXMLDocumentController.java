/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package javafxapplication15;

import java.net.URL;
import java.sql.Connection;
import java.util.ResourceBundle;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.ToggleButton;
import javafx.scene.control.ToggleGroup;
import javafx.scene.layout.AnchorPane;
import javafx.scene.layout.BorderPane;
import javafx.scene.layout.Pane;
import javafx.stage.Stage;
import utils.MyDB;
/**
 *
 * @author Gaston
 */
public class FXMLDocumentController implements Initializable {
     private  static Stage stage;
  public  static Stage getStage() {return stage;}
  
    private Label label;
    @FXML
    private Button btnOrders;
    @FXML
    private Button btnCustomers;
    @FXML
    private Button btnPackages;
    @FXML
    private Button btnSettings;
    @FXML
    private Button btnSignout;
    @FXML
    private Pane pnlCustomer;
    @FXML
    private Pane pnlOrders;
    @FXML
    private BorderPane root;
    @FXML
    private BorderPane root2;
    @FXML
    private Button btnStats;
    
    
    
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        // TODO
        Connection con=MyDB.getInstance().getCnx();
         changeScene("Welcome.fxml");
    }    
    @FXML
    private void Form(ActionEvent event) {
         changeScene("RealForm.fxml");
    }
     @FXML
    private void Liste(ActionEvent event) {
         changeScene("FXML.fxml");
    }
     @FXML
    private void Stats(ActionEvent event) {
         changeScene("Chart.fxml");
    }
     @FXML
      
    private void Note (ActionEvent event) {
          // Parent root = FXMLLoader.load(getClass().getResource("FXMLDocument.fxml"));
       
       // Scene scene = new Scene(root);
           NoteController rootXML=new NoteController();
           Scene scene = new Scene(rootXML);
        stage.setScene(scene);
        stage.show();
    }
    public  void changeScene(String scenePath){
        
        FXMLLoader loader;
        loader = new FXMLLoader(getClass().getResource(scenePath));
        AnchorPane pane = new AnchorPane();
    try{
            pane = (AnchorPane) loader.load();
            root2.setCenter(pane);
        }
        catch(Exception e){
        }
     
    }
    
}
