<template>
    <div>
    <div class="container">

        <h2>Selecionar imagenes</h2>
        <div class="form-group">
            <input type="file" id="imagendata" accept="image/png, image/jpeg"  @change="capturarImagen"> 
        </div>
        <div class="col-md-3" v-if="image">
             <img :src="image" class="img-responsive" height="120" width="250">
        </div>
        <div class="form-group">
            <button class="btn btn-primary" @click="guardarImagen">Guardar</button>
        </div>
    </div>
    <br><br>
    <div class="container">
        <div>
            <div v-for="imagen in arrayImagenes" :key="imagen.id" >
               <div class="ft">
                       <img v-bind:src="'images/' + imagen.nombre " alt="heyy">
                </div>
             </div>
             
        </div>
       
    </div>
    </div>
    


</template>

<script>
    export default {
        data(){
            return{
                image:'',
                arrayImagenes : []
            }
        },
        methods : {
            capturarImagen(e){
                 let file = e.target.files[0];
                console.log(file);
                let reader = new FileReader();

                reader.onloadend = (e) => {
                    this.image = reader.result;
                }
                
                reader.readAsDataURL(file);  
            },
            guardarImagen(){
                let me= this;
                axios.post('/subir', {
                    'nombre':this.image
                }).then(function(response) {
                    me.image = '';
                    document.getElementById('imagendata').value = null;
                    console.log('imagen subida');
                    me.mostrarImagenes();
                })
            },
            mostrarImagenes(){

                let me = this;

                axios.get('/mostrar').then(function(response) {
                    var respuesta = response.data;
                    me.arrayImagenes = respuesta.imagenes;
                   
                }).catch(function(error) {
                    console.log('error al mostrar imagenes')
                })
            },
            
        },
        mounted(){
            this.mostrarImagenes();
        }
    }
</script>


<style>

    .ft img{
        border-radius: 120px;
        width: 250px;
        height: 250px;
    }

</style>
