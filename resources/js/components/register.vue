<template>
    <div class="limiter">
        <div class="container-login100" >
            <div class="wrap-login100" >
                <form class="regis100-form" v-on:submit = "submit">
                    <span class="login100-form-title p-b-34">
						Sign Up
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
					</div>

                    <div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" id="username-box">
						<input
                            class="input100"
                            placeholder="Userame"
                            type="text"
                            id="Username"
                            v-model="username"
                            :class="{'is-invalid': error_username}"
                        >
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

                    <div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" id="confirm-password-box">
						<input
                            class="input100"
                            placeholder="Confirm Password"
                            type="password"
                            id="Confirm-password"
                            v-model="confirm_password"
                            :class="{'is-invalid': error_confirm_password}"
                        >
					</div>

                    <div class="wrap-input100 rs3-wrap-input100 validate-input m-b-20" id="name-box">
						<input
                            class="input100"
                            placeholder="Name"
                            type="text"
                            id="Name"
                            aria-describedby="emailHelp"
                            v-model="name"
                            :class="{'is-invalid': error_name}"
                        >
					</div>

                    <div class="wrap-input100 rs3-5-wrap-input100 validate-input m-b-20" id="surname-box">
						<input
                            class="input100"
                            placeholder="Surname"
                            type="text"
                            id="Surname"
                            v-model="surname"
                            :class="{'is-invalid': error_surname}"
                        >
					</div>

                    <div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" id="dob-box">
						<input
                            type="text"
                            onfocus="(this.type='date')"
                            onblur="(this.type='text')"
                            class="input100"
                            placeholder="Date of Birth"
                            :class="{'is-invalid': error_DOB}"
                            id="DOB"
                            v-model="DOB"
                        >
					</div>

                    <div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" id="gender-box">
						<select
                            id="Gender"
                            class="select100"
                            :class="{'is-invalid': error_gender}"
                            v-model="gender"
                        >
                            <option value="" disabled selected>Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
					</div>



                    <!-- <div style="color:red;"> {{ error_password }}</div>
                    <div style="color:red;"> {{ error_email }}</div> -->

					<div class="container-login100-form-btn">

						<button class="login100-form-btn" type="submit">
							Sign  Up
						</button>
					</div>



                </form>

                <div class="login100-more" style="background-image: url('./asset/bg-regis.jpg');"></div>
            </div>


        </div>
        <div class="d-flex justify-content-center credit">
            <span>Credit picture : designed by <a style="color:gray;" href="http://www.freepik.com" target="_blank" rel="noopener noreferrer"> @katemangostar  / Freepik</a></span>

        </div>

    </div>









</template>

<script>
    export default {
        name:'register',
        data(){
            return {
                name: "",
                userData: "",
                surname: "",
                DOB : "",
                username :"",
                email : "",
                password : "",
                confirm_password : "",
                gender : "",
                error_name: "",
                error_surname: "",
                error_DOB : "",
                error_username : "",
                error_email : "",
                error_password: "",
                error_confirm_password: "",
                error_gender : "",
                errors : []
            }
        },
        mounted() {
            axios.get('api/user/getMailsUsers').then(response => {
                // console.log(response.data);
                this.userData = response.data;
            });
        },
        methods: {
            submit(e){
                e.preventDefault();
                this.error_name = null;
                this.error_surname = null;
                this.error_DOB = null;
                this.error_username = null;
                this.error_email = null;
                this.error_password = null;
                this.error_gender = null;
                this.errors = [];

                document.getElementById('email-box').style.borderLeftWidth = "1px";
                document.getElementById('username-box').style.borderLeftWidth = "1px";
                document.getElementById('password-box').style.borderLeftWidth = "1px";
                document.getElementById('confirm-password-box').borderLeftWidth = "1px";
                document.getElementById('name-box').style.borderLeftWidth = "1px";
                document.getElementById('surname-box').style.borderLeftWidth = "1px";
                document.getElementById('dob-box').style.borderLeftWidth = "1px";
                document.getElementById('gender-box').style.borderLeftWidth = "1px";

                document.getElementById('email-box').style.borderLeftColor = "#e6e6e6";
                document.getElementById('username-box').style.borderLeftColor = "#e6e6e6";
                document.getElementById('password-box').style.borderLeftColor = "#e6e6e6";
                document.getElementById('confirm-password-box').style.borderLeftColor = "#e6e6e6";
                document.getElementById('name-box').style.borderLeftColor = "#e6e6e6";
                document.getElementById('surname-box').style.borderLeftColor = "#e6e6e6";
                document.getElementById('dob-box').style.borderLeftColor = "#e6e6e6";
                document.getElementById('gender-box').style.borderLeftColor = "#e6e6e6";
                // เหลือเขียนกันบัค input ------------------------------------------------------------------------------------------------------------
                // check email same
                // check username same

                if(!this.name.trim()){
                    this.error_name = "Please fill the name.";
                    this.errors.push(this.error_name);
                    document.getElementById('name-box').style.borderLeftColor = "#ff4242";
                    document.getElementById('name-box').style.borderLeftWidth = "4px";

                }
                else{
                    this.error_name = null;
                }

                if(!this.surname.trim()){
                    this.error_surname = "Please fill the surname.";
                    this.errors.push(this.error_surname);
                    document.getElementById('surname-box').style.borderLeftColor = "#ff4242";
                    document.getElementById('surname-box').style.borderLeftWidth = "4px";
                }
                else{
                    this.error_surname = null;
                }

                if(!this.username.trim()){
                    this.error_username = "Please fill the username.";
                    this.errors.push(this.error_username);
                    document.getElementById('username-box').style.borderLeftColor = "#ff4242";
                    document.getElementById('username-box').style.borderLeftWidth = "4px";
                }
                else{
                    this.error_username = null;
                }

                if(!this.DOB){
                    this.error_DOB = "Please select the Date of birth";
                    this.errors.push(this.error_DOB);
                    document.getElementById('dob-box').style.borderLeftColor = "#ff4242";
                    document.getElementById('dob-box').style.borderLeftWidth = "4px";
                }
                else{
                    this.error_DOB == null;
                }

                if(!this.email.trim()){
                    this.error_email = "Please fill the email";
                    this.errors.push(this.error_email);
                    document.getElementById('email-box').style.borderLeftColor = "#ff4242";
                    document.getElementById('email-box').style.borderLeftWidth = "4px";
                }
                else{
                    this.error_email = null;
                }

                if(!this.gender){
                    this.error_gender = "Please select the gender";
                    this.errors.push(this.error_gender);
                    document.getElementById('gender-box').style.borderLeftColor = "#ff4242";
                    document.getElementById('gender-box').style.borderLeftWidth = "4px";
                }
                else{
                    this.error_gender = null;
                }

                if(!this.password.trim()){
                    this.error_password = "Please fill the password";
                    this.errors.push(this.error_password);
                    document.getElementById('password-box').style.borderLeftColor = "#ff4242";
                    document.getElementById('password-box').style.borderLeftWidth = "4px";
                }
                else if(this.password.trim().length < 6){
                    this.error_password = "Password must have lenght more than 6 or equal.";
                    this.errors.push(this.error_password);
                    document.getElementById('password-box').style.borderLeftColor = "#ff4242";
                    document.getElementById('password-box').style.borderLeftWidth = "4px";
                }
                else{
                    this.error_password = null;
                }
                if(this.password.trim() !== this.confirm_password.trim() && this.password && this.password.trim().length >= 6 || !this.confirm_password){
                    this.error_confirm_password = "Password not matched.";
                    this.errors.push(this.error_confirm_password);
                    document.getElementById('confirm-password-box').style.borderLeftColor = "#ff4242";
                    document.getElementById('confirm-password-box').style.borderLeftWidth = "4px";
                }
                else{
                    this.error_confirm_password = null;
                }

                for(var i=0;i<this.userData.length;i++){
                    if(this.userData[i]['email'] === this.email){
                        this.error_email = "This email address is already in use";
                        this.errors.push(this.error_email);
                        document.getElementById('email-box').style.borderLeftColor = "#ff4242";
                        document.getElementById('email-box').style.borderLeftWidth = "4px";
                    }
                    if(this.userData[i]['username'] === this.username){
                        this.error_username = "This username is already in use";
                        this.errors.push(this.error_username);
                        document.getElementById('username-box').style.borderLeftColor = "#ff4242";
                        document.getElementById('username-box').style.borderLeftWidth = "4px";
                    }
                }

                if(this.errors.length === 0){
                    let data= {
                        name : this.name,
                        surname : this.surname,
                        DOB : this.DOB,
                        username : this.username,
                        password : this.password,
                        email : this.email,
                        gender : this.gender
                    }
                    axios.post('/api/user/regis',data).then(response =>{
                        console.log(response.data.message);
                    }).then(response=> {
                        axios.get('/sanctum/csrf-cookie').then(response =>{
                            axios
                            .post('/api/user/login',{
                                email : this.email,
                                password : this.password
                            })
                            .then(res => {
                                localStorage.setItem("isLoggedIn","true");
                                this.$router.go({ name: "transaction" });
                            })
                        });
                    });
                }



            }
        }
    }
</script>
<style>

    .bg-dark2{
        background-color: #dbdbdb;
    }

    .regis100-form {
        width: 50%;
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        flex-wrap: wrap;
        padding: 10% 65px 10% 65px;
    }
    /* CSS in script Login.vue */
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
        .regis100-form {
            width: 60%;
            padding-left: 30px;
            padding-right: 30px;
        }

        .login100-more {
            width: 40%;
        }

    }

    @media (max-width: 768px) {
        .regis100-form {
            width: 100%;
        }

        .login100-more {
            width: 100%;
        }

    }

    @media (max-width: 576px) {
        .regis100-form {
            padding-left: 15px;
            padding-right: 15px;
            padding-top: 150px;
        }

    }
</style>
