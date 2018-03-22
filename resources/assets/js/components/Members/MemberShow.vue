<template>
    <div class="container" v-if="member">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <img class="card-img-top" :src="member.attributes.avatar" :alt="member.attributes.name">
                    <div class="card-body" v-if="member">
                        <h5 class="card-title">{{ member.attributes.name }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    mounted () {
      delete window.axios.defaults.headers.common['X-CSRF-TOKEN'];
      axios({
        url: 'https://api.planningcenteronline.com/people/v2/people/'+this.id + '?include=emails,phone_numbers,marital_status',
        auth: {
          username: process.env.MIX_PEOPLE_APP_ID,
          password: process.env.MIX_PEOPLE_APP_SECRET
        }
      }).then(
        ({data}) => {
          console.log(data)
          if (data.data) this.member = data.data
        }
      ).catch(
        (error) => {
          console.log(error)
        }
      );
    },
    props:['id'],
    data () {
      return {
        member: null
      }
    }
  }
</script>
