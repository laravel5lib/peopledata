<template>
    <div>
        <div class="card mb-2">
            <audio v-if="finished" autoplay :src="'/audios/'+status+'.mp3'"></audio>
            <div class="card-header bg-info text-white">
                <div class="float-right" style="font-size: 1.2rem;">
                    <span v-if="question.level==='medium'" class=" badge badge-warning">Nivel: Medio</span>
                    <span v-else-if="question.level==='hard'" class="badge badge-danger">Nivel: Difícil</span>
                    <span v-else-if="question.level==='easy'" class="badge badge-success">Nivel: Fácil</span>
                </div>
                <h2>{{ question.question }}</h2>
            </div>
            <ul class="list-group list-group-flush" style="font-size: 1.4rem;">
                <li :key="key" @click="selectOption(key)" :class="!finished && key===option?'active':(finished && key==='answer'?'text-white bg-success':(finished && key===option?'text-danger ':''))" class="list-group-item list-group-item-action" v-for="(op,key) in question.options">
                    {{ op }} 
                    <i v-if="key!='answer' && finished && key===option" class="fas fa-frown"></i>
                    <i v-if="key==='answer' && finished && key===option" class="fas fa-laugh-beam"></i>
                </li>
            </ul>
            <div class="card-body" v-if="(errors && errors.option) || message">
                <div class="alert alert-danger" role="alert" v-if="errors && errors.option">
                    <strong>Error:</strong> Debes escoger una opción de respuesta!
                </div>
                <div v-else-if="status==='success'" class="alert alert-success" role="alert">
                    <span v-html="message"></span>
                </div>
                <div v-else-if="status==='error'" class="alert alert-danger" role="alert">
                    <span v-html="message"></span>
                </div>
            </div>
            <div class="card-footer">
                <button v-if="!finished" @click="updateAnswer" class="btn btn-success">Enviar</button>
                <a v-else href="/games/trivia/start" class="btn btn-success">Siguiente pregunta</a>
            </div>
        </div>
        <spinner v-if="loading"></spinner>
    </div>
</template>

<script>
    export default {
        props: ['question'],
        data () {
            return {
                option: null,
                loading: 0,
                errors: {},
                finished: false,
                status:'',
                message:''
            }
        },
        methods: {
            resetErrors (field) { Vue.delete(this.errors, field);},
            selectOption (op) {
                if(!this.finished){
                    this.option = op
                    this.resetErrors('option')    
                }
            },
            updateAnswer () {
                this.loading++
                axios.post('/games/trivia/questions/' + this.question.id, {
                    option: this.option
                }).then(
                    ({data}) => {
                        if (data.status) {
                            this.status = data.status
                            this.message = data.message
                            this.finished = true
                        }
                        this.loading--
                    }
                ).catch(
                    (error) => {
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
                )

            }
        }
    }
</script>
