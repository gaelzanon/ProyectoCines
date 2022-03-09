const RETRIEVE_ALL = "http://localhost:8080/peliculas"
const POST = "http://localhost:8080/peliculas/create"
const DELETE = "http://localhost:8080/peliculas/delete/"
const RETRIEVE_ONE = "http://localhost:8080/peliculas/retrieve/"
const UPDATE = "http://localhost:8080/peliculas/update"

Vue.createApp({
    data() {
        return {
            films: [],
            titulo: "",
            genero: "",
            id: "",
            currentFilm: {}
        }
    },
    methods: {
        async doGet() {
            await axios.get(RETRIEVE_ALL)
                .then((response) => {
                    this.films = response.data
                    console.log(response.data)
                })
                .catch((error) => {
                    console.log("Error getting data:" + error)
                })
        },

        async retrieveFilm(index) {
            console.log("Film at index: ", index);
            var url = RETRIEVE_ONE + this.films[index].id;
            var coso = this;
            await axios.get(url)
                .then(function (response) {
                    console.log(response.data);
                    coso.currentFilm = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                })
        },

        async createFilm(titulo, genero) {
            var self = this;
            let peli = {
                titulo: titulo,
                genero: genero,
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

        async updateFilm() {
            const coso = this;
            await axios.put(UPDATE, this.currentFilm)
                .then(function (response) {
                    console.log(response);
                    coso.doGet();
                })
                .catch(function (error) {
                    console.log(error);
                })
        },

        async deleteFilm(index) {
            console.log("Removing film at index:", index);
            var coso = this;
            var url = DELETE + this.films[index].id;
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