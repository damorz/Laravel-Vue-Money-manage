<template>
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-md-6 vertical-center">
                <h1>Register Success!</h1>
                <form  v-on:submit="toHome">
                    <button type="submit" class="btn-clear" >Go to main page.</button>
                </form>

            </div>
        </div>
    </div>
</template>

<script>
    export default{
        name:'registersuccess',
        methods:{
            toHome(){
                this.$router.go({name:'transaction'});
            }
        }
    }

</script>

<style>
    .text-center{
        text-align: center;
    }
    .vertical-center {
        margin: 0;
        position: absolute;
        top: 50%;
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
    }
    .btn-clear{
        padding: 0;
        border: none;
        background: none;
    }
</style>
