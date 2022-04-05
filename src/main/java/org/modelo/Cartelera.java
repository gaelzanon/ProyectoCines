package org.modelo;

import javax.persistence.*;
import java.io.Serializable;
import java.util.Date;

@Entity
@IdClass(Cartelera.carteleraPK.class)
public class Cartelera {

    @Id
    private String cine;
    @Id
    private String pelicula;
    private String fecha;
    private String hora;

    public Cartelera() {
        super();
    }

    public static  class carteleraPK implements Serializable{

        private String cine;
        private String pelicula;
    }

}
