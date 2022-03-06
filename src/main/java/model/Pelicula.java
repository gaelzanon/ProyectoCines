package model;

import java.util.List;
import javax.persistence.Entity;
import javax.persistence.Id;

@Entity
public class Pelicula {
    @Id
    private String titulo;
    private String descripcion;
    private List<String> comentarios;
    //Falta Genero

    public Pelicula(){

    }

    public String getTitulo() {
        return titulo;
    }

    public void setTitulo(String nombre) {
        this.titulo = nombre;
    }

    public String getDescripcion() {
        return descripcion;
    }

    public List<String> comentariosPelicula(){ return comentarios;}

    @Override
    public String toString() {
        return "Pelicula{" +
                "Titulo=" +""+ titulo + '}';
    }
}
