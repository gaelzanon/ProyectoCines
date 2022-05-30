package org.modelo;

import javax.persistence.Entity;
import javax.persistence.Id;

@Entity
public class Valoracion {
    @Id
    private String id;
    private String usuario;
    private String pelicula;
    private int puntuacion;
    private String Comentario;
    private String cine;


    public Valoracion() {
    }
}
