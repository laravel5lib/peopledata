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
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col">
                                    <h2>{{ member.first_name }} {{ member.last_name }}</h2>
                                </div>
                                <div class="col text-right">
                                    <a :href="'/members/'+ member.id + '/edit'" class="btn btn-primary">Editar</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div v-if="member.email" class="text-info">{{ member.email }}</div>
                                    <div v-if="member.phone"><span class="text-muted">Teléfono:</span> {{ member.phone }}</div>
                                    <div v-if="member.marital_status_id">
                                        <span class="text-muted">Estado civil:</span> <span v-for="marital in marital_statuses" v-if="member.marital_status_id == marital.id">{{ marital.value }}</span>
                                    </div>
                                    <div v-if="member.gender">
                                        <span v-if="member.gender==='M'">Masculino</span>
                                        <span v-else-if="member.gender==='F'">Femenino</span>
                                        <span v-else>&nbsp;</span>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div v-if="member.profession"><span class="text-muted">Profesión:</span> {{ member.profession }}</div>
                                    <div v-if="member.working"><span class="text-muted">Situación laboral</span> {{ member.working }}</div>
                                    <div v-if="member.company"><span class="text-muted">Empresa:</span> {{ member.company }}</div>
                                </div>
                                <div class="col-md text-center" v-if="member.birthdate">
                                    {{ member.birthdate }}<br>
                                    <span class="age">{{ age }}</span><br>
                                    <small>años</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" v-if="finishedCourses.length">
                <div class="card-header text-white bg-info">Cursos completados y en curso</div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item list-group-item-success">Nivel 1</li>
                    <li class="list-group-item" v-for="course in finishedCourses" v-if="course.category ==='Nivel 1' && course.pivot.status !== 'didnt_start' && course.pivot.status !== 'didnt_finish'">
                        <div class="row">
                            <div class="col-sm-2 text-center">
                                <span class="badge badge-info">{{ course.period }}</span><br>
                                <span v-if="course.ministry_id !== 1" class="badge badge-secondary">{{ course.ministry.name }}</span>
                            </div>
                            <div class="col-sm">
                                {{ course.name }}<br>
                                <span class="text-muted small" v-if="course.professor">{{ course.professor.name }}</span>
                                <span class="text-muted small" v-else>Sin profesor</span>
                            </div>
                            <div class="col-sm text-right"><a :href="'/courses/'+course.id + '/students'" class="btn btn-secondary">Ver estudiantes</a></div>
                        </div>
                    </li>
                    <li class="list-group-item list-group-item-success">Nivel 2</li>
                    <li class="list-group-item" v-for="course in finishedCourses" v-if="course.category ==='Nivel 2' && course.pivot.status !== 'didnt_start' && course.pivot.status !== 'didnt_finish'">
                        <div class="row">
                            <div class="col-sm-2 text-center">
                                <span class="badge badge-info">{{ course.period }}</span><br>
                                <span v-if="course.ministry_id !== 1" class="badge badge-secondary">{{ course.ministry.name }}</span>
                            </div>
                            <div class="col-sm">
                                {{ course.name }}<br>
                                <span class="text-muted small" v-if="course.professor">{{ course.professor.name }}</span>
                                <span class="text-muted small" v-else>Sin profesor</span>
                            </div>
                            <div class="col-sm text-right"><a :href="'/courses/'+course.id + '/students'" class="btn btn-secondary">Ver estudiantes</a></div>
                        </div>
                    </li>
                    <li class="list-group-item list-group-item-success">Nivel 3</li>
                    <li class="list-group-item" v-for="course in finishedCourses" v-if="course.category ==='Nivel 3' && course.pivot.status !== 'didnt_start' && course.pivot.status !== 'didnt_finish'">
                        <div class="row">
                            <div class="col-sm-2 text-center">
                                <span class="badge badge-info">{{ course.period }}</span><br>
                                <span v-if="course.ministry_id !== 1" class="badge badge-secondary">{{ course.ministry.name }}</span>
                            </div>
                            <div class="col-sm">
                                {{ course.name }}<br>
                                <span class="text-muted small" v-if="course.professor">{{ course.professor.name }}</span>
                                <span class="text-muted small" v-else>Sin profesor</span>
                            </div>
                            <div class="col-sm text-right"><a :href="'/courses/'+course.id + '/students'" class="btn btn-secondary">Ver estudiantes</a></div>
                        </div>
                    </li>
                    <li class="list-group-item list-group-item-info">Otros</li>
                    <li class="list-group-item" v-for="course in finishedCourses" v-if="course.category ==='Otros' && course.pivot.status !== 'didnt_start' && course.pivot.status !== 'didnt_finish'">
                        <div class="row">
                            <div class="col-sm-2 text-center">
                                <span class="badge badge-info">{{ course.period }}</span><br>
                                <span v-if="course.ministry_id !== 1" class="badge badge-secondary">{{ course.ministry.name }}</span>
                            </div>
                            <div class="col-sm">
                                {{ course.name }}<br>
                                <span class="text-muted small" v-if="course.professor">{{ course.professor.name }}</span>
                                <span class="text-muted small" v-else>Sin profesor</span>
                            </div>
                            <div class="col-sm text-right"><a :href="'/courses/'+course.id + '/students'" class="btn btn-secondary">Ver estudiantes</a></div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="card" v-if="unfinishedCourses.length">
                <div class="card-header text-white bg-info">Cursos no empezados o desertados</div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item" v-for="course in unfinishedCourses" v-if="course.pivot.status === 'didnt_start' || course.pivot.status === 'didnt_finish'">
                        <div class="row">
                            <div class="col-sm-2 text-center"><span class="badge badge-danger">{{ course.period }}</span></div>
                            <div class="col-sm">
                                {{ course.name }}<br>
                                <span class="text-muted small" v-if="course.professor">{{ course.professor.name }}</span>
                                <span class="text-muted small" v-else>Sin profesor</span>
                            </div>
                            <div class="col-sm text-right"><a :href="'/courses/'+course.id + '/students'" class="btn btn-secondary">Ver estudiantes</a></div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="card" v-if="professor_courses.length">
                <div class="card-header text-white bg-info">Ha sido profesor de los siguientes cursos</div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item" v-for="course in professor_courses">
                        <div class="row">
                            <div class="col-sm-2 text-center"><span class="badge badge-info">{{ course.period }}</span></div>
                            <div class="col-sm">
                                {{ course.name }}<br>
                                <span class="text-muted small" v-if="course.professor">{{ course.professor.name }}</span>
                            </div>
                            <div class="col-sm text-right"><a :href="'/courses/'+course.id + '/students'" class="btn btn-secondary">Ver estudiantes</a></div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="card" v-if="member.field_courses.length">
                <div class="card-header text-white bg-info">Otros cursos</div>
                <div class="card-footer text-muted">
                    <span v-for="course in old_courses" v-if="course.data_type==='select' && member.field_courses[course.id] && member.field_courses[course.id] !== 'No'"> 
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
        <spinner v-if="loading"></spinner>
    </div>
</template>

<script>
  import moment from 'moment'

  export default {
    props: ['member', 'old_courses', 'marital_statuses'],
    mounted(){
      this.loading++
      axios.get('/member-courses/'+this.member.id).then(
        ({data})=>{
          if(data.courses)this.courses = data.courses
          if(data.professor_courses)this.professor_courses = data.professor_courses
          this.loading--
        }
      ).catch(()=>{
        this.loading--
      })
    },
    data(){
      return {
        courses:[],
        professor_courses:[],
        loading: 0
      }
    },
    computed: {
      age () {
        if (!this.member.birthdate) return '-?-';
        else if (moment(this.member.birthdate).format('YYYY') == '2018' || moment(this.member.birthdate).format('YYYY') == '2017') return '-?-';
        return moment().diff(this.member.birthdate, 'years');
      },
      finishedCourses(){
        return this.courses.filter(function(item){
          return item.pivot.status !== 'didnt_start' && item.pivot.status !== 'didnt_finish'
        })
      },
      unfinishedCourses(){
        return this.courses.filter(function(item){
          return item.pivot.status === 'didnt_start' || item.pivot.status === 'didnt_finish'
        })
      }
    },
  }
</script>
