const RETRIEVE_ALL = "http://localhost:8080/descuentos"
const POST = "http://localhost:8080/descuentos/create"
const DELETE = "http://localhost:8080/descuentos/delete/"
const RETRIEVE_ONE = "http://localhost:8080/descuentos/retrieve/"
const UPDATE = "http://localhost:8080/descuentos/update"

Vue.createApp({
    data() {
        return {
            descuentos: [],
            nombre: "",
            descripcion: "",
            currentdiscount: {}
        }
    },
    methods: {
        async doGet() {
            await axios.get(RETRIEVE_ALL)
                .then((response) => {
                    this.descuentos = response.data
                    console.log(response.data)
                })
                .catch((error) => {
                    console.log("Error getting data:" + error)
                })
        },

        async retrievediscount(index) {
            console.log("Discount at index: ", index);
            var url = RETRIEVE_ONE + this.descuentos[index].nombre;
            var coso = this;
            await axios.get(url)
                .then(function (response) {
                    console.log(response.data);
                    coso.currentdiscount = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                })
        },

        async creatediscount(nombre, descripcion) {
            var self = this;
            let peli = {
                nombre: nombre,
                descripcion: descripcion,
            };
            await axios.post(POST, peli)
                .then(function (response) {
                    console.log(response);
                    self.doGet();
                })
                .catch(function (error) {
                    console.log(error);
                })
        },

        async updatediscount() {
            const coso = this;
            await axios.put(UPDATE, this.currentdiscount)
                .then(function (response) {
                    console.log(response);
                    coso.doGet();
                })
                .catch(function (error) {
                    console.log(error);
                })
        },

        async deletediscount(index) {
            console.log("Removing discount at index:", index);
            var coso = this;
            var url = DELETE + this.descuentos[index].nombre;
            await axios.delete(url)
                .then(function (response) {
                    console.log(response);
                    coso.doGet();
                })
                .catch(function (error) {
                    console.log(error);
                })
        }
    },
    mounted() {
        this.doGet()
    }
}).mount("#app")