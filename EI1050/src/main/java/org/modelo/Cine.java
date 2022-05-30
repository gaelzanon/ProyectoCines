package org.modelo;

import javax.persistence.Entity;
import javax.persistence.Id;

@Entity
public class Cine {
    @Id
    private String nombre;
    private String provincia;
    private String direccion;


    public Cine() {
        super();
    }

}
