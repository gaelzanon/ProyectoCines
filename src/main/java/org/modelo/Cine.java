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


    public static final Cine NOT_FOUND = new Cine("Not found");

    public Cine() {
        super();
    }

    public Cine(String nombre) {
        this.nombre = nombre;
    }


    @Override
    public String toString() {
        return "Cine{" +
                "nombre='" + nombre + '\'' +
                '}';
    }
}
