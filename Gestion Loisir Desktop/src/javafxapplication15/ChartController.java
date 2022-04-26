/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package javafxapplication15;

import java.net.URL;
import java.sql.Connection;
import java.sql.ResultSet;
import java.util.ResourceBundle;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.chart.PieChart;
import javafx.scene.control.Button;
import utils.MyDB;

/**
 * FXML Controller class
 *
 * @author Gaston
 */
public class ChartController implements Initializable {

    @FXML
    private PieChart chart;
    @FXML
    private Button btnExecute;
   private ObservableList<PieChart.Data> data;

    /**
     * Initializes the controller class.
     */
   
   
    private void buildPieChartData() {
        try {
             Connection c ;
            MyDB ds = MyDB.getInstance();
          data = FXCollections.observableArrayList();
           c = ds.getCnx();
           String SQL = "SELECT prix_activite,nom_activite FROM activite";
              ResultSet rs = c.createStatement().executeQuery(SQL);

            while (rs.next()) {
               data.add(new PieChart.Data(rs.getString(2),rs.getDouble(1)));
                
            }
            chart.setTitle("Prix Par Activite");
            chart.setData(data);

        } catch (Exception e) {
            System.out.println(e.getMessage());
        }

    }
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        // TODO
        buildPieChartData();
    }    
@FXML
    private void ViewChart(ActionEvent event) {
          buildPieChartData();
          
    }

    
}
