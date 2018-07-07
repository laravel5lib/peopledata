<template>
    <div>
        <div :class="this.status && (this.status==='signed' || this.status==='confirmed')?'grow_early':'star_wine'"
             class="card text-white mb-2 border-0"
             @click="toggleRegister">
            <div class="card-body">
                <div class="float-right"><span class="badge badge-light">{{ course.value }}</span><br>
                    <span class="badge badge-dark" v-if="students">{{ students }} estudiantes</span>
                </div>
                <h5 class="card-title">{{ course.name }}</h5>
                <p class="card-text">{{ course.dayName }} {{ course.hour }}, {{ course.location }}<br>
                    {{ course.professor.name }}
                </p>
            </div>
        </div>
        <spinner v-if="loading"></spinner>
    </div>
</template>

<script>
  import PNotify from '../../../../../node_modules/pnotify/dist/es/PNotify.js';

  PNotify.defaults.styling = "bootstrap4"; // Bootstrap version 4

  export default {
    props: ['ini_status', 'course', 'member'],
    data () {
      return {
        status: '',
        students:0,
        loading: 0,
      }
    },
    mounted () {
      this.status = this.ini_status
      this.students = this.course.members_count
    },
    methods: {
      toggleRegister () {
        if(!this.member) {
          PNotify.error('Debes ingresar tus datos para poder registrate a un curso');
          document.getElementById('email_phone').focus();
          return true;
        }
        this.loading++
        axios.post('/courses/' + this.course.id + '/toggle/' + this.member.id).then(
          ({data}) => {
            if (data.message) PNotify.success(data.message);
            if (data.toggle.attached.length) this.status = 'signed';
            if (data.toggle.detached.length) this.status = '';
            if(data.students >=0)this.students = data.students
            this.loading--
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
    }
  }
</script>

<style lang="scss" scoped>
    .card{
        cursor: pointer;
        &:hover{
            background-image: linear-gradient(15deg, #13547a 0%, #80d0c7 100%);
        }
    }
</style>
