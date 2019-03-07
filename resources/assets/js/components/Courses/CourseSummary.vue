<template>
    <div class="card mb-2 text-white cursor-pointer" :class="course.color" @click="gotoCourse(course.id)">
        <div class="card-body">
            <div class="float-right">
                <span class="badge badge-light">${{ course.value }}</span><br>
                <span class="badge badge-dark" v-if="students">{{ students }} estudiantes</span>
            </div>
            <h5 class="card-title">{{ course.name }}</h5>
            <small v-if="course.professor">{{ course.professor.first_name }} {{ course.professor.last_name }}</small>
            <small v-else>Sin profesor asignado</small>
            <p class="card-text">
                <span v-if="course.hour !== '12:00 am'">{{ course.hour }}, </span>
                {{ course.location }}
            </p>
        </div>
        <spinner v-if="loading"></spinner>
    </div>
</template>

<script>
  export default {
    props: ['course','students'],
    data () {
      return {
        loading: 0,
      }
    },
    methods:{
      gotoCourse(id){
        this.loading++;
        document.location.href='/courses/'+ id + '/students'
      }
    }
  }
</script>