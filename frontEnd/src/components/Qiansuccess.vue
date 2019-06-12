<template>
    <el-container>
        <el-main class="el-main">您已签到成功！</el-main>
    </el-container>
    <!--<el-container>-->
        <!--<el-header>Header</el-header>-->
        <!--<el-main>Main</el-main>-->
        <!--<el-footer>Footer</el-footer>-->
    <!--</el-container>-->
    <!--<el-row class="panel m-w-1280">-->
        <!--<el-col :span="24" class="panel-top">-->
            <!--<el-col :span="4">-->
            <!--</el-col>-->
            <!--<el-col :span="4" class="pos-rel">-->
                <!--<el-dropdown @command="handleMenu" class="user-menu">-->
		      <!--<span class="el-dropdown-link c-gra" style="cursor: default">-->
		        <!--{{username}}&nbsp;&nbsp;<i class="fa fa-user" aria-hidden="true"></i>-->
		      <!--</span>-->
                    <!--&lt;!&ndash;<el-dropdown-menu slot="dropdown">&ndash;&gt;-->
                        <!--&lt;!&ndash;<el-dropdown-item command="changePwd">修改密码</el-dropdown-item>&ndash;&gt;-->
                        <!--&lt;!&ndash;<el-dropdown-item command="logout">退出</el-dropdown-item>&ndash;&gt;-->
                    <!--&lt;!&ndash;</el-dropdown-menu>&ndash;&gt;-->
                <!--</el-dropdown>-->
            <!--</el-col>-->
        <!--</el-col>-->
        <!--<el-col :span="24" class="panel-center">-->
            <!--&lt;!&ndash;<el-col :span="4">&ndash;&gt;-->
            <!--<section class="panel-c-c" :class="{'hide-leftMenu': hasChildMenu}">-->
                <!--<div class="grid-content bg-purple-light">-->
                    <!--<el-col :span="24">-->
                        <!--<transition name="fade" mode="out-in" appear>-->
                            <!--<router-view v-loading="showloading"></router-view>-->
                        <!--</transition>-->
                    <!--</el-col>-->
                <!--</div>-->
            <!--</section>-->
        <!--</el-col>-->

        <!--<changePwd ref="changePwd"></changePwd>-->

    <!--</el-row>-->
</template>
<style>
    .el-header, .el-footer {
        background-color: #B3C0D1;
        color: #333;
        text-align: center;
        line-height: 60px;
    }

    .el-main {
        background-color: #1F2D3D;
        color: #F9F9F9;
        font-size:40px;
        position: absolute;
        left:600px;
        top:200px;
        bottom: 300px;
        text-align: center;
        line-height: 160px;
    }

    body > .el-container {
        margin-bottom: 40px;
    }

    .el-container:nth-child(5) .el-aside,
    .el-container:nth-child(6) .el-aside {
        line-height: 260px;
    }

    .el-container:nth-child(7) .el-aside {
        line-height: 320px;
    }
    /*.fade-enter-active,*/
    /*.fade-leave-active {*/
        /*transition: opacity .5s*/
    /*}*/

    /*.fade-enter,*/
    /*.fade-leave-active {*/
        /*opacity: 0*/
    /*}*/

    /*.panel {*/
        /*position: absolute;*/
        /*top: 0px;*/
        /*bottom: 0px;*/
        /*width: 100%;*/
    /*}*/

    /*.panel-top {*/
        /*height: 60px;*/
        /*line-height: 60px;*/
        /*background: #F9F9F9;*/
        /*color: #c0ccda;*/
    /*}*/

    /*.panel-center {*/
        /*background:#F9F9F9;*/
        /*font-size:40px;*/
        /*position: absolute;*/
        /*left:600px;*/
        /*top:0px;*/
        /*bottom: 110px;*/
        /*overflow: hidden;*/
    /*}*/

    /*.panel-c-c {*/
        /*background: #f1f2f7;*/
        /*position: absolute;*/
        /*right: 0px;*/
        /*top: 0px;*/
        /*bottom: 0px;*/
        /*left: 180px;*/
        /*overflow-y: scroll;*/
        /*padding: 20px;*/
    /*}*/

    /*.logout {*/
        /*background: url(../assets/images/logout_36.png);*/
        /*background-size: contain;*/
        /*width: 20px;*/
        /*height: 20px;*/
        /*float: left;*/
    /*}*/

    /*.logo {*/
        /*width: 150px;*/
        /*float: left;*/
        /*margin: 10px 10px 10px 18px;*/
    /*}*/

    /*.tip-logout {*/
        /*float: right;*/
        /*margin-right: 20px;*/
        /*padding-top: 5px;*/
        /*cursor: pointer;*/
    /*}*/

    /*.admin {*/
        /*color: #c0ccda;*/
        /*text-align: center;*/
    /*}*/
    /*.hide-leftMenu {*/
        /*left: 0px;*/
    /*}*/
</style>

<script>
    import leftMenu from './Common/leftMenu.vue'
    import changePwd from './Account/changePwd.vue'
    import http from '../assets/js/http'

    export default {

        mixins: [http]
    }
</script>
