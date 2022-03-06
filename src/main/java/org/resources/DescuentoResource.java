package org.resources;

import org.jboss.resteasy.annotations.jaxrs.PathParam;
import org.modelo.Descuento;

import javax.annotation.security.RolesAllowed;
import javax.inject.Inject;
import javax.persistence.EntityManager;
import javax.transaction.Transactional;
import javax.ws.rs.*;
import javax.ws.rs.core.Response;
import java.util.List;

@Path("descuento")
public class DescuentoResource {

    @Inject
    EntityManager entityManager;

    @GET
    public List<String> get(){
        return entityManager.createNamedQuery("Descuento.findAll",String.class).getResultList();
    }

    @GET
    @Path("{nombre}")
    public Descuento getSingle(@PathParam String nombre){
        Descuento descuento=entityManager.find(Descuento.class,nombre);
        if(descuento==null){
            throw new WebApplicationException("El descuento "+nombre+" no existe.",404);
        }
        return descuento;
    }

    @POST
    @Transactional
    @RolesAllowed("admin")
    @Path("add")
    public Response create(Descuento descuento){
        //todo: comprobar si el nombre existe. entytymanager.contains?
        if(entityManager.find(Descuento.class,descuento.getNombre())!=null){
            throw new WebApplicationException("El descuento con nombre "+descuento.getNombre()+" ya existe.", 422);
        }
        entityManager.persist(descuento);
        return Response.ok(descuento).build();
    }

    @PUT
    @Path("{nombre}/update") //todo:revisar si así bien
    @RolesAllowed("admin")
    @Transactional
    public Response update(@PathParam String nombre, Descuento descuento) {
        if (descuento.getNombre() == null) {
            throw new WebApplicationException("El descuento no tiene nombre.", 422);
        }

        Descuento descuento1 = entityManager.find(Descuento.class, nombre);

        if (descuento1 == null) {
            throw new WebApplicationException("El descuento " + nombre + " no existe.", 404);
        }

        descuento1.setNombre(descuento.getNombre());
        descuento1.setDescripcion(descuento.getDescripcion());

        return Response.ok(descuento1).build();
    }

    @DELETE
    @Path("{nombre}/delete")
    @RolesAllowed("admin")
    @Transactional
    public Response delete(@PathParam String nombre) {
        Descuento descuento = entityManager.getReference(Descuento.class, nombre);
        if (descuento == null) {
            throw new WebApplicationException("El descuento " + nombre + " no existe.", 404);
        }
        entityManager.remove(descuento);
        return Response.ok().build();
    }
}
