package model;

import java.util.List;

//@Entity
public class Pelicula {

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

    public void comentariosPelicula(String comentario){ comentarios.add(comentario);}

    @Override
    public String toString() {
        return "Pelicula{" +
                "Titulo=" +""+ titulo + '}';
    }
}
