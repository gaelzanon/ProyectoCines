package org.resources;

import org.modelo.Pelicula;
import org.dao.FilmDAO;


import javax.inject.Inject;
import javax.ws.rs.*;
import javax.ws.rs.core.MediaType;
import javax.ws.rs.core.Response;
import java.net.URI;
import java.net.URISyntaxException;

@Path("/peliculas")
public class FilmResource {

    @Inject
    FilmDAO ds;

    @GET
    @Produces(MediaType.APPLICATION_JSON)
    public Response getData() {
        return Response.ok(ds.retrieveAll()).build();
    }

    @GET
    @Produces(MediaType.APPLICATION_JSON)
    @Path("/retrieve/{id}")
    public Response getFilm(@PathParam("id") final String id) {
        if (ds.retrieve(id) == Pelicula.NOT_FOUND) return Response.status(Response.Status.NOT_FOUND).build();

        return Response.ok(ds.retrieve(id)).build();
    }

    @POST
    @Consumes(MediaType.APPLICATION_JSON)
    @Path("/create")
    public Response createFilm(Pelicula peli) throws URISyntaxException {
        Pelicula response = ds.create(peli);
        if(response == Pelicula.NOT_FOUND) return Response.status(Response.Status.CONFLICT).build();
        URI uri = new URI("/peliculas/" + peli.getId());
        return Response.created(uri).build();
    }

    @PUT
    @Consumes(MediaType.APPLICATION_JSON)
    @Path("/update")
    public Response updateFilm(final Pelicula peli) throws URISyntaxException {
        Pelicula result = ds.update(peli);
        if(result == Pelicula.NOT_FOUND) return Response.status(Response.Status.NOT_FOUND).build();
        return Response.noContent().build();
    }

    @DELETE
    @Path("/delete/{id}")
    public Response deleteFilm(@PathParam("id") final String id) {
        Pelicula result = ds.delete(id);
        if(result == Pelicula.NOT_FOUND) return Response.status(Response.Status.NOT_FOUND).build();
        return Response.noContent().build();
    }
}