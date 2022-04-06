package org.modelo;
import com.fasterxml.jackson.annotation.JsonAutoDetect;

import javax.persistence.Embeddable;
import javax.persistence.Entity;
import javax.persistence.Id;

@JsonAutoDetect(fieldVisibility = JsonAutoDetect.Visibility.ANY)
@Entity
public class Cine {
    @Id
    private String nombre;
    private String ubicacion;

    public Cine() {
        super();
    }

    public Cine(String nombre) {
        this.nombre = nombre;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public String getUbicacion() {
        return ubicacion;
    }

    public void setUbicacion(String ubicacion) {
        this.ubicacion = ubicacion;
    }

    @Override
    public String toString() {
        return "Cine{" +
                "nombre='" + nombre + '\'' +
                '}';
    }
}
