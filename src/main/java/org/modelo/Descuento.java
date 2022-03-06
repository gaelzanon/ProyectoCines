package org.modelo;

import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.NamedQuery;
import javax.persistence.QueryHint;


@Entity
@NamedQuery(name = "Descuento.findAll", query = "SELECT nombre FROM Descuento ORDER BY nombre", hints = @QueryHint(name = "org.hibernate.cacheable", value = "true"))
public class Descuento {
    @Id
    private String nombre;
    private String descripcion;

    public Descuento() {
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
