package org.modelo;

import javax.persistence.*;
import java.io.Serializable;


@Entity
@NamedQuery(name = "Descuento.findAll", query = "SELECT nombre FROM Descuento ORDER BY nombre", hints = @QueryHint(name = "org.hibernate.cacheable", value = "true"))
@IdClass(Descuento.descuentoPK.class)
public class Descuento {

    @Id
    private String cine;
    @Id
    private String nombre;
    private String descripcion;

    public Descuento() {
    }

    public static  class descuentoPK implements Serializable {

        private String cine;
        private String nombre;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public String getDescripcion() {
        return descripcion;
    }

    public void setDescripcion(String descripcion) {
        this.descripcion = descripcion;
    }

    @Override
    public String toString() {
        return "Cine{" +
                "nombre='" + nombre + '\'' +
                ", ubicacion='" + descripcion + '\'' +
                '}';
    }
}
