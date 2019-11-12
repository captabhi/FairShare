<template>
    <div class="container" id="newApp">
        <section class="hero is-medium is-primary is-bold">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title has-text-centered" >
                        Create a new Split
                    </h1>
                    <div class="columns  is-centered ">
                        <div class="column is-half-desktop">
                            <div class="box ">
                                <form action="/add/split/" @submit.stop.prevent="submit" >
                                    <input type="hidden" name="_token" :value="formData.csrf" >

                                    <div class="field">
                                        <label  class="label">Split Name</label>
                                        <div class="control">
                                            <input class="input" name="split_name" v-model="formData.split_name" v-on:keydown="clear('data.split_name')">
                                        </div>
                                        <formerror v-if="validationErrors['data.split_name']" :errorName="validationErrors['data.split_name'][0]"></formerror>
                                    </div>
                                    <hr>
                                    <div class="field">
                                        <label  class="label">Your Name</label>
                                        <div class="control">
                                            <input class="input" name="creator_name" v-model="formData.creator_name" v-on:keydown="clear('data.creator_name')">
                                        </div>
                                        <formerror v-if="validationErrors['data.creator_name']" :errorName="validationErrors['data.creator_name'][0]"></formerror>
                                    </div>
                                    <div class="field">
                                        <label class="label">Email</label>
                                        <div class="control has-icons-left has-icons-right">
                                            <input class="input" name="creator_email" type="email" placeholder="Email input" v-model="formData.creator_email" v-on:keydown="clear('data.creator_email')">
                                            <span class="icon is-small is-left">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                            <span class="icon is-small is-right">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </span>
                                        </div>
                                        <formerror v-if="validationErrors['data.creator_email']" :errorName="validationErrors['data.creator_email'][0]"></formerror>
                                    </div>
                                    <div class="field" v-for="(mate,index) in formData.shareMates">
                                        <label class="label">Person {{index+1}}</label>
                                        <div class="field has-addons" >
                                            <div class="control is-expanded">
                                                <input type="text" name="input" class="input" @input="addNameOfMate($event, index)"  :key="index" >
                                            </div>
                                            <div class="control">
                                            <span @click="reduceShareMateCount">
                                                <i class="button fas fa-times"></i>
                                            </span>
                                            </div>
                                        </div>
                                        <formerror v-if="validationErrors['data.shareMates.'+index]" :errorName="validationErrors['data.shareMates.'+index]">Please enter the person's name. </formerror>
                                    </div>

                                    <button class="button" type="button" @click="addNewShareMate">
                                        <i class="fas fa-plus"></i>
                                        Add Person
                                    </button>
                                    <formerror v-if="validationErrors['data.shareMates']" :errorName="validationErrors['data.shareMates'][0]">At least 1 extra person is required</formerror>
                                    <hr>
                                    <button class="button is-primary" type="submit" @click.stop.prevent="submit()">Create Split</button>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>
    </div>

</template>

<script>
    export default {
        name: "newsplit.vue",
        data:function () {
            return {
                emailInvalid:false,
                formData:{
                    csrf:document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    split_name:"",
                    creator_name:"",
                    creator_email:"",
                    shareMates: [""],
                },
                validationErrors:'',
                noOfShareMates:0,
                shareMateTemp:"",

            }
        },
        methods: {
            addNewShareMate(){

                this.formData.shareMates.push('');
            },
            reduceShareMateCount(){
                console.log("Calling");
                this.formData.shareMates.pop();
            },
            submit(){
                let self =this;
                self.formData.shareMates.push(self.formData.creator_name);
                console.log(self.formData.shareMates);
              axios.post('/add/split/',{
                    data:this.formData
              }).then(function(response){
                    window.location.href = 'view/splits/' +
                        response.data.split_name +
                        '/' + response.data.localHash;
              })
              .catch(function(error){
                    //self.emailInvalid = true;
                  console.log("HElp");
                    self.validationErrors =error.response.data.errors;
                    console.log(self.validationErrors);
              })
            },
            checkForm(){

            },
            clear(value){

                    delete this.$data.validationErrors[value];
            },

            addNameOfMate(e, index) {

                this.formData.shareMates[parseInt(index)] = e.target.value;
            }
        },
    }
</script>

<style scoped>

</style>
