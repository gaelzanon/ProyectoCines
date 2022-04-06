package org.modelo;

import javax.persistence.*;
import java.io.Serializable;


@Entity
@IdClass(Descuento.descuentoPK.class)
public class Descuento {

    @Id
    private String cine;
    @Id
    private String nombre;
    private String descripcion;

    public Descuento() {
        super();
    }

    public static  class descuentoPK implements Serializable {

        private String cine;
        private String nombre;
    }
}
