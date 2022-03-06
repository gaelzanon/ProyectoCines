package org.resources;

import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

@Path("/hello")
public class GreetingResource {

    @GET
    @Produces(MediaType.TEXT_PLAIN)
    public String hello() {
        return "Hola RESTEasy";
    }

    @POST
    @Produces(MediaType.TEXT_PLAIN)
    public String helloName(String name){

        return "Hola "+ name.toUpperCase();
    }

}