package org.modelo;
import javax.persistence.Entity;
import javax.persistence.EnumType;
import javax.persistence.Enumerated;
import javax.persistence.Id;
import java.util.List;

@Entity
public class Espectador {
    @Id
    private String nombre;
    //@Enumerated(EnumType.STRING)
    private String nivel;   //PHP no permite convertir un enum a string
    //@Enumerated(EnumType.STRING)
    private String genero;


    public Espectador(){
        super();
    }

}
