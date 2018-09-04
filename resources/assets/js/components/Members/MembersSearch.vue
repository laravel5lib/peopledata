<template>
    <div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="searchHelp">Buscar</span>
            </div>
            <input type="text" class="form-control" placeholder="Escriba aquí" aria-label="search" aria-describedby="searchHelp" v-model="search" @keyup.enter="searchMembers" @blur="searchMembers">
        </div>
        <small class="form-text text-muted">Puedes buscar por una parte del nombre, del email o incluso del número telefónico!</small>
        <ul class="list-group list-group-flush">
            <li class="list-group-item" v-for="member in results">
                <div class="row">
                    <div class="col-md-2">
                        <img :src="member.image" :alt="member.name" class="rounded-circle img-fluid img-thumbnail" width="100">
                    </div>
                    <div class="col-md-8">
                        {{ member.first_name }} {{ member.last_name }}<br>
                        Teléfono: {{ member.phone}}<br>
                        Email: {{ member.email }}
                    </div>
                    <div class="col-md-2">
                        <a :href="add_url+member.id" class="btn btn-primary">Agregar</a>
                    </div>
                </div>
            </li>
            <li class="list-group-item" v-if="searched">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 text-muted">
                        ¿No encuentras lo que buscas? Si estás segur@ que has buscado bien, puedes crear un nuevo registro en la base de datos.
                        <br>
                        <button type="button" class="btn btn-sm btn-info" v-if="!create" @click="create=true">Crear registro</button>
                        <div class="row" v-if="create">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name">Nombres</label>
                                    <input type="text" :class="{ 'is-invalid' : errors.first_name }" class="form-control" id="first_name" aria-describedby="first_nameHelp" placeholder="Nombre" v-model="user.first_name" @keyup="resetErrors('first_name')">
                                    <small v-if="errors.first_name" id="first_nameHelp" class="form-text invalid-feedback">{{ errors.first_name[0] }}</small>
                                    <small v-else id="first_nameHelp" class="form-text text-muted">Escriba lo(s) nombre(s)</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name">Apellidos</label>
                                    <input type="text" :class="{ 'is-invalid' : errors.last_name }" class="form-control" id="last_name" aria-describedby="last_nameHelp" placeholder="Apellidos" v-model="user.last_name" @keyup="resetErrors('last_name')">
                                    <small v-if="errors.last_name" id="last_nameHelp" class="form-text invalid-feedback">{{ errors.last_name[0] }}</small>
                                    <small v-else id="last_nameHelp" class="form-text text-muted">Escriba lo(s) apellido(s)</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" :class="{ 'is-invalid' : errors.email }" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email" v-model="user.email" @keyup="resetErrors('email')">
                                    <small v-if="errors.email" id="emailHelp" class="form-text invalid-feedback">{{ errors.email[0] }}</small>
                                    <small v-else id="emailHelp" class="form-text text-muted">Escriba la dirección de correo electrónico</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Teléfono</label>
                                    <input type="text" :class="{ 'is-invalid' : errors.phone }" class="form-control" id="phone" aria-describedby="phoneHelp" placeholder="Teléfono" v-model="user.phone" @keyup="resetErrors('phone')">
                                    <small v-if="errors.phone" id="phoneHelp" class="form-text invalid-feedback">{{ errors.phone[0] }}</small>
                                    <small v-else id="phoneHelp" class="form-text text-muted">Escriba el número celular o fijo</small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="button" class="btn btn-sm btn-success" @click="createMember">Crear registro</button>
                            </div>
                        </div>

                    </div>
                </div>

            </li>
        </ul>
        <spinner v-if="loading"></spinner>
    </div>
</template>

<script>
  export default {
    props: ['add_url'],
    data () {
      return {
        loading: 0,
        search: '',
        results: [],
        searched: false,
        user: {
          first_name: '',
          last_name: '',
          phone: '',
          email: '',
        },
        create: false,
        errors: {},
      }
    },
    methods: {
      resetErrors (field) {
        Vue.delete(this.errors, field);
      },
      searchMembers () {
        if (this.search) {
          this.loading++
          axios.post('/members/search', {search: this.search}).then(
            ({data}) => {
              if (data.members) this.results = data.members
              this.loading--
              this.searched = true
            }
          ).catch(function (error) {
            this.loading--
          }.bind(this))
        }
      },
      createMember () {
        this.loading++
        axios.post('/members', {
          first_name: this.user.first_name,
          last_name: this.user.last_name,
          email: this.user.email,
          phone: this.user.phone,
        }).then(
          ({data}) => {
            if (data.member) document.location.href = this.add_url + data.member.id
            this.loading--
          }
        ).catch(
          (error) => {
            this.loading--
            if (error.response) {
              if (error.response.status === 422) {
                var data = error.response.data;
                this.errors = data.errors;
              } else {
                console.log(error.response.status);
              }
            } else {
              console.log('Error', error.message);
            }
          }
        );
      },
    }
  }
</script>
