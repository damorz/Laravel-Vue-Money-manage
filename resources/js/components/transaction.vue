<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <label style="font-size:20px;font-weight:bold;" for="year">Year</label>
                <select
                    id="year"
                    class="custom-select select"
                    v-model="selectedYear"
                >
                    <option v-for="(year,index) in years" :key="index">{{year}}</option>
                </select>
            </div>
            <div class="col">
                <label style="font-size:20px;font-weight:bold;" for="month">Month</label>
                <select
                    id="month"
                    class="custom-select select "
                    v-model="selectedMonth"
                >
                    <option value="1">January</option>
                    <option value="2">Febuary</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
            </div>
        </div>
        <div style="margin-top:3%; margin-bottom:3%">
            <div v-for="(tran,index) in transactions" :key="index">
                <div>
                    <br v-if="tran.sameday" >
                    <div v-if="tran.sameday">
                        <div class=" head-day">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title" style="font-size: 140%; font-weight:bold; margin-left: 1.25rem;">{{new Date(tran.date).getDate()}} | {{days[new Date(tran.date).getDay()]}}</h5>
                                </div>
                                <div class="col">
                                    <h5 style="text-align:right; font-size: 120%;">{{tran.totalPriceOfDay}} ฿</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="each-list">
                        <h5 class="card-title">{{tran.price}} ฿</h5>
                        <p class="card-text">Category : {{tran.category_id}}</p>
                        <p class="card-text">Description : {{tran.description}}</p>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <h4 style="font-size:20px; font-weight:bold; margin-top:20%;" v-show="trigger_none_data">You don't have any transaction in this month</h4>
            </div>
        </div>


        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel" style="font-weight:bold">Add new transaction</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="price" class="col-form-label">Amount(฿)</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="price"
                                    id="price"
                                    :class="{'is-invalid': error_price}"
                                >
                                <div class="invalid-feedback"> {{ error_price }}</div>
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select
                                    id="category"
                                    class="custom-select"
                                    :class="{'is-invalid': error_category}"
                                    v-model="category"
                                >
                                    <option v-for="(option,index) in options" :value="option" :key="index">{{option}}</option>
                                    <option>
                                        <a>+ Add new category ...</a>
                                    </option>
                                </select>
                                <div class="invalid-feedback"> {{ error_category }}</div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-form-label">Description</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="description"
                                    maxlength = "40"
                                    id="description"
                                    :class="{'is-invalid': error_description}"
                                >
                                <div class="invalid-feedback"> {{ error_description }}</div>
                            </div>
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input
                                    type="date"
                                    class="form-control"
                                    :class="{'is-invalid': error_date}"
                                    id="date"
                                    v-model="date"
                                />
                                <div class="invalid-feedback"> {{ error_date }}</div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary">Confirm</button>
                    </div>
                </div>
            </div>
        </div>

        <button class="addbtn" title="add transaction" data-toggle="modal" data-target="#Modal">+</button>
    </div>
</template>

<script>
    export default{
        name:'Transaction',
        data(){
            return {
                days : ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                allCategory : "",
                transactions_data:"",
                allyears:[],
                first_tran_of_day:[],
                previous:"",
                totalDay:0,
                hideTran: "hidden",
                dayCheck:true,
                showTran:[],
                selectedYear: new Date().getFullYear().toString(),
                selectedMonth: (new Date().getMonth() + 1).toString(),
                trigger_none_data:true,
                price: "",
                description : "",
                category: "Food",
                date : "",
                error_price: "",
                error_description : "",
                error_category: "",
                error_date : ""
            }
        },
        mounted(){
            // console.log(new Date().getMonth());
            axios.get('api/data/getCategory').then(response => {
                // console.log(response.data);
                this.allCategory = response.data;
            });
            // การรวมเงินในแต่ละวันมันมีการลบเลขด้วย อย่าลืม
            axios.get('api/user').then(response0=>{
                axios.post('api/data/getTransactions',{user_id:response0.data}).then(response =>{
                    this.transactions_data = response.data;
                    var count = 0;
                    var first_met = 0;
                    this.transactions_data.forEach(element => {
                        if(((new Date(element.date).getMonth()+1).toString() === this.selectedMonth) && (new Date(element.date).getFullYear().toString() === this.selectedYear)){
                            if(this.previous.date == element.date){
                                element.sameday = false;
                                if(element.transaction_type == "consumption"){
                                    element.totalPrice = this.previous.totalPrice - element.price;
                                }
                                else if(element.transaction_type == "income")
                                    element.totalPrice = this.previous.totalPrice + element.price;
                            }
                            else{
                                this.first_tran_of_day.push(count);
                                first_met++;
                                if(element.transaction_type == "consumption" ){
                                    element.totalPriceOfDay = -element.price;
                                    element.totalPrice = -element.price;
                                }
                                else if(element.transaction_type == "income" ){
                                    element.totalPriceOfDay = element.price;
                                    element.totalPrice = element.price;
                                }
                                element.sameday = true;
                            }
                            this.showTran.push(element);
                            this.previous = element;
                            count ++;
                            this.showTran[this.first_tran_of_day[first_met-1]].totalPriceOfDay = element.totalPrice;
                        }
                    });
                    console.log(this.previous);
                    if(this.showTran.length == 0){
                        this.trigger_none_data = true;
                    }
                    else{
                        this.trigger_none_data = false;
                    }
                });
            });
            axios.get('api/data/getYears').then(response =>{
                response.data.forEach(each_year => {
                    this.allyears.push(each_year['year']);
                });
            });
        },
        watch:{
            showTran : function(){
                if(this.showTran.length == 0){
                        this.trigger_none_data = true;
                    }
                else{
                    this.trigger_none_data = false;
                }
            },
            selectedYear : function() {
                // console.log("ss");
                this.showTran = [];
                var count = 0;
                var first_met = 0;
                this.transactions_data.forEach(element => {
                    if(((new Date(element.date).getMonth()+1).toString() === this.selectedMonth) && (new Date(element.date).getFullYear().toString() === this.selectedYear)){
                        if(this.previous.date == element.date){
                            element.sameday = false;
                            if(element.transaction_type == "consumption"){
                                element.totalPrice = this.previous.totalPrice - element.price;
                            }
                            else if(element.transaction_type == "income")
                                element.totalPrice = this.previous.totalPrice + element.price;
                        }
                        else{
                            this.first_tran_of_day.push(count);
                            first_met++;
                            if(element.transaction_type == "consumption" ){
                                element.totalPriceOfDay = -element.price;
                                element.totalPrice = -element.price;
                            }
                            else if(element.transaction_type == "income" ){
                                element.totalPriceOfDay = element.price;
                                element.totalPrice = element.price;
                            }
                            element.sameday = true;
                        }
                        this.showTran.push(element);
                        this.previous = element;
                        count ++;
                        this.showTran[this.first_tran_of_day[first_met-1]].totalPriceOfDay = element.totalPrice;
                    }
                });
            },
            selectedMonth : function() {
                // console.log("ss");
                this.showTran = [];
                var count = 0;
                var first_met = 0;
                this.transactions_data.forEach(element => {
                    if(((new Date(element.date).getMonth()+1).toString() === this.selectedMonth) && (new Date(element.date).getFullYear().toString() === this.selectedYear)){
                        if(this.previous.date == element.date){
                            element.sameday = false;
                            if(element.transaction_type == "consumption"){
                                element.totalPrice = this.previous.totalPrice - element.price;
                            }
                            else if(element.transaction_type == "income")
                                element.totalPrice = this.previous.totalPrice + element.price;
                        }
                        else{
                            this.first_tran_of_day.push(count);
                            first_met++;
                            if(element.transaction_type == "consumption" ){
                                element.totalPriceOfDay = -element.price;
                                element.totalPrice = -element.price;
                            }
                            else if(element.transaction_type == "income" ){
                                element.totalPriceOfDay = element.price;
                                element.totalPrice = element.price;
                            }
                            element.sameday = true;
                        }
                        this.showTran.push(element);
                        this.previous = element;
                        count ++;
                        this.showTran[this.first_tran_of_day[first_met-1]].totalPriceOfDay = element.totalPrice;
                    }
                });
            },
            // previous : function(newValue ,oldValue){
            //     // console.log(newValue + "  : "+ oldValue);
            //     if(newValue === oldValue){
            //         this.dayCheck = false;
            //         // console.log("combine");
            //     }
            //     else{
            //         this.dayCheck = true;
            //         // console.log("split");
            //     }
            // }
        },
        computed:{
            options(){
                return Object.keys(this.allCategory).map(k => {
                    let o = this.allCategory[k];
                    return `${o.category_name}`
                });
            },
            transactions(){
                return Object.keys(this.showTran).map(j=>{
                    return this.showTran[j];
                });
            },
            years(){
                return Object.keys(this.allyears).map(i=>{
                    return this.allyears[i];
                });
            }

        },
        methods:{
            submit(e){
                e.preventDefault();
            }
        }
    }

</script>

<style>
    p {
        margin-top: 0;
        margin-bottom: 0rem;
    }
    h5{
        margin: 0px 0px 0px 0px;
        padding: none;
    }

    .col{
        padding: none;
    }

    .row{
        margin-top: 3%;
    }

    .vertical-center {
        text-align: center;
        margin: 0;
        /* position:absolute; */
        top: 50%;
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
    }
    .btn-clear{
        padding: 0;
        border: none;
        background: none;
    }
    .addbtn {
        /* display: none; */
        position: fixed;
        bottom: 20px;
        height: 70px;
        line-height: 30px;
        width: 70px;
        right: 30px;
        z-index: 99;
        font-size: 40px;
        border: none;
        border-radius: 50%;
        outline: none;
        background-color: black;
        text-align: center;
        font-weight: bold;
        color: white;
        cursor: pointer;
        padding: 15px;
    }

    .addbtn:hover {
        background-color: #555;
    }
    .head-day{
        background: #416946;
        color: white;
        font-weight: bold;
        width: 100%;
        padding: 5px 20px 5px 20px;
        position: relative;
    }
    .each-list{
        background: #ffffff;
        width: 100%;
        padding: 20px 20px 20px 20px;
        position: relative;
        border: 1px solid #e6e6e6;
        border-top: none;
    }

    .select {
        display: block;
        width: 100%;
        /* background: #ffffff; */
        /* font-family: Poppins-Regular; */
        height: 60%;

        font-size: 16px;
        color: #666666;
        line-height: 1.2;
        padding: 10px 0px 10px 10px;
        position: relative;
        border: 1px solid #e6e6e6;
        border-radius: 0;
    }

    .head-search{
        /* background-image: url('./asset/bg-tran.jpg'); */
        width: 100%;
        height: 30%;
        padding: 3% 0 60px 0;
    }

    .select-option {
        width: 10%;
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        position: relative;
        z-index: 1;
    }


</style>
