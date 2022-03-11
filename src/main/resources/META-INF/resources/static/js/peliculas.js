const RETRIEVE_ALL = "http://localhost:8080/cines"
const POST = "http://localhost:8080/cines/create"
const RETRIEVE_ONE = "http://localhost:8080/cines/retrieve/"

Vue.createApp({
    data() {
        return {
            cines: [],
            nombre: "",
            id: "",
            currentCine: {}
        }
    },
    methods: {
        async doGet() {
            await axios.get(RETRIEVE_ALL)
                .then((response) => {
                    this.cines = response.data
                    console.log(response.data)
                })
                .catch((error) => {
                    console.log("Error getting data:" + error)
                })
        },

        async retrieveCine(index) {
            console.log("Film at index: ", index);
            var url = RETRIEVE_ONE + this.cines[index].id;
            var coso = this;
            await axios.get(url)
                .then(function (response) {
                    console.log(response.data);
                    coso.currentCine = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                })
        },

        async createCine(nombre) {
            var self = this;
            let cine = {
                nombre: nombre,
            };
            await axios.post(POST, cine)
                .then(function (response) {
                    console.log(response);
                    self.doGet();
                })
                .catch(function (error) {
                    console.log(error);
                })
        },

    },
    mounted() {
        this.doGet()
    }
}).mount("#app")