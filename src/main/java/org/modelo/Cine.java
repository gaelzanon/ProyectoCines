package org.modelo;
import com.fasterxml.jackson.annotation.JsonAutoDetect;

import javax.persistence.Entity;
import javax.persistence.Id;

@JsonAutoDetect(fieldVisibility = JsonAutoDetect.Visibility.ANY)
public class Cine {
    static int id = 0;
    private String nombre;

    public static final Cine NOT_FOUND = new Cine("Not found");

    public Cine() {
        super();
    }

    public Cine(String nombre) {
        this.nombre = nombre;
    }

    public int getId() {
        return id;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    @Override
    public String toString() {
        return "Cine{" +
                "nombre='" + nombre + '\'' +
                '}';
    }
}
