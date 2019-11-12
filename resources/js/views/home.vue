<template>
    <div class="container">
        <div class="columns">
            <div class="column is-half">
                <figure class="image">
                    <img  src="../../Images/Homepage-Logo.svg">
                </figure>

            </div>
            <div class="column is-half ">
                <h1 class="title is-1"><span >FAIR</span><span style="color: seagreen">SHARE</span></h1>
                <h3 class="subtitle is-3" style="color: seagreen">Split your expenses easily...</h3>
                <button class="button is-primary is-outlined">Get started</button>
                <button class="button is-primary is-outlined">Outlined</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "home.vue",
        data: function () {
            return {
                splitList: this.splitlist,
            }
        },
        props:['splitlist'],


    }
</script>

<style scoped>

</style>
