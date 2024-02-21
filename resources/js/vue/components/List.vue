

<template>
    <div class="container">
        <h1>Listado de Post</h1>

        <!-- <router-link :to="{name:'save'}">Crear</router-link> -->
        <button class="btn btn-success rounded-pill mb-3" @click="$router.push({ name: 'save' })">+ Crear</button>

        <table class="table" v-if="!loading">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Título</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Posteado</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Categoría</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="post in posts" :key="post.id">
                    <th>{{ post.id }}</th>
                    <td>{{ post.title }}</td>
                    <td>{{ post.description }}</td>
                    <td>{{ post.posted }}</td>
                    <td>{{ post.created_at }}</td>
                    <td>{{ post.category.title }}</td>
                    <td>
                        <button class="mr-3 mt-2 btn rounded-pill bg-secondary text-white" @click="$router.push({ name:'save', params:{'slug': post.slug} })">Editar</button>
                        <button class="mr-3 mt-2 btn btn-danger rounded-pill bg-danger" @click="confirmDelete(post)">Eliminar</button>
                    </td> 
                </tr>
            </tbody>
        </table>

        <div v-else>
            Cargando Posts..
        </div>

        <br>
        
        <div class="">
            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item disabled" :class="{ 'disabled': currentPage === 1 }">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true" @click="prevPage">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active" aria-current="page" v-for="page in totalPages" :key="page" :class="{ 'active': currentPage === page }">
                        <a class="page-link" href="#" @click="setPage(page)">{{ page }}</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item" :class="{ 'disabled': currentPage === totalPages }">
                        <a class="page-link" href="#" @click="nextPage">Next</a>
                    </li>
                </ul>
            </nav>
        </div>

    </div>
</template>

<script>
    export default {

        data() {
            return {
                posts : [],
                loading : true,
                currentPage : 1,
                perPage : 5,
            }
        },

        computed: {
            totalPages() {
                return Math.ceil(this.posts.length / this.perPage);
            },
            paginatedPosts() {
                const startIndex = (this.currentPage - 1) * this.perPage;
                const endIndex = startIndex + this.perPage;
                return this.posts.slice(startIndex, endIndex);
            },
        },

        //ejecutar funciones auto
        async mounted() {
            this.loadPosts();
            this.deletePost();
        },

        //funciones
        methods: {

            loadPosts() {
                // console.log(this.currentPage)
                // Realiza una solicitud HTTP usando Axios
                this.$axios.get("/api/post").then((res) => {
                    // Almacena los datos en la variable posts
                    this.posts = res.data.data
                    // console.log(this.posts)
                    this.loading = false
                })
            },

            prevPage() {
                if (this.currentPage > 1) {
                    this.currentPage--;
                }
            },
            nextPage() {
                if (this.currentPage < this.totalPages) {
                    this.currentPage++;
                }
            },
            setPage(page) {
                this.currentPage = page;
            },

            confirmDelete(post){
                this.confirmacion = confirm('Desea eliminar?')
                if(this.confirmacion) this.deletePost(post)
                
            },

            deletePost(post){                
                this.$axios.delete("/api/post/"+post.id)
                this.loadPosts()
            },
        },
    };

</script>
