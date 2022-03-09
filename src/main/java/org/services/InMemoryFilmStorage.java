package org.services;

import org.modelo.Pelicula;

import javax.enterprise.context.ApplicationScoped;
import java.util.Collection;
import java.util.HashMap;
import java.util.Map;

@ApplicationScoped
public class InMemoryFilmStorage implements FilmStorage {
    Map<Integer, Pelicula> peliculas = new HashMap<>();

    public InMemoryFilmStorage() {
        super();
        peliculas.put(1, new Pelicula("Harry Poter", "Fantasía"));
        peliculas.put(2, new Pelicula("Separations", "Aventura"));
        peliculas.put(3, new Pelicula("Eternals", "Aventura"));
        peliculas.put(4, new Pelicula("Infinite", "Ciencia Ficción"));
    }

    @Override
    public Pelicula createFilm(Pelicula peli) {
        if (peliculas.containsKey(peli.getId())){return Pelicula.NOT_FOUND;}
        return peliculas.put(peli.getId(), peli);
    }

    @Override
    public Pelicula retrieveFilm(String id) {
        if (peliculas.containsKey(id) == false) return Pelicula.NOT_FOUND;

        return peliculas.get(id);
    }

    @Override
    public Pelicula updateFilm(Pelicula peli) {
        if (peliculas.containsKey(peli.getId()) == false) return Pelicula.NOT_FOUND;

        return peliculas.put(peli.getId(), peli);
    }

    @Override
    public Pelicula deleteFilm(String id) {
        if (peliculas.containsKey(id) == false) return Pelicula.NOT_FOUND;

        return peliculas.remove(id);
    }

    @Override
    public Collection<Pelicula> getFilms() {
        return peliculas.values();
    }
}
