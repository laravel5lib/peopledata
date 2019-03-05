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
                            <a href="/members/" class="btn">Editar</a>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col">
                                    <h2>{{ member.first_name }} {{ member.last_name }}</h2>
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
    props: ['member', 'courses', 'marital_statuses'],
    computed: {
      age: function () {
        if (!this.member.birthdate) return '-?-';
        else if (moment(this.member.birthdate).format('YYYY') == '2018' || moment(this.member.birthdate).format('YYYY') == '2017') return '-?-';
        return moment().diff(this.member.birthdate, 'years');
      }
    },
  }
</script>
