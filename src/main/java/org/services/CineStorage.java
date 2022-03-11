package org.services;

import org.modelo.Cine;

import java.util.Collection;

public interface CineStorage {
    Cine createCine(Cine cine);
    Cine retrieveCine(int id);
    Collection<Cine> getCines();
}
