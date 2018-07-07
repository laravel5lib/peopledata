<template>
    <div>
        <p class="card-text">Debes ingresar al sistema para ver tu información</p>
        <div class="form-row">
            <div class="col-9">
                <input type="text" :class="{ 'is-invalid' : errors.email_phone }" class="form-control" id="email_phone" aria-describedby="email_phoneHelp" placeholder="Escribir Email o teléfono" v-model="email_phone" @keyup="resetErrors('email_phone')">
                <small v-if="errors.email_phone" id="email_phoneHelp" class="form-text invalid-feedback">{{ errors.email_phone[0] }}</small>
                <small v-else id="email_phoneHelp" class="form-text text-muted">Escriba la dirección de correo electrónico o el número celular</small>
            </div>
            <div class="col-3">
                <a href="#" @click="simpleLogin" class="btn btn-primary">Ingresar</a>
            </div>
        </div>
        <div v-if="register">
            <hr class="my-4 border-bottom">
            <p class="card-text">O puedes activarte en el sistema ingresando tus datos básicos a continuación:</p>
            <div class="row">
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
                    <button type="button" class="btn btn-success" @click="createMember">Registrarte</button>
                </div>
            </div>
        </div>
        <spinner v-if="loading"></spinner>
    </div>
</template>

<script>
  export default {
    data () {
      return {
        loading: 0,
        email_phone: '',
        register: false,
        errors: {},
        user:{
          first_name:'',
          last_name:'',
          email:'',
          phone:'',
        }
      }
    },
    methods: {
      resetErrors (field) {
        if(field === 'email_phone') this.register = false;
        Vue.delete(this.errors, field);
      },
      simpleLogin () {
          this.loading++
            this.register = false;
          axios.post('/members/simple-login', {email_phone: this.email_phone}).then(
            ({data}) => {
              if (data.member) document.location.href = '/members/' + data.member.id + '/courses'
              // this.loading--
            }
          ).catch(
            (error) => {
              this.register = true
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
      createMember () {
        this.loading++
        axios.post('/members', {
          first_name: this.user.first_name,
          last_name: this.user.last_name,
          email: this.user.email,
          phone: this.user.phone,
        }).then(
          ({data}) => {
            if (data.member) document.location.href = '/members/' + data.member.id + '/courses'
            // this.loading--
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
