package org.modelo;

import javax.persistence.*;

@Entity
public class Pelicula {

    @Id
    private String id;
    private String titulo;
    private String genero;
    private String descripcion;
    private String fechaEstreno;
    
    
    public Pelicula() {
        super();
    }

}
