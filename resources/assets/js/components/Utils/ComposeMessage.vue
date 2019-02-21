<template>
    <div>
        <button type="button" class="btn btn-block btn-primary mb-2" data-toggle="modal" data-target="#composeMessageModal">
            <i class="fal fa-envelope"></i> {{ this.label }}
        </button>
        <div class="modal fade" id="composeMessageModal" tabindex="-1" role="dialog" aria-labelledby="composeMessageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Redactar un nuevo mensaje</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="subject">Asunto</label>
                            <input type="text" v-model="subject" id="subject" name="subject" placeholder="Escribe un asunto" :class="{ 'is-invalid' : errors.subject }" class="form-control" @keyup="resetErrors('subject')">
                            <small v-if="errors.subject" id="subjectHelp" class="form-text invalid-feedback">{{ errors.subject[0] }}</small>
                        </div>
                        <div class="form-group">
                            <label for="message">Mensaje</label>
                            <textarea v-model="message" id="message" name="message" placeholder="Escriba aqui su mensaje" :class="{ 'is-invalid' : errors.message }" class="form-control" rows="5" @keyup="resetErrors('message')"></textarea>
                            <small v-if="errors.message" id="messageHelp" class="form-text invalid-feedback">{{ errors.message[0] }}</small>
                        </div>
                        <spinner v-if="loading"></spinner>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" @click="sendMessage">Enviar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  import PNotify from '../../../../../node_modules/pnotify/dist/es/PNotify.js';
  PNotify.defaults.styling = "bootstrap4"; 
  
  export default {
    props: {
      emails: {
        type: Array,
        default: []
      },
      label: {
        type: String,
        default: 'Escribir Mensaje'
      },
    },
    data () {
      return {
        subject: '',
        message: '',
        loading: 0,
        errors:{}
      }
    },
    mounted () {
      window.$('#composeMessageModal').on('shown.bs.modal', function () {
        window.$('#subject').trigger('focus')
      })
    },
    methods: {
      resetErrors (field) {
        Vue.delete(this.errors, field);
      },
      sendMessage () {
        this.loading++
        axios.post('/messages', {
          subject: this.subject,
          message: this.message,
          emails: this.emails 
        }).then(
          ({data})=>{
            this.loading--
            this.subject = ''
            this.message = ''
            window.$('#composeMessageModal').modal('hide')
            if(data.message)PNotify.success(data.message)
          }
        ).catch(
          ({response})=>{
            PNotify.error("No se ha podido enviar el mensaje, corrige los errores e intenta nuevamente");
            if(response.data.errors)this.errors = response.data.errors
            this.loading--
          }
        )
      }
    },
  }
</script>

