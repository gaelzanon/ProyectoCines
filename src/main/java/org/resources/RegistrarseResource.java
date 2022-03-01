package org.resources;

import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

//TODO: investigar https://quarkus.io/guides/security-built-in-authentication

@Path("/registrarse")
public class RegistrarseResource {

    @GET
    @Produces(MediaType.TEXT_PLAIN)
    public String hello() {
        return "Pagina de registrarse";
    }
}