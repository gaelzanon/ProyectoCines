package org.modelo;

import javax.persistence.Entity;
import javax.persistence.EnumType;
import javax.persistence.Enumerated;
import javax.persistence.Id;

@Entity
public class Usuario {
    @Id
    private String nombre;
    @Enumerated(EnumType.STRING)
    private TipoUsuario tipoUsuario;
    //todo:cifrar?
    private String password;
}
