<template>
    <div class="row justify-content-center" v-if="member">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header text-white bg-info">Información Personal</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2 ">
                            <div class="text-center">
                                <small class="text-muted">Haz click sobre la imagen para cambiar tu foto</small>
                            </div>
                            <div class="align-items-center justify-content-center text-center user_avatar">
                                <a v-touch="()=>{image_layer = true}" @mouseover="image_layer = true" @mouseout="image_layer = false">
                                    <img :src="member.image" :alt="member.name" class="rounded-circle img-fluid img-thumbnail" width="120">
                                    <form v-show="image_layer" :action="'/members/'+member.id + '/addimage'" class="dropzone image_layer" id="my-awesome-dropzone"></form>
                                </a>
                            </div>
                            <hr>
                            <div class="age">
                                {{ age }} <br>
                                <small>años</small>
                            </div>
                            <div>
                                <div class="form-group text-center">
                                    <!--<label for="birthdate">Fecha de nacimiento</label>-->
                                    <div>
                                        <el-date-picker name="birthdate" align="center" format="yyyy-MM-dd" value-format="yyyy-MM-dd" id="birthdate" v-model="member.birthdate" type="date" placeholder="Escoja una fecha"></el-date-picker>
                                    </div>
                                    <!--<input type="birthdate" :class="{ 'is-invalid' : errors.birthdate }" class="form-control" id="birthdate" aria-describedby="birthdateHelp" v-model="member.birthdate" @keyup="resetErrors('birthdate')">-->
                                    <small v-if="errors.birthdate" id="birthdateHelp" class="form-text invalid-feedback">{{ errors.birthdate[0] }}</small>
                                    <small v-else id="birthdateHelp" class="form-text text-muted">Fecha de nacimiento en formato AAAA-MM-DD</small>
                                </div>
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
                                <div class="row">
                                    <div class="col-md">
                                        <div class="form-group">
                                            <label for="profession">Profesión</label>
                                            <input type="text" :class="{ 'is-invalid' : errors.profession }" class="form-control" id="profession" aria-describedby="professionHelp" v-model="member.profession" @keyup="resetErrors('profession')">
                                            <small v-if="errors.profession" id="professionHelp" class="form-text invalid-feedback">{{ errors.profession[0] }}</small>
                                            <small v-else id="professionHelp" class="form-text text-muted">Profesión o principal área de trabajo</small>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group">
                                            <label for="working">Situación laboral actual</label>
                                            <select :class="{ 'is-invalid' : errors.working }" class="form-control" id="working" aria-describedby="workingHelp" v-model="member.working" @change="resetErrors('working')">
                                                <option value="">&nbsp;</option>
                                                <option value="Empleado/a">Empleado/a</option>
                                                <option value="Independiente">Independiente</option>
                                                <option value="Buscando trabajo">Buscando trabajo</option>
                                                <option value="Pensionado/a">Pensionado/a</option>
                                            </select>
                                            <small v-if="errors.working" id="workingHelp" class="form-text invalid-feedback">{{ errors.working[0] }}</small>
                                            <small v-else id="workingHelp" class="form-text text-muted">Selecciona una opción de la lista</small>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group">
                                            <label for="company">Empresa / Organización</label>
                                            <input type="text" :class="{ 'is-invalid' : errors.company }" class="form-control" id="company" aria-describedby="companyHelp" v-model="member.company" @keyup="resetErrors('company')">
                                            <small v-if="errors.company" id="companyHelp" class="form-text invalid-feedback">{{ errors.company[0] }}</small>
                                            <small v-else id="companyHelp" class="form-text text-muted">Donde trabajas o realizas tu actividad principal</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md text-right">
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                        <a href="/" class="btn btn-secondary">Regresar al Inicio</a>
                                    </div>
                                </div>
                                <!--<a href="/members" class="btn btn-danger">Cancelar</a>-->
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <small class="text-muted">
                        Al hacer uso del este formulario, y en conformidad con lo dispuesto en la Ley Estatuaria 1581 de 2012, el Decreto Reglamentario 1377 de 2013 y demás normas concordantes sobre protección de Datos Personales, Yo autorizo de manera previa, expresa e informativa a LA IGLESIA EL ENCUENTRO CON DIOS,
                        para recolectar, almacenar, administrar, procesar, transferir y utilizar toda la información que pueda relacionarse a mí, que le he proporcionado ahora o en el pasado,
                        los cuales serán destinados para las finalidades contempladas en el documento de políticas de privacidad publicado aquí:
                        <a target="_blank" href="/terms">Política de tratamiento de datos personales</a>.
                        <br>
                        Con esta aceptación, autorizo el tratamiento de mis datos para las finalidades arriba mencionadas y reconozco que los datos suministrados son ciertos y no ha sido omitida o alterada ninguna información, quedando informado que la falsedad u omisión de algún dato supondrá la imposibilidad de prestar correctamente el servicio.
                    </small>
                </div>
            </div>
            <div class="card" v-if="0">
                <div class="card-header text-white bg-info">Educación Cristiana</div>
                <!--<div class="card-footer text-muted"><small>Esta es la lista de cursos disponibles,</small></div>-->
                <ul class="list-group list-group-flush">
                    <li class="list-group-item" v-for="course in courses" :class="{'list-group-item-info':course.data_type=='header'}">
                        <div class="row">
                            <div class="col-md">{{ course.name }}</div>
                            <div class="col-md" v-if="course.data_type=='select'">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label @click="setCourse(course.id,'Si')" class="btn btn-outline-secondary" :class="{'active':member.field_courses[course.id] === 'Si'}">
                                        <input type="radio" name="options" value="Si" autocomplete="off"> Si
                                    </label>
                                    <label @click="setCourse(course.id,'No')" class="btn btn-outline-secondary" :class="{'active':member.field_courses[course.id] === 'No' || !member.field_courses[course.id]}">
                                        <input type="radio" name="options" autocomplete="off"> No
                                    </label>
                                    <label @click="setCourse(course.id,'En curso actualmente')" class="btn btn-outline-secondary" :class="{'active':member.field_courses[course.id] === 'En curso actualmente'}">
                                        <input type="radio" name="options" autocomplete="off"> En curso
                                    </label>
                                    <label @click="setCourse(course.id,'No terminado')" class="btn btn-outline-secondary" :class="{'active':member.field_courses[course.id] === 'No terminado'}">
                                        <input type="radio" name="options" autocomplete="off"> No terminé
                                    </label>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md text-right">
                            <button type="button" @click="updateMember" class="btn btn-primary">Actualizar</button>
                            <a href="/" class="btn btn-secondary">Regresar al Inicio</a>
                        </div>
                    </div>
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
    components: {},
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
            window.vm.$children[0].loading = 0
          });
          this.on("success", function (file, response) {
            if (response.data) window.vm.$children[0].member = response.data
            PNotify.success("Se ha cambiado la imagen correctamente!");
            window.vm.$children[0].image_layer = false
            window.vm.$children[0].loading = 0
          });
          this.on("error", function (file, errorMessage, xhr) {
            PNotify.error("No se ha podido actualizar la imagen!");
            console.log(errorMessage);
            console.log(xhr);
            window.vm.$children[0].image_layer = false
            window.vm.$children[0].loading = 0
          });
        }
      };
    },
    props: ['initial', 'marital_statuses', 'courses'],
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
        if (!this.member.birthdate) return '-?-';
        else if (moment(this.member.birthdate).format('YYYY') == '2018' || moment(this.member.birthdate).format('YYYY') == '2017') return '-?-';
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
          profession: this.member.profession,
          working: this.member.working,
          company: this.member.company,
          courses: this.member.field_courses
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
      },
      setCourse (course_id, value) {
        Vue.set(this.member.field_courses, course_id, value)
      }
    }
  }
</script>
