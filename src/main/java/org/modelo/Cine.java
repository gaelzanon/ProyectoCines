package org.modelo;

import javax.persistence.Entity;
import javax.persistence.Id;

@Entity
public class Cine {
    @Id
    private String nombre;
    private String ubicacion;


    public Cine() {
        super();
    }

}
