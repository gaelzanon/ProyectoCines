package org.services;

import org.modelo.Cine;

import javax.enterprise.context.ApplicationScoped;
import java.util.Collection;
import java.util.HashMap;
import java.util.Map;

@ApplicationScoped
public class InMemoryCineStorage implements CineStorage {
    Map<Integer, Cine> cines = new HashMap<>();

    public InMemoryCineStorage() {
        super();
        cines.put(1, new Cine("Cinesa"));
    }

    @Override
    public Cine createCine(Cine cine) {
        if (cines.containsKey(cine.getId())) {
            return Cine.NOT_FOUND;
        }
        return cines.put(cine.getId(), cine);
    }

    @Override
    public Cine retrieveCine(int id) {
        if (cines.containsKey(id) == false)
            return Cine.NOT_FOUND;
        return cines.get(id);
    }

    @Override
    public Collection<Cine> getCines() {
        return cines.values();
    }
}
