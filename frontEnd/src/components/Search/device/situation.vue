<template>
    <div>
        <el-table
                :data="tableData"
                style="width: 100%"
                @selection-change="selectItem">
            <el-table-column
                    type="selection"
                    width="50">
            </el-table-column>
            <el-table-column
                prop="id"
                label="会议id"
                width="100">
            </el-table-column>
            <el-table-column
                    prop="realname"
                    label="员工姓名"
                    width="100">
            </el-table-column>
            <el-table-column
                    label="员工id"
                    prop="user_id"
                    width="150">
            </el-table-column>
            <el-table-column
                    prop="s_name"
                    label="部门"
                    width="150">
            </el-table-column>
            <el-table-column
                    label="职位id"
                    prop="post_id"
                    width="100">
            </el-table-column>
            <el-table-column
                    label="状态"
                    width="100">
                <template scope="scope">
                    <div>
                        {{status}}
                        {{ scope.row.status | status }}
                    </div>
                </template>
            </el-table-column>
            <el-table-column
                    label="操作">
                <template scope="scope">
                    <div>
            <!--<span>-->
              <!--<router-link :to="{ name: 'usersEdit', params: { id: scope.row.id }}" class="btn-link edit-btn">-->
            <!--编辑-->
              <!--</router-link>-->
            <!--</span>-->
                        <span>
              <el-button size="small" type="danger" @click="confirmDelete(scope.row)">删除</el-button>
            </span>
                    </div>
                </template>
            </el-table-column>
        </el-table>
        <br>
        <el-button @click="goback">返回</el-button>

    </div>
</template>

<script>
    import http from '../../../assets/js/http'

    export default {
        props: ['eqp_id'],
        data() {
            return {
                tableData: [],
                currentPage: null,
                keywords: '',
                limit: 15
                // form: {}
                // tableData1:[],
                // item:[]
            }
        },
        methods: {
            goback() {
                router.go(-1)
            },
            search() {
                router.push({ path: this.$route.path, query: { keywords: this.keywords, page: 1 }})
            },
            selectItem(val) {
                this.multipleSelection = val
            },
            handleCurrentChange(page) {
                router.push({ path: this.$route.path, query: { keywords: this.keywords, page: page }})
            },
            confirmDelete(item) {
                this.$confirm('确认删除该用户?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    _g.openGlobalLoading()
                    this.apiDelete('admin/qiandaos/', item.id).then((res) => {
                        _g.closeGlobalLoading()
                        this.handelResponse(res, (data) => {
                            _g.toastMsg('success', '删除成功')
                            setTimeout(() => {
                                _g.shallowRefresh(this.$route.name)
                            }, 1500)
                        })
                    })
                }).catch(() => {
                    // catch error
                })
            },
            // getid() {
            //     let data = {}
            //     data.id=this.eqp_id
            //     console.log(data.id)
            //     this.apiPost('admin/eqptype/findDetail', data).then((res) => {
            //         this.handelResponse(res, (data) => {
            //             this.form = data
            //             console.log('设备详细信息')
            //             console.log(data)
            //         })
            //     })
            // },
            getAllUsers() {
                this.loading = true
                let data = {}
                data.id = this.eqp_id
                 //console.log(data)
                // if (this.item) {
                //     data.id = this.eqp_id
                //     //console.log(this.item.id)
                //     //console.log('maybe'+data.id)
                // } else {
                //     data.id = 0
                // }
                this.apiGet('admin/qiandaos', { params: data }).then((res) => {
                     //console.log('res = ', _g.j2s(res))
                    this.handelResponse(res, (data) => {
                        this.tableData = data.list
                        console.log('111')
                        console.log(this.tableData)
                         //console.log(this.tableData)
                        // console.log('456'+this.dataCount)
                    })
                })
            },
            init() {
                // this.getKeywords()
                // this.getCurrentPage()
                // this.getid()
                this.getAllUsers()

            }
        },
        created() {
            this.init()
        },
        computed: {
            addShow() {
                return _g.getHasRule('users-save')
            },
            editShow() {
                return _g.getHasRule('users-update')
            },
            deleteShow() {
                return _g.getHasRule('users-delete')
            }
        },
        watch: {
            '$route' (to, from) {
                this.init()
            }
        },
        mixins: [http]
    }
</script>

