package org.modelo;

import javax.persistence.Entity;
import javax.persistence.Id;

@Entity
public class Entrada {
    @Id
    private String id;
    private String fecha;
    private String pelicula;
    private String cine;
    private String espectador;
    private String descuento;

    public Entrada() {
    }
}
