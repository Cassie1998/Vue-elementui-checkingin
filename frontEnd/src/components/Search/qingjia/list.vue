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
                    prop="realname"
                    label="员工姓名"
                    width="150">
            </el-table-column>
            <el-table-column
                    label="员工ID"
                    prop="username"
                    width="200">
            </el-table-column>
            <el-table-column
                    prop="s_name"
                    label="部门"
                    width="220">
            </el-table-column>
            <el-table-column
                    label="职位"
                    prop="p_name"
                    width="200">
            </el-table-column>
            <el-table-column
                    label="状态"
                    width="100">
                <template scope="scope">
                    <div>
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
								<el-button
                                        size="small"
                                        @click="get_thisdevice(scope.row)">
								批准
								</el-button>
						</span>
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
        data() {
            return {
                tableData: [],
                dataCount: null,
                currentPage: null,
                keywords: '',
                limit: 15
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
            get_thisdevice(item) {
                let data = {}
                data.id = item.id
                data.userId = Lockr.get('userInfo').id
                this.$confirm('确认批准该用户请假?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    _g.openGlobalLoading()
                    this.apiPost('admin/users/rent', data).then((res) => {
                        _g.closeGlobalLoading()
                        this.handelResponse(res, (data) => {
                            _g.toastMsg('success', '会议开始')
                            setTimeout(() => {
                                _g.shallowRefresh(this.$route.name)
                            }, 1500)
                        })
                    })
                }).catch(() => {
                })
            },
            confirmDelete(item) {
                this.$confirm('确认删除该用户?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    _g.openGlobalLoading()
                    this.apiDelete('admin/users/', item.id).then((res) => {
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
            getAllUsers() {
                this.loading = true
                let data = {}
                // const data = {
                //     params: {
                //         keywords: this.keywords,
                //         page: this.currentPage,
                //         limit: this.limit
                //     }
                // }
                // console.log(params)
                if (this.item) {
                    data.id = this.item.id
                } else {
                    data.id = 0
                }
                this.apiGet('admin/users', { params: data }).then((res) => {
                    // console.log('res = ', _g.j2s(res))
                    this.handelResponse(res, (data) => {
                        this.tableData = data.list
                        this.dataCount = data.dataCount
                        // console.log('123'+data.list)
                        // console.log('456'+this.dataCount)
                    })
                })
            },
            // getCurrentPage() {
            //     let data = this.$route.query
            //     console.log(data)
            //     if (data) {
            //         if (data.page) {
            //             this.currentPage = parseInt(data.page)
            //         } else {
            //             this.currentPage = 1
            //         }
            //     }
            // },
            // getKeywords() {
            //     let data = this.$route.query
            //     console.log(data)
            //     if (data) {
            //         if (data.keywords) {
            //             this.keywords = data.keywords
            //         } else {
            //             this.keywords = ''
            //         }
            //     }
            // },
            init() {
                // this.getKeywords()
                // this.getCurrentPage()
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
        components: {

        },
        mixins: [http]
    }
</script>
