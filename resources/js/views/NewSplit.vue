<template>
    <div class="container" id="newApp">
        <section class="hero is-medium is-light is-bold">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title has-text-centered" >
                        Create a new Split
                    </h1>
                    <div class="columns  is-centered ">
                        <div class="column is-half-desktop">
                            <div class="box ">
                                <form action="/add/split/" method="post">
                                    <input type="hidden" name="_token" :value="csrfToken" >
                                    <div class="field">
                                        <label  class="label">Split Name</label>
                                        <div class="control">
                                            <input class="input" name="split_name" v-model="split_name">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="field">
                                        <label  class="label">Your Name</label>
                                        <div class="control">
                                            <input class="input" name="creator_name" v-model="creator_name">
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Email</label>
                                        <div class="control has-icons-left has-icons-right">
                                            <input class="input" name="creator_email" type="email" placeholder="Email input" v-model="creator_email">
                                            <span class="icon is-small is-left">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                            <span class="icon is-small is-right">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </span>
                                        </div>
                                        <p v-if="emailInvalid" class="help" :class="{'is-danger':emailInvalid}">This email is invalid</p>
                                    </div>
                                    <div class="field" v-for="(mate,index) in shareMates">
                                        <label class="label">Person {{index+1}}</label>
                                        <div class="field has-addons" >
                                            <div class="control is-expanded">
                                                <input type="text" class="input" v-model="mate.value" :key="index">
                                            </div>
                                            <div class="control">
                                            <span @click="reduceShareMateCount">
                                                <i class="button fas fa-times"></i>
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="button" type="button" @click="addNewShareMate">
                                        <i class="fas fa-plus"></i>
                                        Add Person
                                    </button>
                                    <hr>
                                    <button class="button is-primary" type="submit">Create Split</button>
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
                split_name:"",
                creator_name:"",
                creator_email:"",
                shareMates: [],
                noOfShareMates:0,
                shareMateTemp:"",
                csrfToken:document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        },
        methods: {
            addNewShareMate(){

                this.shareMates.push({ value: '' });
            },
            reduceShareMateCount(){
                console.log("Calling");
                this.noOfShareMates--;
            },
            checkForm(){

            },
        },
    }
</script>

<style scoped>

</style>
