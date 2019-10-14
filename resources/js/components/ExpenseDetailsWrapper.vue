<template>
    <div class="box">
        <div class="is-block">
            <h1 class="title is-5 has-text-black"> {{exp.payerName}} paid {{exp.amount}} for {{exp.forWhat}} </h1>
        </div>
        <div>
            <h6 class="subtitle is-6 has-text-black"> People Involved: {{ exp.contributers }}.  {{exp.createdAt}}</h6>
        </div>

    </div>
</template>

<script>
    export default {
        name: "ExpenseDetailsWrapper.vue",
        props:['exp'],

    }
</script>

<style scoped>

</style>
