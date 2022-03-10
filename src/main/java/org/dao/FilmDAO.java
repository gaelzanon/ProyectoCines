package org.dao;

import org.modelo.Pelicula;

import java.util.Collection;

public interface FilmDAO {
    Pelicula create(Pelicula peli);
    Pelicula retrieve(String id);
    Collection<Pelicula> retrieveAll();
    Pelicula update(Pelicula peli);
    Pelicula delete(String id);
}
