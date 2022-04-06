package org.modelo;

import javax.persistence.Entity;
import javax.persistence.Id;

@Entity
public class Usuario {
    @Id
    private String nombre;
    private String tipoUsuario;
    //todo:cifrar?
    private String password;
}
