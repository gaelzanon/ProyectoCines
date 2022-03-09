package org.services;

import org.modelo.Pelicula;

import java.util.Collection;

public interface FilmStorage {
    Pelicula createFilm(Pelicula peli);
    Pelicula retrieveFilm(String nif);
    Pelicula updateFilm(Pelicula peli);
    Pelicula deleteFilm(String id);
    Collection<Pelicula> getFilms();
}
