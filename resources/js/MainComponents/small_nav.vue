<template>
        <div class="top">
            <ul class="nav justify-content-center menu" style="width:96%">
                <li  class="nav-item" style="width:24%">
                    <button class="button" id="button-4">
                        <div id="underline"></div>
                        <h7 class="menu" >Transactions</h7>
                    </button>
                </li>
                <li class="nav-item" style="width:24%">
                    <button class="button" id="button-4">
                        <div id="underline"></div>
                        <h7 class="menu" >report</h7>
                    </button>
                </li>
                <li class="nav-item" style="width:24%">
                    <button class="button" id="button-4">
                        <div id="underline"></div>
                        <h7 class="menu" >wallet</h7>
                    </button>
                </li>
                <li class="nav-item" style="width:24%">
                    <button class="button" id="button-4">
                        <div id="underline"></div>
                        <h7 class="menu" >Let's Go!</h7>
                    </button>
                </li>
            </ul>
        </div>
</template>

<style>
    .top{
        margin-top:5px;
    }

    .button {
        display: inline-flex;
        height: 40px;
        width: 100%;
        border: 2px solid #8458B3;
        margin: 20px 20px 20px 20px;
        color: #8458B3;
        text-transform: uppercase;
        text-decoration: none;
        font-size: .9em;
        font-weight: 600;
        letter-spacing: 1.5px;
        background-color: #e5eaf5;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    h7 {
        color: #8458B3;
        text-decoration: none;
        letter-spacing: 1px;
    }
    #button-4 {
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }

    #button-4 h7 {
        position: relative;
        transition: all .45s ease-Out;
    }

    #underline {
        width: 100%;
        height: 2.5px;
        margin-top: 15px;
        align-self: flex-end;
        left: -100%;
        background: #8458B3;
        position: absolute;
        transition: all .3s ease-Out;
        bottom: 0;
    }

    #button-4:hover #underline {
        left: 0;
    }

    button:focus {
        outline: 0 !important;
    }
</style>
