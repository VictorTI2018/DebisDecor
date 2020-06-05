<template>
     <div class="page-container-title">
            <p class="page-title">{{ titulo }}</p>
        </div>
</template>

<script>
export default {
    name: 'v-page-title',
    props: ['titulo']
}
</script>

<style>
.page-container-title {
    height: 50px;
    border-bottom: 2px solid #778899;
    display: flex;
    align-items: center;
    margin-top: 4px;
    margin-bottom: 4px;
}
.page-title {
    color: #708090;
    font-weight: bold;
    font-size: 1.1rem;
    margin-left: 5px;
}
</style>