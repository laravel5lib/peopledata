<template>
    <div class="row justify-content-center" v-if="member">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header text-white bg-info">Información Personal</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="align-items-center justify-content-center text-center user_avatar">
                                <img :src="member.image" :alt="member.name" class="rounded-circle img-fluid img-thumbnail" width="120">
                            </div>
                            <hr>
                            <div class="text-center" v-if="member.birthdate">
                                <small class="text-muted">Fecha de nacimiento</small>
                                <br>
                                {{ member.birthdate }}<br>
                                <span class="age">{{ age }}</span><br>
                                <small>años</small>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md">
                                    <h2>{{ member.first_name }} {{ member.last_name }}</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group" v-if="!member.child">
                                        <label for="marital_status_id">Estado civil</label>
                                        {{ member.marital_status_id }}
                                        <small id="marital_status_idHelp" class="form-text text-muted">Seleccione su estado civil actual</small>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="gender">Género</label>
                                        {{ member.gender }}
                                        <small id="genderHelp" class="form-text text-muted">Seleccione su género de la lista</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="email">Correo electrónico</label>
                                        {{ member.email}}
                                        <small id="emailHelp" class="form-text text-muted">Escriba su dirección de correo electrónico personal</small>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="phone">Teléfono</label>
                                        {{ member.phone }}
                                        <small id="phoneHelp" class="form-text text-muted">Escriba su número celular o principal teléfono de contacto</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="profession">Profesión</label>
                                        {{ member.profession }}
                                        <small id="professionHelp" class="form-text text-muted">Profesión o principal área de trabajo</small>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="working">Situación laboral actual</label>
                                        {{ member.working }}
                                        <small id="workingHelp" class="form-text text-muted">Selecciona una opción de la lista</small>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="company">Empresa / Organización</label>
                                        {{ member.company }}
                                        <small id="companyHelp" class="form-text text-muted">Donde trabajas o realizas tu actividad principal</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header text-white bg-info">Educación Cristiana</div>
                <div class="card-footer text-muted">
                    <span v-for="course in courses" v-if="course.data_type==='select' && member.field_courses[course.id] && member.field_courses[course.id] !== 'No'"> 
                            {{ course.name }},
                    </span>
                </div>
                <!--<ul class="list-group list-group-flush">-->
                <!--<li class="list-group-item" v-for="course in courses" :class="{'list-group-item-info':course.data_type=='header'}">-->
                <!--<div class="row">-->
                <!--<div class="col-md">{{ course.name }}</div>-->
                <!--<div class="col-md" v-if="course.data_type=='select'">-->
                <!--<div v-if="!member.field_courses[course.id]">No</div>-->
                <!--<div v-else>{{ member.field_courses[course.id] }}</div>-->
                <!--</div>-->
                <!--</div>-->
                <!--</li>-->
                <!--</ul>-->
            </div>
        </div>
    </div>
</template>

<script>
  import moment from 'moment'

  export default {
    props: ['member', 'courses'],
    mounted () {
    },
    data () {
      return {}
    },
    computed: {
      age: function () {
        if (!this.member.birthdate) return '-?-';
        else if (moment(this.member.birthdate).format('YYYY') == '2018' || moment(this.member.birthdate).format('YYYY') == '2017') return '-?-';
        return moment().diff(this.member.birthdate, 'years');
      }
    },
  }
</script>
