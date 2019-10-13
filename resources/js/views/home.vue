<template>
    <div class="container">
        <div class="hero">
            <div class="hero-body">
                <h1 class="has-text-centered">
                HOMEPAGE
                </h1>
                    <ul>
                        <li v-for="split in splitList">
                            <a :href="'view/splits/'+split.split_name+'/'+split.localHash">
                                {{split.split_name}}
                            </a>

                        </li>
                    </ul>

            </div>
        </div>
         <h1>
         </h1>
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
