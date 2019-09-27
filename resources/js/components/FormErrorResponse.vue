<template>
    <span v-if="errorName">
        <p class="is-danger help">
            <slot>
                {{errorName}}
            </slot>
        </p>
    </span>
</template>

<script>
    export default {
        name: "FormErrorResponse.vue",
        props: ['errorName'],
    }
</script>

<style scoped>

</style>
