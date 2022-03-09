package org.modelo;

import com.fasterxml.jackson.annotation.JsonAutoDetect;

import javax.persistence.Entity;
import javax.persistence.Id;
import java.util.*;

@JsonAutoDetect(fieldVisibility = JsonAutoDetect.Visibility.ANY)
public class Pelicula {

    static int id=0;
    String titulo;
    String genero;
    String descripcion;
    List<String> comentarios;

    public static final Pelicula NOT_FOUND = new Pelicula("Not founc", "");

    public Pelicula() {
        super();
    }

    public Pelicula(String titulo, String genero) {
        this.titulo = titulo;
        this.genero = genero;
    }

    public int getId() {
        return id++;
    }

    public String getTitulo() {return titulo;}

    public void setTitulo(String nombre) {
        this.titulo = nombre;
    }

    public String getDescripcion() {
        return descripcion;
    }

    public List<String> comentariosPelicula(){ return comentarios;}

    @Override
    public boolean equals(Object o) {
        if (this == o) return true;
        if (o == null || getClass() != o.getClass()) return false;
        Pelicula contact = (Pelicula) o;
        return Objects.equals(titulo, contact.titulo) && Objects.equals(genero, contact.genero) && (this.getId() == contact.getId());
    }

    @Override
    public int hashCode() {
        return Objects.hash(titulo, genero, id);
    }

    @Override
    public String toString() {
        return "Pelicula{" +
                "Titulo='" + titulo + '\'' +
                ", genero='" + genero + '\'' +
                ", id='" + id + '\'' +
                '}';
    }
}
