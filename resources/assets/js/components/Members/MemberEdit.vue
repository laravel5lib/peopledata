<template>
    <div class="row justify-content-center" v-if="member">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2 ">
                            <div class="align-items-center justify-content-center text-center user_avatar">
                                <a @mouseover="image_layer = true" @mouseout="image_layer = false">
                                    <img :src="member.image" :alt="member.name" class="rounded-circle img-fluid img-thumbnail" width="120">
                                    <form v-show="image_layer" :action="'/members/'+member.id + '/addimage'" class="dropzone image_layer" id="my-awesome-dropzone"></form>
                                </a>
                            </div>
                            <div class="age">
                                {{ age }} <br>
                                <small>años</small>
                            </div>

                        </div>
                        <div class="col-md-10">
                            <form @submit.prevent="updateMember">
                                <div class="row">
                                    <div class="col-md">
                                        <div class="form-group">
                                            <label for="first_name">Nombres</label>
                                            <input type="text" :class="{ 'is-invalid' : errors.first_name }" class="form-control" id="first_name" aria-describedby="first_nameHelp" placeholder="Nombre" v-model="member.first_name" @keyup="resetErrors('first_name')">
                                            <small v-if="errors.first_name" id="first_nameHelp" class="form-text invalid-feedback">{{ errors.first_name[0] }}</small>
                                            <small v-else id="first_nameHelp" class="form-text text-muted">Escriba su(s) nombre(s)</small>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group">
                                            <label for="last_name">Apellidos</label>
                                            <input type="text" :class="{ 'is-invalid' : errors.last_name }" class="form-control" id="last_name" aria-describedby="last_nameHelp" placeholder="Apellido" v-model="member.last_name" @keyup="resetErrors('last_name')">
                                            <small v-if="errors.last_name" id="last_nameHelp" class="form-text invalid-feedback">{{ errors.last_name[0] }}</small>
                                            <small v-else id="last_nameHelp" class="form-text text-muted">Escriba los apellidos completos</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <div class="form-group">
                                            <label for="birthdate">Fecha de nacimiento</label>
                                            <div>
                                                <el-date-picker name="birthdate" align="center" format="yyyy-MM-dd" value-format="yyyy-MM-dd" id="birthdate" v-model="member.birthdate" type="date" placeholder="Escoja una fecha"></el-date-picker>
                                            </div>
                                            <!--<input type="birthdate" :class="{ 'is-invalid' : errors.birthdate }" class="form-control" id="birthdate" aria-describedby="birthdateHelp" v-model="member.birthdate" @keyup="resetErrors('birthdate')">-->
                                            <small v-if="errors.birthdate" id="birthdateHelp" class="form-text invalid-feedback">{{ errors.birthdate[0] }}</small>
                                            <small v-else id="birthdateHelp" class="form-text text-muted">Fecha de nacimiento en formato AAAA-MM-DD</small>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group" v-if="!member.child">
                                            <label for="marital_status_id">Estado civil</label>
                                            <select :class="{ 'is-invalid' : errors.marital_status_id }" class="form-control" id="marital_status_id" aria-describedby="marital_status_idHelp" v-model="member.marital_status_id" @change="resetErrors('marital_status_id')">
                                                <option value="">&nbsp;</option>
                                                <option :value="status.id" v-for="status in marital_statuses">{{ status.value }}</option>
                                            </select>
                                            <small v-if="errors.marital_status_id" id="marital_status_idHelp" class="form-text invalid-feedback">{{ errors.marital_status_id[0] }}</small>
                                            <small v-else id="marital_status_idHelp" class="form-text text-muted">Seleccione su estado civil actual</small>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group">
                                            <label for="gender">Género</label>
                                            <select :class="{ 'is-invalid' : errors.gender }" class="form-control" id="gender" aria-describedby="genderHelp" v-model="member.gender" @change="resetErrors('gender')">
                                                <option value="">&nbsp;</option>
                                                <option value="M">Masculino</option>
                                                <option value="F">Femenino</option>
                                            </select>
                                            <small v-if="errors.gender" id="genderHelp" class="form-text invalid-feedback">{{ errors.gender[0] }}</small>
                                            <small v-else id="genderHelp" class="form-text text-muted">Seleccione su género de la lista</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <div class="form-group">
                                            <label for="email">Correo electrónico</label>
                                            <input type="email" :class="{ 'is-invalid' : errors.email }" class="form-control" id="email" aria-describedby="emailHelp" v-model="member.email" @keyup="resetErrors('email')">
                                            <small v-if="errors.email" id="emailHelp" class="form-text invalid-feedback">{{ errors.email[0] }}</small>
                                            <small v-else id="emailHelp" class="form-text text-muted">Escriba su dirección de correo electrónico personal</small>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group">
                                            <label for="phone">Teléfono</label>
                                            <input type="phone" :class="{ 'is-invalid' : errors.phone }" class="form-control" id="phone" aria-describedby="phoneHelp" v-model="member.phone" @keyup="resetErrors('phone')">
                                            <small v-if="errors.phone" id="phoneHelp" class="form-text invalid-feedback">{{ errors.phone[0] }}</small>
                                            <small v-else id="phoneHelp" class="form-text text-muted">Escriba su número celular o principal teléfono de contacto</small>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                                <!--<a href="/members" class="btn btn-danger">Cancelar</a>-->
                            </form>
                        </div>
                            <!--<small class="text-muted">Importante: Toda la información que requiera con respecto al Tratamiento de sus datos puede consultarse-->
                                <!--en la politica de tratamiento de datos de LA IGLESIA EL ENCUENTRO CON DIOS, el cual contiene nuestras políticas para el tratamiento de la información recogida, así como los procedimientos de consulta y reclamación que le permitirán hacer efectivos sus derechos al acceso, consulta, rectificación, actualización y supresión de los datos, visitando la página-->
                                <!--<a href="/terms">data.elencuentrocondios.com/terms</a>, escribiendo al correo electrónico comunicaciones@elencuentrocondios.com o comunicándose con nosotros al teléfono 034 2686025</small>-->
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <small class="text-muted">
                        Al hacer uso del este formulario, y en conformidad con lo dispuesto en la Ley Estatuaria 1581 de 2012, el Decreto Reglamentario 1377 de 2013 y demás normas concordantes sobre protección de Datos Personales, Yo autorizo de manera previa, expresa e informativa a LA IGLESIA EL ENCUENTRO CON DIOS,
                        para recolectar, almacenar, administrar, procesar, transferir y utilizar toda la información que pueda relacionarse a mí, que le he proporcionado ahora o en el pasado,
                        los cuales serán destinados para las finalidades contempladas en el documento de políticas de privacidad publicado aquí: <a target="_blank" href="/terms">Política de tratamiento de datos personales</a>.
                        <br>
                        Con esta aceptación, autorizo el tratamiento de mis datos para las finalidades arriba mencionadas y reconozco que los datos suministrados son ciertos y no ha sido omitida o alterada ninguna información, quedando informado que la falsedad u omisión de algún dato supondrá la imposibilidad de prestar correctamente el servicio.
                    </small>
                </div>
            </div>
        </div>
        <spinner v-if="loading"></spinner>
    </div>
</template>

<script>
  import PNotify from '../../../../../node_modules/pnotify/dist/es/PNotify.js';
  PNotify.defaults.styling = "bootstrap4"; // Bootstrap version 4
  import moment from 'moment'

  export default {
    components: {
    },
    mounted () {
      this.member = this.initial
      Dropzone.options.myAwesomeDropzone = {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 10, // MB
        dictDefaultMessage: 'Cambiar',
        createImageThumbnails: false,
        resizeWidth: 240,
        resizeHeight: 240,
        resizeMethod: 'crop',
        init: function () {
          this.on("addedfile", function (file) { window.vm.$children[0].loading++ });
          this.on("complete", function (file) {
            this.removeFile(file);
            window.vm.$children[0].loading--
          });
          this.on("success", function (file, response) {
            if (response.data) window.vm.$children[0].member = response.data
            PNotify.success("Se ha cambiado la imagen corectamente!");
          });
        }
      };
    },
    props: ['initial', 'marital_statuses'],
    data () {
      return {
        loading: 0,
        image_layer: false,
        member: null,
        errors: {},
      }
    },
    computed: {
      age: function () {
        return moment().diff(this.member.birthdate, 'years');
      }
    },
    methods: {
      resetErrors (field) {
        Vue.delete(this.errors, field);
      },
      updateMember () {
        this.loading++
        axios.put('/members/' + this.member.id, {
          first_name: this.member.first_name,
          last_name: this.member.last_name,
          marital_status_id: this.member.marital_status_id,
          gender: this.member.gender,
          birthdate: this.member.birthdate,
          email: this.member.email,
          phone: this.member.phone,
        }).then(
          ({data}) => {
            if (data.data) this.member = data.data
            this.loading--
            PNotify.success("Información actualizada!");
          }
        ).catch(
          (error) => {
            this.loading--
            PNotify.error("Ha ocurrido un error al guardar la información.");
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
      }
    }
  }
</script>
