<template>
    <div class="limiter">
        <div class="container-login100" >
            <div class="wrap-login100" >
                <form class="login100-form" v-on:submit = "login">
                    <span class="login100-form-title p-b-34">
						Account Login
					</span>
                    <div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" id="email-box">
						<input
                            class="input100"
                            placeholder="Email"
                            type="email"
                            id="Email"
                            aria-describedby="emailHelp"
                            v-model="email"
                            :class="{'is-invalid': error_email}"
                        >
                        <!-- <div class="invalid-feedback"> {{ error_email }}</div> -->
					</div>

					<div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" id="password-box">
						<input
                            class="input100"
                            placeholder="Password"
                            type="password"
                            id="Password"
                            v-model="password"
                            :class="{'is-invalid': error_password}"
                        >


					</div>
                    <div style="color:red;"> {{ error_password }}</div>
                    <div style="color:red;"> {{ error_email }}</div>
					<div class="container-login100-form-btn">

						<button class="login100-form-btn" type="submit">
							Sign in
						</button>
					</div>
                    <div class="signUp-btn">
                        <p class="signUp-btn">
                            No account? &nbsp;
                            <a style=" cursor: pointer;" class="txt" @click="regis">
							    Sign Up
						    </a>
                        </p>
					</div>



                </form>

                <div class="login100-more" style="background-image: url('./asset/bg-01.jpg');"></div>
            </div>


        </div>
        <div class="d-flex justify-content-center credit">
            <span>Credit picture : designed by <a style="color:gray;" href="http://www.freepik.com" target="_blank" rel="noopener noreferrer"> @master1305 / Freepik</a></span>

        </div>

    </div>
</template>

<script>
    export default {
        name:'login',
        data(){
            return {
                email : "",
                password : "",
                error_email : "",
                error_password : "",
                errors : [],
            }
        },
        methods:{
            regis(){
                this.$router.push({name:'register'});
            },
            login(e){
                e.preventDefault();
                this.error_email = null;
                this.error_password = null;
                this.errors = [];
                document.getElementById('email-box').style.borderLeftWidth = "1px";
                document.getElementById('password-box').style.borderLeftWidth = "1px";
                document.getElementById('email-box').style.borderLeftColor = "#e6e6e6";
                document.getElementById('password-box').style.borderLeftColor = "#e6e6e6";




                let data = {
                    email : this.email,
                    password : this.password,
                }
                axios.get('/sanctum/csrf-cookie').then(response =>{
                    console.log(this.email , this.password);
                    axios
                    .post('/api/user/login',data)
                    .then(res => {
                        localStorage.setItem("isLoggedIn","true");
                        this.$router.go({ name: "transaction" });
                    })
                    .catch(error =>{
                        if(error.response.status === 401){
                            this.error_email = "Wrong email or password.";
                            this.error_email = "Wrong email or password.";
                            this.errors.push(this.error_email);
                            this.errors.push(this.error_password);
                            document.getElementById('email-box').style.borderLeftColor = " #ff4242";
                            document.getElementById('email-box').style.borderLeftWidth = "4px";
                            document.getElementById('password-box').style.borderLeftColor = "#ff4242";
                            document.getElementById('password-box').style.borderLeftWidth = "4px";
                        }
                    });
                });
            }
        }
    }
</script>

<style>
    input {
        outline: none;
        border: none;
    }

    textarea {
        outline: none;
        border: none;
    }

    textarea:focus, input:focus {
        border-color: transparent !important;
    }

    input::-webkit-input-placeholder { color: #999999;}
    input:-moz-placeholder { color: #999999;}
    input::-moz-placeholder { color: #999999;}
    input:-ms-input-placeholder { color: #999999;}

    textarea::-webkit-input-placeholder { color: #999999;}
    textarea:-moz-placeholder { color: #999999;}
    textarea::-moz-placeholder { color: #999999;}
    textarea:-ms-input-placeholder { color: #999999;}

    /*---------------------------------------------*/
    button {
        outline: none !important;
        border: none;
        background: transparent;
    }

    button:hover {
        cursor: pointer;
    }
    .credit{
        width: 100%;
        font-size: 12px;
    }
    .signUp-btn{
        margin-top: 20px;
        width: 100%;
        justify-content: center;
        align-items: center;
        text-align: center;
    }
    .txt {
        font-size: 15px;
        line-height: 1.4;
        color: #00ad5f;
        text-transform: uppercase;
    }
    .bg-dark2{
        background-color: #dbdbdb;
    }
    .container-login100 {
        width: 100%;
        min-height: 91vh;
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        padding: 0px;
        background: #f2f2f2;
    }
    .login100-form {
        width: 50%;
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        flex-wrap: wrap;
        padding: 20% 65px 20% 65px;
    }
    .wrap-login100 {
        width: 1170px;
        background: #fff;
        overflow: hidden;
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        flex-wrap: wrap;
        align-items: stretch;
        flex-direction: row-reverse;
    }
    .limiter {
        width: 100%;
        margin: 0 auto;
    }
    .login100-form-title {
        /* font-family: Poppins-Regular; */
        font-size: 25px;
        color: #555555;
        line-height: 1.2;
        text-transform: uppercase;
        letter-spacing: 2px;
        text-align: center;
        padding: 0px 0px 34px;
        width: 100%;
        display: block;
    }
    .wrap-input100 {
        width: 100%;
        position: relative;
        border: 1px solid #e6e6e6;

    }

    .rs1-wrap-input100,
    .rs2-wrap-input100 {
        width: 100%;
    }

    .rs2-wrap-input100 {
        border-top: none;
    }

    .rs3-5-wrap-input100,
    .rs3-wrap-input100 {
        width: 50%;
        border-top: none;
    }

    /* .rs3-5-wrap-input100{
        border-left: none;
    } */

    .input100 {
        display: block;
        width: 100%;
        background: transparent;
        /* font-family: Poppins-Regular; */
        font-size: 16px;
        color: #666666;
        line-height: 1.2;
        padding: 0 25px;
        border: 0;
    }
    .select100 {
        display: block;
        width: 94%;
        background: #ffffff;
        /* font-family: Poppins-Regular; */
        font-size: 16px;
        color: #666666;
        line-height: 1.2;
        padding: 15px 0px 15px 20px;
        border: 0;
    }

    input.input100 {
        height: 55px;
    }
    .container-login100-form-btn {
        width: 100%;
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        border: 0px;
        margin: 25px 0px 0px 0px;
    }

    .login100-form-btn {
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0 20px;
        width: 100%;
        height: 50px;
        border: 0px;
        background: #416946;

        /* font-family: Montserrat-Bold; */
        font-size: 16px;
        color: #fff;
        font-weight: bold;
        line-height: 1.2;
        text-transform: uppercase;
        letter-spacing: 1px;

        -webkit-transition: all 0.4s;
        -o-transition: all 0.4s;
        -moz-transition: all 0.4s;
        transition: all 0.4s;
    }

    .login100-form-btn:hover {
        background: #333333;
    }
    .validate-input {
        position: relative;
    }
    .login100-more {
        width: 50%;
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        position: relative;
        z-index: 1;
    }

    .login100-more::before {
        content: "";
        display: block;
        position: absolute;
        z-index: -1;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: rgba(0,0,0,0.3);
    }
    @media (max-width: 992px) {
        .login100-form {
            width: 60%;
            padding-left: 30px;
            padding-right: 30px;
        }

        .login100-more {
            width: 40%;
        }

    }

    @media (max-width: 768px) {
        .login100-form {
            width: 100%;
        }

        .login100-more {
            width: 100%;
        }

    }

    @media (max-width: 576px) {
        .login100-form {
            padding-left: 15px;
            padding-right: 15px;
            padding-top: 150px;
        }

    }
</style>
