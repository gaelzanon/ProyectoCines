package org.modelo;

import javax.persistence.Entity;
import javax.persistence.Id;

@Entity
public class Encuesta {

    @Id
    private String id;
    private String nombre;  // nombre de la encuesta
    private String opcion1; // Opciones que van a tener cada encuesta
    private String opcion2;
    private String opcion3;
    private String opcion4;
    private int reslt1;
    private int reslt2;
    private int reslt3;
    private int reslt4;
    private int total;

    public Encuesta() {
        super();
    }

}
