<template>
    <div class="m-l-50 m-t-30 w-900">
        <el-form ref="form" :model="form" :rules="rules" label-width="130px">
            <el-form-item label="签到二维码：" prop="pictrue">
                <div>
                    <qrcode-vue :value="value" :size="size" level="H"></qrcode-vue>
                </div>
            </el-form-item>

            <el-form-item label="会议名称：" prop="name">
                <el-row v-if="xiugaiflag">
                    <el-input v-model.trim="form.name" class="h-40 w-200"></el-input>
                </el-row>
                <el-row v-else>
                    {{form.name}}
                </el-row>
            </el-form-item>
            <el-form-item label="会议日期：" prop="price">
                <el-row v-if="xiugaiflag">
                    <el-input v-model.trim="form.price" class="h-40 w-200"></el-input>
                </el-row>
                <el-row v-else>
                    {{form.price}}
                </el-row>
            </el-form-item>
            <el-form-item label="会议时间：" prop="model">
                <el-row v-if="xiugaiflag">
                    <el-input v-model.trim="form.model" class="h-40 w-150"></el-input>
                </el-row>
                <el-row v-else>
                    {{form.model}}
                </el-row>
            </el-form-item>
            <el-form-item label="参与部门：" prop="brand">
                <el-row v-if="xiugaiflag">
                    <el-input v-model.trim="form.brand" class="h-40 w-150"></el-input>
                </el-row>
                <el-row v-else>
                    {{form.brand}}
                </el-row>
            </el-form-item>
            <el-form-item label="参与职位：" prop="model">
                <el-row v-if="xiugaiflag">
                    <el-input v-model.trim="form.manufacture" class="h-40 w-150"></el-input>
                </el-row>
                <el-row v-else>
                    {{form.manufacture}}
                </el-row>
            </el-form-item>
            <el-form-item label="会议地点：" prop="detail">
                <el-row v-if="xiugaiflag">
                    <el-input
                            type="textarea"
                            class="w-250"
                            :autosize="{ minRows: 2, maxRows: 4}"
                            placeholder="请输入内容"
                            v-model="form.detail">
                    </el-input>
                </el-row>
                <el-row v-else>
                    {{form.detail}}
                </el-row>
            </el-form-item>
            <!--<span>-->
                    <!--<router-link :to="{ name: 'searchEdit', params: { id: scope.row.id }}" class="btn-link edit-btn">-->
                        <!--编辑-->
                    <!--</router-link>-->
            <!--</span>-->
                &emsp;&emsp;
                    <router-link :to="{ name: 'searchSit', params: { menuid: item.id }}" class="btn-link-large add-btn">
                        员工名单
                    </router-link>
                &emsp;
                <el-button @click="goback">返回</el-button>

        </el-form>
        <preview ref="preview" :url="propsImg"></preview>
        <zujieList ref="zujieList" :eqp_id="id"></zujieList>
        <br>
        <br>
        <situationList ref="situationList" :eqp_id="id"></situationList>
        <!--<vue-q-art :config="config" :downloadButton="downloadButton"></vue-q-art>-->


    </div>
</template>
<script>
    import zujieList from './zujie.vue'
    import situationList from './situation.vue'
    import http from '../../../assets/js/http'
    import fomrMixin from '../../../assets/js/form_com'
    import preview from '../../Common/preview.vue'
    import  QRcode from 'qrcodejs2'
    import QrcodeVue from 'qrcode.vue'


    export default {
        data() {
            return {
                value: 'http://www.kangyuzhe.com',
                size: 300,
                item:[],
                //qrcode:'',
                // config: {
                //     value: 'https://www.baidu.com',
                //     imagePath: './examples/assets/logo.png',
                //     filter: 'color'
                // },
                // downloadButton: false,
                picture: '../../../static/logo.png',
                isLoading: false,
                id: null,
                form: {},
                xiugaiflag: false,
                zujieVisible: false,
                rules: {
                    name: [
                        { required: true, message: '请输入会议名称', trigger: 'blur' }
                    ]
                }
            }
        },
        methods: {
            edit(form) {
                this.$refs[form].validate((valid) => {
                    if (valid) {
                        this.isLoading = !this.isLoading
                        this.apiPut('admin/eqptype/', this.form.id, this.form).then((res) => {
                            console.log('编辑内容')
                            console.log(res)
                            this.handelResponse(res, (data) => {
                                _g.toastMsg('success', '编辑成功')
                                setTimeout(() => {
                                    this.goback()
                                }, 1500)
                            }, () => {
                                this.isLoading = !this.isLoading
                            })
                        })
                    }
                })
            },
            xiugai() {
                this.xiugaiflag = true
            },
            getzjlist() {
                this.$refs.zujieList.open()
            },
            getwxlist() {
                console.log('weixiulist')
            },
            getPosInfo() {
                let data = {}
                data.id = this.$route.params.id
                this.id = this.$route.params.id
                this.apiPost('admin/eqptype/findDetail', data).then((res) => {
                    this.handelResponse(res, (data) => {
                        this.form = data
                        console.log('设备详细信息')
                        console.log(data)
                    })
                })
            }
        },
        mounted () {

        },
        created() {
            this.getPosInfo()
            //this.qrcode()
        },
        computed: {
            updateShow() {
                return _g.getHasRule('eqptype-update')
            },
            selectrbShow() {
                return _g.getHasRule('eqptype-selectrb')
            },
            selectwbShow() {
                return _g.getHasRule('eqptype-selectwb')
            }
        },
        components: {
            zujieList,
            situationList,
            preview,
            QRcode,
            QrcodeVue
        },
        mixins: [http, fomrMixin]
    }
</script>
