package model;
import javax.persistence.Entity;

@Entity
public class Espectador {
    private String nombre;
    private String ubicacion;
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

    public String getUbicacion() {
        return ubicacion;
    }

    public void setUbicacion(String ubicacion) {
        this.ubicacion = ubicacion;
    }

    public Nivel getNivel() {
        return nivel;
    }

    public void setNivel(Nivel nuevoNivel) {
        this.nivel = nuevoNivel;
    }

}
