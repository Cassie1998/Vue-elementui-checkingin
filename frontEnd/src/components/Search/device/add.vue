<template>
    <div class="m-l-50 m-t-30 w-900">
        <el-form ref="form" :model="form" :rules="rules" label-width="130px">
            <el-row :gutter="10">
                <el-col :span="10">
                    <el-form-item label="会议名称：" prop="name">
                        <el-input v-model.trim="form.name" class="h-40 w-200"></el-input>
                    </el-form-item>
                    <!--<el-form-item label="会议id：" prop="menuid">-->
                        <!--<el-input v-model.trim="form.menuid" class="h-40 w-200"></el-input>-->
                    <!--</el-form-item>-->
                    <el-form-item label="会议日期：" prop="price">
                        <el-input v-model.trim="form.price" class="h-40 w-200"></el-input>
                    </el-form-item>
                    <el-form-item label="会议时间：" prop="model">
                        <el-input v-model.trim="form.model" class="h-40 w-200"></el-input>
                    </el-form-item>
                    <el-form-item label="会议地点：" prop="detail">
                        <el-input
                                type="textarea"
                                class="w-200"
                                :autosize="{ minRows: 4, maxRows: 4}"
                                placeholder="请输入地点"
                                v-model="form.detail">
                        </el-input>
                    </el-form-item>
                    <el-form-item label="参与部门：" prop="brand">
                        <div class="bor-gray h-400 ovf-y-auto bor-ra-5 bg-wh">
                            <div v-for="item in nodes">
                                <div class="bor-b-ccc bg-gra p-l-10 p-r-10">
                                    <el-checkbox v-model="item.check" @change="selectProjectRule(item)">{{item.else}}</el-checkbox>
                                </div>
                            </div>
                        </div>
                        <!--<el-input v-model.trim="form.brand" class="h-40 w-200"></el-input>-->
                    </el-form-item>
                    <el-form-item label="参与职位：" prop="manufacture">
                        <div class="bor-gray h-200 ovf-y-auto bor-ra-5 bg-wh">
                            <div v-for="item in node1s">
                                <div class="bor-b-ccc bg-gra p-l-10 p-r-10">
                                    <el-checkbox v-model="item.check" @change="selectProjectRule1(item)">{{item.name}}</el-checkbox>
                                </div>
                            </div>
                        </div>
                        <!--<el-input v-model.trim="form.manufacture" class="h-40 w-200"></el-input>-->
                    </el-form-item>
                </el-col>
            </el-row>
            <el-form-item>
                <el-button type="primary" @click="add('form')" :loading="isLoading">提交</el-button>
                <el-button @click="goback()">返回</el-button>
            </el-form-item>
        </el-form>
        <preview ref="preview" :url="propsImg"></preview>
    </div>
</template>
<script>
    import http from '../../../assets/js/http'
    import fomrMixin from '../../../assets/js/form_com'
    import preview from '../../Common/preview.vue'

    export default {
        data() {
            return {
                isLoading: false,
                fileList: [],
                propsImg: '',
                uploadUrl: '',
                form: {
                    menuid:90,
                    name: '',
                    status: 0,
                    price: '',
                    model: '',
                    brand: '',
                    manufacture: '',
                    detail: '',
                    retailer:'',
                    target:'',
                    imgurllist: []
                },
                nodes: [],
                node1s:[],
                selectedindexs:[],
                selectedindex1s:[],
                selectedNodes: [],
                selectedNode1s: [],
                rules: {
                    name: [
                        { required: true, message: '请输入设备名称', trigger: 'blur' }
                    ]
                }
            }
        },
        methods: {
            add(form) {
                console.log('in add')

                this.form.retailer = this.selectedindexs.toString()
                this.form.target = this.selectedindex1s.toString()
                this.form.brand = this.selectedNodes.toString()
                this.form.manufacture = this.selectedNode1s.toString()
                console.log(this.form)
                this.$refs[form].validate((valid) => {
                    if (valid) {
                        this.isLoading = !this.isLoading
                        this.apiPost('admin/eqptype', this.form).then((res) => {
                            console.log(res)
                            this.handelResponse(res, (data) => {
                                _g.toastMsg('success', '添加成功')
                                setTimeout(() => {
                                    this.goback()
                                }, 1500)
                            }, () => {
                                this.isLoading = !this.isLoading
                            })
                        })
                        // this.apiPut('admin/eqptype/WriteQian', this.form.structure_id).then((res) => {
                        //     console.log(res)
                        //     this.handelResponse(res, (data) => {
                        //         _g.toastMsg('success', '添加成功')
                        //         setTimeout(() => {
                        //             this.goback()
                        //         }, 1500)
                        //     }, () => {
                        //         this.isLoading = !this.isLoading
                        //     })
                        // })
                    }
                })
            },
            getRules() {
                this.apiGet('admin/structures').then((res) => {
                    this.handelResponse(res, (data) => {
                        this.nodes = this.nodes.concat(data)
                        console.log(this.nodes)
                    })
                })
            },
            getRule1s() {
                this.apiGet('admin/posts').then((res) => {
                    this.handelResponse(res, (data) => {
                        this.node1s = this.node1s.concat(data)
                        console.log(this.node1s)
                    })
                })
            },
            selectProjectRule(item) {
                if (!item.check) {
                    _(item.child).forEach((res) => {
                        res.check = false
                        let name = _(this.selectedNodes).indexOf(res.name)
                        let index = _(this.selectedindexs).indexOf(res.id)
                        this.selectedNodes.splice(name, 1)
                        this.selectedindexs.splice(index, 1)
                        _(res.child).forEach((res1) => {
                            res1.check = false
                            let name = _(this.selectedNodes).indexOf(res1.name)
                            let index = _(this.selectedindexs).indexOf(res1.id)
                            this.selectedNodes.splice(name, 1)
                            this.selectedindexs.splice(index, 1)
                        })
                    })
                }
                this.selectRule(item)
            },
            selectProjectRule1(item) {
                if (!item.check) {
                    _(item.child).forEach((res) => {
                        res.check = false
                        let name = _(this.selectedNode1s).indexOf(res.name)
                        let index = _(this.selectedindex1s).indexOf(res.id)
                        this.selectedNode1s.splice(name, 1)
                        this.selectedindex1s.splice(index, 1)
                        _(res.child).forEach((res1) => {
                            res1.check = false
                            let name = _(this.selectedNode1s).indexOf(res1.name)
                            let index = _(this.selectedindex1s).indexOf(res1.name)
                            this.selectedNode1s.splice(name, 1)
                            this.selectedindex1s.splice(index, 1)
                        })
                    })
                }
                this.selectRule1(item)
                // this.selectstr(item)
            },
            selectRule(item) {
                if (item.check) {
                    this.selectedNodes.push(item.name)
                    this.selectedindexs.push(item.id)
                } else {
                    const name = _(this.selectedNodes).indexOf(item.name)
                    const index = _(this.selectedindexs).indexOf(item.id)
                    this.selectedNodes.splice(name, 1)
                    this.selectedindexs.splice(index, 1)
                }
            },
            // selectstr(item) {
            //     if (item.check) {
            //         this.selectedNodes.push(item.name)
            //     } else {
            //         const index = _(this.selectedNodes).indexOf(item.name)
            //         this.selectedNodes.splice(index, 1)
            //     }
            // },
            selectRule1(item) {
                if (item.check) {
                    this.selectedNode1s.push(item.name)
                    this.selectedindex1s.push(item.id)
                } else {
                    const name = _(this.selectedNode1s).indexOf(item.name)
                    const index = _(this.selectedindex1s).indexOf(item.id)
                    this.selectedNode1s.splice(name, 1)
                    this.selectedindex1s.splice(index, 1)
                }
            },
            uploadSuccess(res, file, fileList) {
                console.log(res)
                console.log(file)
                console.log(fileList)
                this.form.imgurllist.push(window.HOST + res.data)
            },
            uploadFail(err, res, file) {
                console.log('err = ', _g.j2s(err))
                console.log('res = ', _g.j2s(res))
            },
            handleRemove(file, fileList) {
                console.log('file = ', file)
                console.log('fileList = ', fileList)
            },
            viewPic(file) {
                this.propsImg = file.url
                this.$refs.preview.open()
            }
        },
        created() {
            this.getRules()
            this.getRule1s()
            _g.closeGlobalLoading()
            this.uploadUrl = window.HOST + 'admin/Upload'
            this.form.menuid = this.$route.params.menuid
        },
        components: {
            preview
        },
        mixins: [http, fomrMixin]
    }
</script>
