<template>
<div class="container">
    <section class="hero is-primary is-bold">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Enter Split Details
                </h1>
                <div class="field column">
                    <div class="control is-inline-block">
                        <div class="select">
                            <select  v-model="splitDetailsData.payer">
                                <option v-for="mates in allMates" v-bind:value="mates">{{mates}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="content is-inline-block">
                        <p class="is-large"> Paid For Something</p>
                    </div>

                </div>
                <div class="field column is-half">
                    <label class="label">
                        HOW MUCH ?
                    </label>
                    <p class="control has-icons-left ">
                        <input class="input " type="text" v-model="splitDetailsData.amount">
                        <span class="icon is-small is-left">
                             <i class="fas fa-rupee-sign"></i>
                        </span>
                    </p>
                </div>
                <div class="control column">
                    <label class="radio is-block">
                        <input type="radio" name="answer" checked>
                            Split Equally
                    </label>
                    <label class="radio" style="margin-left: 0px">
                        <input type="radio" name="answer">
                        Split Differently
                    </label>
                </div>
                <div class="field column is-half">
                    <label class="label">
                        For What ?
                    </label>
                    <p class="control  ">
                        <input class="input " type="text" v-model="splitDetailsData.forWhat">
                    </p>
                </div>
                <div class="field column is-half">
                    <label class="label">
                        When ?
                    </label>
                    <p class="control  ">
                        <input class="input" type="date" v-model="splitDetailsData.when">
                    </p>
                </div>
                <div class="column">
                    <button class="button is-danger " type="button" @click="sendData">Add</button>
                </div>




            </div>
        </div>
    </section>


</div>
</template>

<script>
    export default {
        name: "splitDetails.vue",
        props:['splitdetailsjson'],
        data: function () {
            return {
                splitDetails:"",
                allMates:[],
                splitDetailsData:{
                    payer:"",
                    amount:"",
                    forWhat:"",
                    when:"",
                    expenseType:"expense",
                    contributers:this.splitdetailsjson.all_contributers,
                }
            }
        },
        mounted() {
            this.splitDetails = this.splitdetailsjson;
            this.allMates = this.splitDetails.all_contributers.split(',');
            // for(let i=0;i<mates.length;i++)
            // {
            //     this.allMates.push({
            //         'value':mates[i]
            //     });
            // }
            // this.allMates.push({
            //     'value':this.splitDetails.creator_name
            // });
            this.allMates.push(this.splitDetails.creator_name);
            this.splitDetailsData.payer=this.allMates[0];
        },
        methods: {
            sendData(){
                let self = this;
                axios.post('/add/expense',{
                    data:this.splitDetailsData
                }).then(function (response) {
                    console.log("Successfully Submitted");
                }).catch(function (error) {
                    console.log(error);
                })
            }
        }
    }
</script>

<style scoped>

</style>
