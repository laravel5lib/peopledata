<template>
    <div class="row justify-content-center" v-if="member">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header text-white bg-info">Información Personal</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2 ">
                            <div class="align-items-center justify-content-center text-center user_avatar">
                                <img :src="member.image" :alt="member.name" class="rounded-circle img-fluid img-thumbnail" width="120">
                            </div>
                            <hr>
                            <div class="age">
                                {{ age }} <br>
                                <small>años</small>
                            </div>
                            <div>
                                <div class="form-group text-center">
                                    <div>
                                        <el-date-picker name="birthdate" align="center" format="yyyy-MM-dd" value-format="yyyy-MM-dd" id="birthdate" v-model="member.birthdate" type="date" placeholder="Escoja una fecha"></el-date-picker>
                                    </div>
                                    <small id="birthdateHelp" class="form-text text-muted">Fecha de nacimiento en formato AAAA-MM-DD</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="first_name">Nombres</label>
                                        {{ member.first_name }}
                                        <small id="first_nameHelp" class="form-text text-muted">Escriba su(s) nombre(s)</small>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="last_name">Apellidos</label>
                                        {{ member.last_name }}
                                        <small id="last_nameHelp" class="form-text text-muted">Escriba los apellidos completos</small>
                                    </div>
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
            <div class="card">
                <div class="card-header text-white bg-info">Educación Cristiana</div>
                <!--<div class="card-footer text-muted"><small>Esta es la lista de cursos disponibles,</small></div>-->
                <ul class="list-group list-group-flush">
                    <li class="list-group-item" v-for="course in courses" :class="{'list-group-item-info':course.data_type=='header'}">
                        <div class="row">
                            <div class="col-md">{{ course.name }}</div>
                            <div class="col-md" v-if="course.data_type=='select'">
                                <div v-if="!member.field_courses[course.id]">No</div>
                                <div v-else>{{ member.field_courses[course.id] }}</div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
  import moment from 'moment'

  export default {
    props: ['member','courses'],
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
