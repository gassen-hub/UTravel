/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Entities;

/**
 *
 * @author Gaston
 */
public class Activite {
    
    
    private Integer  id ; 
    private String nom_activite ; 
    private String type_activite ; 
    private String prix_activite ; 
    private String nb_pers ; 
    private String date_debut ; 
    private String date_fin ; 
     private String fiche_descriptive ; 
     private String pays ;
     private String place ;

    public Integer getId() {
        return id;
    }

    public String getNom_activite() {
        return nom_activite;
    }

    public String getType_activite() {
        return type_activite;
    }

    public String getPrix_activite() {
        return prix_activite;
    }

    public String getNb_pers() {
        return nb_pers;
    }

    public String getDate_debut() {
        return date_debut;
    }

    public String getDate_fin() {
        return date_fin;
    }

    public String getFiche_descriptive() {
        return fiche_descriptive;
    }

    public void setId(Integer id) {
        this.id = id;
    }

    public void setNom_activite(String nom_activite) {
        this.nom_activite = nom_activite;
    }

    public void setType_activite(String type_activite) {
        this.type_activite = type_activite;
    }

    public void setPrix_activite(String prix_activite) {
        this.prix_activite = prix_activite;
    }

    public void setNb_pers(String nb_pers) {
        this.nb_pers = nb_pers;
    }

    public void setDate_debut(String date_debut) {
        this.date_debut = date_debut;
    }

    public void setDate_fin(String date_fin) {
        this.date_fin = date_fin;
    }

    public void setFiche_descriptive(String fiche_descriptive) {
        this.fiche_descriptive = fiche_descriptive;
    }

    public Activite(String nom_activite, String type_activite, String prix_activite, String nb_pers, String date_debut, String date_fin, String fiche_descriptive, String pays, String place) {
        this.nom_activite = nom_activite;
        this.type_activite = type_activite;
        this.prix_activite = prix_activite;
        this.nb_pers = nb_pers;
        this.date_debut = date_debut;
        this.date_fin = date_fin;
        this.fiche_descriptive = fiche_descriptive;
        this.pays = pays;
        this.place = place;
    }

  

    public Activite() {
    }

    public String getPlace() {
        return place;
    }

    public String getPays() {
        return pays;
    }

    public void setPays(String pays) {
        this.pays = pays;
    }

    public void setPlace(String place) {
        this.place = place;
    }

    
     
     
}
