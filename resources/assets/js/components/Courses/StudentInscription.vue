<template>
    <div>
        <div class="row">
            <div class="col-md-1 text-center">
                <img :src="member.image" :alt="member.name" class="rounded-circle img-fluid img-thumbnail mb-1" width="100">
            </div>
            <div class="col-md-3">
                <a :href="'/members/'+member.id + '/edit'">{{ member.first_name }} {{ member.last_name }}</a><br>
                <small class="text-muted">{{ member.email }}</small>
                <br>
                <small class="text-muted">Tel: {{ member.phone }}</small>
            </div>
            <div class="col-md-2 text-center"><select @change="updateInscription" class="form-control" v-model="status">
                <option value="signed">Pre-inscrito</option>
                <option value="confirmed">Confirmado</option>
                <option value="in_progress">En curso</option>
                <option value="completed">Completado</option>
                <option value="didnt_start">No llegó</option>
                <option value="didnt_finish">Desertó</option>
            </select></div>
            <div class="col-md-2 text-center">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                    </div>
                    <input type="text" class="form-control" placeholder="0" v-model="payment" @keyup.enter="updateInscription" @blur="updateInscription">
                </div>
            </div>
            <div class="col-md-3 text-center">
                <input type="text" class="form-control" placeholder="Escriba aquí" v-model="notes" @keyup.enter="updateInscription" @blur="updateInscription">
            </div>
            <div class="col-md-1 text-center">
                <button type="button" class="btn btn-danger btn-sm" @click="removeStudent"><i class="fal fa-trash-alt"></i></button>
            </div>
        </div>
        <spinner v-if="loading"></spinner>
    </div>
</template>

<script>
  import PNotify from '../../../../../node_modules/pnotify/dist/es/PNotify.js';

  PNotify.defaults.styling = "bootstrap4"; // Bootstrap version 4

  export default {
    props: ['member', 'course_id'],
    data () {
      return {
        loading: 0,
        notes: '',
        payment: 0,
        status: 'signed',
      }
    },
    mounted () {
      if (this.member.pivot) {
        this.status = this.member.pivot.status
        this.payment = this.member.pivot.payment
        this.notes = this.member.pivot.notes
      }
    },
    methods: {
      updateInscription () {
        this.loading++
        axios.post('/courses/' + this.course_id + '/update-student/' + this.member.id,
          {
            status: this.status,
            payment: this.payment,
            notes: this.notes,
          }).then(
          ({data}) => {
            this.loading--
            this.$emit('change',{status: this.status,
              payment: this.payment,
              notes: this.notes,})
            if (data.message) PNotify.success(data.message);
          }
        ).catch(function (error) {
          this.loading--
          PNotify.error("Ha ocurrido un error");
        }.bind(this))
      },
      removeStudent (id) {
        this.loading++
        axios.post('/courses/' + this.course_id + '/remove-student/' + this.member.id).then(
          ({data}) => {
            document.location.reload();
          }
        ).catch(function (error) {
          this.loading--
        }.bind(this))
      }
    }
  }
</script>
