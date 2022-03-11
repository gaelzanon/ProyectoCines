package org.dao;

import org.modelo.Cine;
import org.services.CineStorage;

import javax.enterprise.context.ApplicationScoped;
import javax.inject.Inject;
import java.util.Collection;

@ApplicationScoped
public class CineDAOMemory implements CineDAO{
    @Inject
    CineStorage cs;

    @Override
    public Cine create(Cine cine) {
        return cs.createCine(cine);
    }

    @Override
    public Cine retrieve(int id) {
        return cs.retrieveCine(id);
    }

    @Override
    public Collection<Cine> retrieveAll() {
        return cs.getCines();
    }
}
