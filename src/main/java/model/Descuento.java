package model;
import javax.persistence.Entity;
import javax.persistence.Id;

@Entity
public class Descuento {
    @Id
    private String nombre;
    private String descripcion;

    public Descuento() {
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public String getDescripcion() {
        return descripcion;
    }

    public void setDescripcion(String descripcion) {
        this.descripcion = descripcion;
    }

    @Override
    public String toString() {
        return "Cine{" +
                "nombre='" + nombre + '\'' +
                ", ubicacion='" + descripcion + '\'' +
                '}';
    }
}