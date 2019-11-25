<template>
    <div>
        <select class="form-control" @change="newInput" v-model="is_servicable">
          <option v-for="option in options" :value="option.id">{{option.full_name}}</option>
          <option value="">No user</option>
        </select>
    </div>
</template>


<script>
export default{
    props: ['current_value', 'url', 'column_title', 'options'],
    data() {
        return {
            set_value: '',
            is_servicable: '',
            title: 'user_id'
        }
    },
    mounted() {
         this.set_value = this.current_value
         this.is_servicable = this.current_value
         this.title = this.column_title
    },
    methods: {
    newInput(event) {
       this.is_servicable = event.target.value
       this.updateInput()
    },
    updateInput: function () {
        let data = new FormData();
        data.append(this.title, this.is_servicable);
        let config = {
          onUploadProgress: progressEvent => {
            //this.progress = Math.floor((progressEvent.loaded * 100) / progressEvent.total);
          }
        }
        data.append('_method', 'patch'); // add this
        axios.post(this.url, data, config) // change this to post )
        .then(res =>{
          this.set_value = this.is_servicable
        })
        .catch(error => {
            console.log(error)
            this.is_servicable = !this.set_value
        }); //
           //console.log(error);
        }
      }
    }
</script>
<style scoped>
.form-control {
  background:transparent;
}
</style>