<template>
    <section class="hero is-light is-bold">
        <div class="hero-body">

                <label class="checkbox" @click="addAllonCheck">
                    <input type="checkbox" v-model="all" >
                    All
                </label>
                <label v-for="contributor in contributors" class="checkbox is-block" @click="removeAddFromCheck">
                    <input type="checkbox" :value="contributor" v-model="contributorsSelection">
                    {{contributor}}
                </label>

        </div>
    </section>
</template>

<script>
    export default {
        name: "splitDifferently.vue",
        props:['allcontributors'],
        data: function () {
            return {
                contributors: this.allcontributors,
                all:true,
                contributorsSelection:this.allcontributors,
            }
        },
        methods: {
            addAllonCheck()
            {
                if(this.all==false)
                {
                    this.contributorsSelection = this.contributors;
                }
                else if(this.all==true){
                    console.log("Running");
                    this.contributorsSelection = [];
                }
            },
            removeAddFromCheck()
            {
                console.log("Running");
                if(this.all == true) {
                    this.all = false;
                }
            },
            sendSelectiontoParentComponent(list)
            {
                this.$root.$emit("Event",list);
            }
        },
        watch:{
            contributorsSelection:function () {
                this.sendSelectiontoParentComponent(this.contributorsSelection);
            }
        }
    }
</script>

<style scoped>

</style>
