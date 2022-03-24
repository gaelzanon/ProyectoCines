//package org.resources;
//
//import org.modelo.Descuento;
//import org.modelo.Pelicula;
//
//
//import javax.annotation.security.RolesAllowed;
//import javax.inject.Inject;
//import javax.persistence.EntityManager;
//import javax.transaction.Transactional;
//import javax.ws.rs.*;
//import javax.ws.rs.core.MediaType;
//import javax.ws.rs.core.Response;
//import java.net.URI;
//import java.net.URISyntaxException;
//import java.util.List;
//import org.jboss.resteasy.annotations.jaxrs.PathParam;
//
//
//@Path("/pelicula")
//public class FilmResource {
//
//    @Inject
//    EntityManager entityManager;
//
//    @GET
//    public List<String> get(){
//        return entityManager.createNamedQuery("Pelicula.findAll",String.class).getResultList();
//    }
//
//    @GET
//    @Path("get/{id}")
//    public Pelicula getSingle(@PathParam int id){
//        Pelicula pelicula=entityManager.find(Pelicula.class,id);
//        if(pelicula==null){
//            throw new WebApplicationException("La pelicula con id "+id+" no existe.",404);
//        }
//        return pelicula;
//    }
//
//    @POST
//    @Transactional
//    @RolesAllowed("admin")
//    @Path("add")
//    public Response create(Pelicula pelicula){
//        //todo: comprobar si id existe. entytymanager.contains?
//        if(entityManager.find(Pelicula.class,pelicula.getId())!=null){
//            throw new WebApplicationException("La pelicula con id "+pelicula.getId()+" ya existe.", 422);
//        }
//        entityManager.persist(pelicula);
//        return Response.ok(pelicula).build();
//    }
//
//
//    @PUT
//    @Path("update/{id}") //todo:revisar si así bien
//    @RolesAllowed("admin")
//    @Transactional
//    public Response update(@PathParam int id, Pelicula pelicula) {
//        if (pelicula==null) {
//            throw new WebApplicationException("Los datos que quieres actualizar son nulos.", 422);
//        }
//
//        Pelicula pelicula1 = entityManager.find(Pelicula.class, id);
//
//        if (pelicula1 == null) {
//            throw new WebApplicationException("la pelicula con id" + id + " no existe.", 404);
//        }
//
//        pelicula1.setTitulo(pelicula.getTitulo());
//        pelicula1.setGenero(pelicula.getGenero());
//        pelicula1.setDescripcion(pelicula.getDescripcion());
//
//        return Response.ok(pelicula1).build();
//    }
//
//    @DELETE
//    @Path("delete/{id}")
//    @RolesAllowed("admin")
//    @Transactional
//    public Response delete(@PathParam int id) {
//        Pelicula pelicula = entityManager.getReference(Pelicula.class, id);
//        if (pelicula == null) {
//            throw new WebApplicationException("La pelicula con id " + id + " no existe.", 404);
//        }
//        entityManager.remove(pelicula);
//        return Response.ok().build();
//    }
//}