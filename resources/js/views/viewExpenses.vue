<template>
    <section class="hero is-primary">
        <div class="hero-body">
            <div class="container">
                <div class="columns is-centered">
                    <div class="column is-half">
                        <h1 class="title is-inline-block">
                            Overview
                        </h1>
                        <button class="button is-danger is-inline-block is-pulled-right" @click="redirectToAddExpense"> Add Expense</button>
                        <section class="hero is-light">
                            <div class="hero-body">
                                <div class="container">
                                    <div class="columns">
                                        <div class="column">
                                            <p>You Are</p>
                                        </div>
                                        <div class="column">
                                            <div class="select">
                                                <select  v-model="viewer">
                                                    <option v-for="mates in contributors" v-bind:value="mates">{{mates}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="columns">
                                        <div class="column">
                                            <p>Total Cost to Group</p>
                                        </div>
                                        <div class="column">
                                            <h4>{{totalCost}}</h4>
                                        </div>
                                    </div>
                                    <div class="columns">
                                        <div class="column">
                                            <p>It Cost You</p>
                                        </div>
                                        <div class="column">
                                            <h4>{{yourCost}}</h4>
                                        </div>

                                    </div>
                                    <div class="columns">
                                        <div class="column">
                                            <p>You Paid</p>
                                        </div>
                                        <div class="column">
                                            <h4>{{youPaid}}</h4>
                                        </div>

                                    </div>
                                    <div class="columns">
                                        <div class="column">
                                            <p>You {{owedOrOwe}}</p>
                                        </div>
                                        <div class="column">
                                            <h4>{{youOwed}}</h4>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="columns">

                </div>


            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: "viewExpenses.vue",
        props:['allexpenses','splitname','splithash','contributors'],
        data: function () {
            return {
                viewer:"",
                totalCost:0,
                yourCost:0,
                youPaid:0,
                youOwed:0,
                allExpenses:[],
                contributorsAmount:{},
                contributorsPaid:{},
                owedOrOwe:" are Owed",
            }
        },
        mounted() {
            this.allExpenses = this.allexpenses;
            this.initializeContributorAmount();

            for(let i=0;i<this.allExpenses.length;i++)
            {
                this.totalCost += parseInt(this.allExpenses[i].amount);
            }

            this.calculateAmountForEachContributors();

        },
        methods:{
            initializeContributorAmount()
            {
                for(let i=0;i<this.contributors.length;i++)
                {
                    this.contributorsAmount[this.contributors[i]]=0;
                    this.contributorsPaid[this.contributors[i]]=0;
                }
            },
            calculateAmountForEachContributors()
            {
                    for(let i=0;i<this.allExpenses.length;i++)
                    {
                        let amount = this.allExpenses[i].amount;
                        let contributors = this.allExpenses[i].contributers;
                        contributors = contributors.split(",");
                        console.log(contributors);
                        let share = amount/contributors.length;



                        //Decreasing Amount of Other Contributors except Payer

                        for(let j=0;j<contributors.length;j++)
                        {
                            if(contributors[j]!=this.allExpenses[i].payerName)
                            {
                                this.contributorsAmount[contributors[j]]-=share;
                            }
                        }
                        //Incrementing Payer Amount
                        this.contributorsAmount[this.allExpenses[i].payerName]+= (this.allExpenses[i].amount-share);
                        // Storing Which Contributor paid how Much
                        this.contributorsPaid[this.allExpenses[i].payerName]+=this.allExpenses[i].amount;
                    }

                    // Setting Values to the View


            },
            commaSeperatedStringtoArray()
            {

            },
            returnItCostYou()
            {

            },
            redirectToAddExpense()
            {
                document.location.href='/view/splits/'+this.splitname+'/'+this.splithash;
            }

        },
        watch:{
            viewer: function () {



                // Code to Determine Owed or Own
                if(this.contributorsAmount[this.viewer]<0)
                {
                    this.owedOrOwe = "Owe";
                }
                else
                {
                    this.owedOrOwe= "are Owed";
                }
                // Code to Set Owed or Own
                this.youOwed = Math.abs(this.contributorsAmount[this.viewer]);
                this.youPaid = this.contributorsPaid[this.viewer];
                this.yourCost = Math.abs(this.contributorsAmount[this.viewer]-this.youPaid);
            }
        }
    }
</script>

<style scoped>

</style>
