<template>
    <div>
        <div class="row">
            <div class="col-md-1 text-center">
                <img :src="member.image" :alt="member.name" class="rounded-circle img-fluid img-thumbnail mb-1" width="100">
            </div>
            <div class="col-md-3">
                <a :href="'/members/'+member.id">{{ member.first_name }} {{ member.last_name }}</a><br>
                <small class="text-muted">{{ member.email }}</small>
                <br>
                <small class="text-muted">Tel: {{ member.phone }}</small>
            </div>
            <div class="col-md-3 text-center">
                {{ course.name }}<br>
                <small class="text-muted">{{ course.dayName }} {{ course.hour }}</small>
                <br>
                <small class="text-muted" v-if="course.professor">{{ course.professor.name }}</small>
                <small class="text-muted" v-else>Sin profesor definido</small>
                <br>
                <select @change="updateInscription" class="form-control" v-model="status" disabled>
                <option value="signed">Pre-inscrito</option>
                <option value="confirmed">Confirmado</option>
                <option value="in_progress">En curso</option>
                <option value="completed">Completado</option>
                <option value="didnt_start">No llegó</option>
                <option value="didnt_finish">Desertó</option>
            </select>
            </div>
            <div class="col-md-2 text-center">
                <div v-if="course2">{{ course2.name }}<br>
                    <small class="text-muted">{{ course2.dayName }} {{ course2.hour }}</small>
                </div>
                <div v-else><small class="text-muted">No se ha inscrito en ningun curso</small></div>
            </div>
            <div class="col-md-3 text-center">
                Recomendar el siguiente curso: <br>
                <select class="form-control mb-1" v-model="recommend">
                    <option value="">Escoja un curso</option>
                    <option v-for="option in courses" :value="option">{{ option }}</option>
                </select>
                <button :disabled="!recommend" type="button" class="btn btn-info btn-sm" @click="sendRecommendation()"><i class="fas fa-envelope"></i> Enviar Email</button>
            </div>
        </div>
        <spinner v-if="loading"></spinner>
    </div>
</template>

<script>
  import PNotify from '../../../../../node_modules/pnotify/dist/es/PNotify.js';
  PNotify.defaults.styling = "bootstrap4"; // Bootstrap version 4
  export default {
    props: ['member', 'course','course2','courses'],
    data () {
      return {
        loading: 0,
        notes: '',
        payment: 0,
        status: 'signed',
        recommend:''
      }
    },
    mounted () {
      if (this.course.pivot) {
        this.status = this.course.pivot.status
      }
    },
    methods: {
      updateInscription () {
        this.loading++
        axios.post('/courses/' + this.course.id + '/update-student/' + this.member.id,
          {
            status: this.status,
            payment: this.course.pivot.payment,
            notes: this.course.pivot.notes,
          }).then(
          ({data}) => {
            this.loading--
            if (data.message) PNotify.success(data.message);
          }
        ).catch(function (error) {
          this.loading--
          PNotify.error("Ha ocurrido un error");
        }.bind(this))
      },
      sendRecommendation () {
        this.loading++
        axios.post('/members/'+this.member.id+'/recommend', {course:this.recommend}).then(
          ({data})=>{
            this.loading--
            if (data.message) PNotify.success(data.message);
          }
        ).catch(function (error) {
          this.loading--
          PNotify.error("Ha ocurrido un error");
        }.bind(this))
      }
    }
  }
</script>
