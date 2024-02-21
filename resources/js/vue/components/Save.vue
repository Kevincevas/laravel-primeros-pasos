<template>
    <div class="container">
        <!-- <h2 class="text-center mt-5 text-uppercase">{{ !post.title ? 'Nuevo Post' : 'Editar Post '+post.title }}</h2> -->

        <h2 v-if="!post" class="text-uppercase text-center mt-5">Crear Post</h2>
        <h2 v-else class="text-uppercase text-center mt-5">Actualizar Post + {{ post.title }}</h2>

        <div class="text-center col-md-6 mx-auto bg-danger text-white ">{{ errorsForms.title||errorsForms.content||errorsForms.description||errorsForms.category_id||errorsForms.posted ? errorsForms : "" }}</div>

        <form @submit.prevent="submit">
            <div class="row">
                
                <div class="col-md-12">
                    <label for="">Titulo</label>
                    <input v-model="form.title" class="form-control" type="text" name="title" >
                </div>

                <div class="col-md-6">
                    <label for="">Categoria</label>
                    <select v-model="form.category_id" class="form-control" name="category_id">
                        <option v-for="c in categories" v-bind:key="c.id" :value="c.id">{{ c.title }}</option>                
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="">Posteado</label>
                    <select v-model="form.posted" class="form-control" name="posted" id="">
                        <option value="not">No</option>
                        <option value="yes">Si</option>
                    </select>
                </div>

                <div class="col-md-12">
                    <label for="">Contenido</label>
                    <textarea v-model="form.content" class="form-control" name="content"></textarea>
                </div>

                <div class="col-md-12">
                    <label for="">Descripcion</label>
                    <textarea v-model="form.description" class="form-control" name="description"></textarea>
                </div>

                <br>
                
                <!-- <div>
                    <label for="">Imagen</label>
                    <input type="file" name="image">
                </div> -->
                
                <div class="col-md-12 text-center">
                    <a class="btn btn-warning my-3" href="" @click="$router.push({name: 'list'})">Cancelar</a> &
                    <button class="btn btn-success my-3" type="submit">Enviar</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>


    export default {
        data() {
            return {
                categories: [],
                form: {
                    title: "",
                    description: "",
                    content: "",
                    category_id: "",
                    posted: "",
                },
                errorsForms: {
                    title: "",
                    description: "",
                    content: "",
                    category_id: "",
                    posted: "",
                }, 
                post: ""
                
            }
        },

        async mounted() {
            if (this.$route.params.slug) {
                await this.getPost();
                console.log(this.post)
                this.initPost();
            }
            this.getCategory();
        },
        methods: {
            clearErrorsForm() {
                this.errorsForms.title = ""
                this.errorsForms.description = ""
                this.errorsForms.content = ""
                this.errorsForms.category_id = ""
                this.errorsForms.posted = ""
            },

            submit(){
                
                this.clearErrorsForm()

                if (this.post == "") {
                    //crear post
                    return this.$axios.post('/api/post',this.form).then(res => {
                        console.log(res)
                    }).catch(error => {
                        console.log(error.response.data)
                        if (error.response.data.title) {
                            this.errorsForms.title = error.response.data.title
                        }
                        if (error.response.data.description) {
                            this.errorsForms.description = error.response.data.description
                        }
                        if (error.response.data.content) {
                            this.errorsForms.content = error.response.data.content
                        }
                        if (error.response.data.category_id) {
                            this.errorsForms.category_id = error.response.data.category_id
                        }
                        if (error.response.data.posted) {
                            this.errorsForms.posted = error.response.data.posted
                        }
    
                            setTimeout(() => {
                                this.clearErrorsForm()
                            }, 4000);
                        
                    })
                }

                //actualizar post
                return this.$axios.patch('/api/post/'+this.post.id,this.form).then(res => {
                    console.log(res)
                }).catch(error => {
                    console.log(error.response.data)
                    if (error.response.data.title) {
                        this.errorsForms.title = error.response.data.title
                    }
                    if (error.response.data.description) {
                        this.errorsForms.description = error.response.data.description
                    }
                    if (error.response.data.content) {
                        this.errorsForms.content = error.response.data.content
                    }
                    if (error.response.data.category_id) {
                        this.errorsForms.category_id = error.response.data.category_id
                    }
                    if (error.response.data.posted) {
                        this.errorsForms.posted = error.response.data.posted
                    }

                        setTimeout(() => {
                            this.clearErrorsForm()
                        }, 4000);
                    
                })
                    
                

            },

            getCategory(){
                this.$axios.get("/api/category/all").then(res => {
                    this.categories = res.data
                })
            },
            async getPost(){
                this.post = await this.$axios.get("/api/post/slug/"+this.$route.params.slug)
                this.post = this.post.data
            },
            initPost(){
                this.form.title = this.post.title,
                this.form.description = this.post.description,
                this.form.content = this.post.content,
                this.form.category_id = this.post.category_id,
                this.form.posted = this.post.posted
            }
            
        }
    }
</script>