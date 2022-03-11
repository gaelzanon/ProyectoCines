package org.dao;

import org.modelo.Cine;

import java.util.Collection;

public interface CineDAO {

    Cine create(Cine cine);
    Cine retrieve(int id);
    Collection<Cine> retrieveAll();
}
