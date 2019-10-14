<template>
<div class="container ">
    <div class="columns is-centered">
        <div class="column is-half ">
            <section class="hero is-primary is-bold">
                <div class="hero-body">
                    <div class="container">
                        <h1 class="title">
                            Enter Split Details
                        </h1>
                        <button class="button is-pulled-right" @click="redirectToExpenses">View Split Details</button>
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
                                <input class="input " type="text" v-model="splitDetailsData.amount" @keydown="errors.amount=''">
                                <span class="icon is-small is-left">
                                 <i class="fas fa-rupee-sign"></i>
                            </span>
                            </p>
                            <p class="is-danger help" v-if="errors.amount">
                                    {{errors.amount}}
                            </p>
                        </div>
                        <div class="control column">
                            <label class="radio is-block" for="all">
                                <input type="radio" id="all" name="answer" value="all" v-model="splitDetailsData.splitAll" checked>
                                Split Equally
                            </label>
                            <label class="radio" style="margin-left: 0px" for="all">
                                <input type="radio" name="answer" id="different" value="different" v-model="splitDetailsData.splitAll">
                                Split Differently
                            </label>
                        </div>
                        <split-differently :allcontributors="allMates" v-if="splitDetailsData.splitAll=='different'">

                        </split-differently>
                        <div class="field column is-half">
                            <label class="label">
                                For What ?
                            </label>
                            <p class="control  ">
                                <input class="input " type="text" v-model="splitDetailsData.forWhat" @keydown="errors.reason=''">
                            </p>
                            <p class="is-danger help" v-if="errors.reason">
                                {{errors.reason}}
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
    </div>
</div>
</template>

<script>
    export default {
        name: "splitDetails.vue",
        props:['splitdetailsjson'],
        data: function () {
            return {
                allMates:[],
                splitDetailsData:{
                    payer:"",
                    amount:"",
                    forWhat:"",
                    when:"",
                    expenseType:"expense",
                    contributers:this.splitdetailsjson.all_contributers,
                    id:"",
                    splitAll:"all",
                },
                errors:{
                    amount:"",
                    reason:"",
                    when:"",
                }
            }
        },
        mounted() {
            let self = this;
            self.allMates = self.splitdetailsjson.all_contributers.split(',');
            self.splitDetailsData.id=self.splitdetailsjson.id;
            self.splitDetailsData.payer=self.allMates[0];

            // Updating the Contributors When Selection changes in Split Differently Template
            this.$root.$on('Event',data=>{
                self.splitDetailsData.contributers = data.join(",");
            })
        },
        methods: {
            sendData(){
                let self = this;
                if(this.validateForm())
                {
                    axios.post('/add/expense',{
                        data:this.splitDetailsData
                    }).then(function (response) {
                        console.log("Successfully Submitted");
                        this.clearData();
                    }).catch(function (error) {
                        console.log(error);
                    });
                }

            },
            redirectToExpenses()
            {
                document.location.href='/view/expenses/'+this.splitdetailsjson.localHash;
            },
            clearData()
            {
                this.splitDetailsData = {}
            },
            validateForm()
            {
                let flag=1;

                if(this.splitDetailsData.amount=="" || isNaN(this.splitDetailsData))
                {
                    this.errors['amount'] = "Enter Valid Amount";
                    flag=0;
                }
                if(this.splitDetailsData.forWhat=="")
                {
                    this.errors['reason'] = "Enter the Required Field";
                    flag=0;
                }

                return flag;
            }
        }
    }
</script>

<style scoped>

</style>
