<template>
   <div class="panel panel-default">
      <div class="panel-heading">
         Tambah Kata
         <span class="pull-right">
            <router-link :to="{ name: 'glosarium.word' }" class="btn btn-default btn-sm">
               <i class="fa fa-list fa-fw"></i>
            </router-link>
         </span>
      </div>
      <div class="panel-body">
         <alert :show="alert.message" :type="alert.type">
            {{ alert.message }}
         </alert>

         <form @submit.prevent="update" action="/user/glosarium/word/update" method="post">

            <div class="row">
               <div :class="['form-group col-md-6', errors.category ? 'has-error' : '']">
                  <label class="control-label">Kategori</label>
                  <select v-model="state.category" class="form-control">
                     <option value="">Pilih Kategori</option>
                     <option v-for="category in categories" :value="category.id">
                        {{ category.name }}
                     </option>
                  </select>
                  <span v-if="errors.category" class="label label-danger">{{ errors.category[0] }}</span>
               </div>
            </div>

            <div class="row">
               <div :class="['form-group col-md-3', errors.lang ? 'has-error' : '']">
                  <label class="control-label">Bahasa Asal</label>
                  <input :disabled="loading" v-model="state.lang" type="text" class="form-control">
                  <span v-if="errors.lang" class="label label-danger">{{ errors.lang[0] }}</span>
               </div>
            </div>

            <div class="row">
               <div :class="['form-group col-md-8', errors.origin ? 'has-error' : '']">
                  <label class="control-label">Kata Asing</label>
                  <input :disabled="loading" v-model="state.origin" type="text" class="form-control">
                  <span v-if="errors.origin" class="label label-danger">{{ errors.origin[0] }}</span>
               </div>
            </div>

            <div class="row">
               <div :class="['form-group col-md-8', errors.locale ? 'has-error' : '']">
                  <label class="control-label">Kata Lokal</label>
                  <input :disabled="loading" v-model="state.locale" type="text" class="form-control">
                  <span v-if="errors.locale" class="label label-danger">{{ errors.locale[0] }}</span>
               </div>
            </div>

            <div class="row">
               <div class="col-md-12">
                  <button :disabled="loading" type="submit" class="btn btn-theme btn-t-primary">
                     Perbarui Kata
                     <loader :show="loading"></loader>
                  </button>
                  <router-link :to="{ name: 'glosarium.word' }" tag="button" class="btn btn-default btn-theme">
                     Kembali
                  </router-link>
               </div>
            </div>
         </form>
      </div>
   </div>
</template>

<script>
   export default {
      data() {
         return {
            alert: {},
            loading: false,
            errors: [],
            categories: [],
            state: {
               category: '',
               lang: 'en',
               origin: '',
               locale: ''
            }
         }
      },

      mounted() {
         const url = '/user/glosarium/word/' + this.$route.params.slug;
         axios.get(url).then(response => {
            console.log(response.data);
            this.state = response.data;

            // get category
            axios.get('/user/glosarium/category/all').then(response => {
               this.categories = response.data;
            });
         });
      },

      methods: {
         update(e) {
            this.loading = true;

            axios.put(e.target.action, this.state).then(response => {
               if (response.data.status == true) {
                  this.alert = {
                     type: 'success',
                     message: response.data.message
                  };

                  this.errors = [];
               }
               
               this.loading = false;
            }).catch(error => {
               if (! _.isEmpty(error)) {
                  if (error.response.status == 422) {
                     this.errors = error.response.data;
                  }
               }
               
               this.loading = false;
            });
         }
      }
   }
</script>