package org.modelo;
import javax.persistence.Entity;
import javax.persistence.Id;

@Entity
public class Cine {
    @Id
    private String nombre;

    public Cine() {
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
