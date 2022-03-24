package org.modelo;

import com.fasterxml.jackson.annotation.JsonAutoDetect;

import javax.persistence.*;
import java.util.*;

@Entity
//@NamedQuery(name = "Pelicula.findAll", query = "SELECT titulo FROM Pelicula ORDER BY titulo", hints = @QueryHint(name = "org.hibernate.cacheable", value = "true"))
public class Pelicula {

    @Id
    String titulo;
    String genero;
    String descripcion;

    public Pelicula() {
        super();
    }


    public String getTitulo() {
        return titulo;
    }

    public void setTitulo(String titulo) {
        this.titulo = titulo;
    }

    public String getGenero() {
        return genero;
    }

    public void setGenero(String genero) {
        this.genero = genero;
    }

    public String getDescripcion() {
        return descripcion;
    }

    public void setDescripcion(String descripcion) {
        this.descripcion = descripcion;
    }

    @Override
    public String toString() {
        return "Pelicula{" +
                ", titulo='" + titulo + '\'' +
                ", genero='" + genero + '\'' +
                ", descripcion='" + descripcion + '\'' +
                '}';
    }
}
