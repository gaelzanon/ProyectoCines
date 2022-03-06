package org.modelo;
import javax.persistence.Entity;
import javax.persistence.EnumType;
import javax.persistence.Enumerated;
import javax.persistence.Id;

@Entity
public class Espectador {
    @Id
    private String nombre;
    @Enumerated(EnumType.STRING)
    private Nivel nivel;
    //Falta poner Gustos

    public Espectador(){

    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public Nivel getNivel() {
        return nivel;
    }

    public void setNivel(Nivel nuevoNivel) {
        this.nivel = nuevoNivel;
    }

    @Override
    public String toString() {
        return "Espectador{" +
                "nombre='" + nombre + '\'' +
                ", nivel=" + nivel +
                '}';
    }
}
