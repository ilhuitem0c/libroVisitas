<template>
  <div>
   <div class="card" style="width: 18rem; display: inline-block!important; margin: 1em;" v-for="signature in signatures">
    <img class="card-img-top" :src="signature.avatar" :alt="signature.name">
    <div class="card-body">
      <p class="card-text">{{ signature.body }}</p>
      <small>Comentario por: <i class="fas fa-user" id="start"></i> {{ signature.name }}</small><br>
      <small><i class="fas fa-calendar-alt" id="visit"></i> {{ signature.date }}</small><br>
      <a href="#" class="btn btn-primary" id="comments" @click="report(signature.id)"><i class="far fa-flag" id="comment"></i> Reporta</a>
    </div>
</div>
   <paginate
      :page-count="pageCount"
      :click-handler="fetch"
      :prev-text="'Ant'"
      :next-text="'Sig'"
      :container-class="'pagination'"
      :page-class="'page-item'">
    </paginate>
  </div>
</template>

<script>
   export default{
       data(){
           return{
               signatures: [],
               pageCount: 1,
               endpoint: 'api/signatures?page='
           };
       },
       created(){
           this.fetch();
       },
       methods: {
           fetch(page = 1){
            axios.get(this.endpoint + page)
                    .then(({data}) => {
                        this.signatures = data.data;
                        this.pageCount = data.meta.last_page;
            });
           },

           report(id){
              if(confirm('Are you sure you want to report this signature?')) {
                    axios.put('api/signatures/'+id+'/report')
                    .then(response => this.removeSignature(id));
                }
           },

           removeSignature(id) {
                this.signatures = _.remove(this.signatures, function (signature) {
                    return signature.id !== id;
                });
            }
       }
   }  
</script>