package org.dao;

import org.modelo.Pelicula;
import org.services.FilmStorage;

import javax.enterprise.context.ApplicationScoped;
import javax.inject.Inject;
import java.util.Collection;

@ApplicationScoped
public class FilmDAOMemory implements FilmDAO {
    @Inject
    FilmStorage ds;

    @Override
    public Pelicula create(Pelicula peli) {
        return ds.createFilm(peli);
    }

    @Override
    public Pelicula retrieve(String id) {
        return ds.retrieveFilm(id);
    }

    @Override
    public Collection<Pelicula> retrieveAll() {
        return ds.getFilms();
    }

    @Override
    public Pelicula update(Pelicula peli) {
        return ds.updateFilm(peli);
    }

    @Override
    public Pelicula delete(String id) {return ds.deleteFilm(id);}
}
