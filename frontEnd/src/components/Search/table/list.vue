<!--<template>-->
	<!--<div>-->
		<!--<el-table-->
				<!--:data="tableData"-->
				<!--style="width: 100%"-->
				<!--@selection-change="selectItem">-->
			<!--<el-table-column-->
					<!--type="selection"-->
					<!--width="50">-->
			<!--</el-table-column>-->
			<!--<el-table-column-->
					<!--label="会议名称"-->
					<!--prop="name"-->
					<!--width="150">-->
			<!--</el-table-column>-->
			<!--<el-table-column-->
					<!--label="会议日期"-->
					<!--prop="price"-->
					<!--width="150">-->
			<!--</el-table-column>-->
			<!--<el-table-column-->
					<!--label="会议时间"-->
					<!--prop="model"-->
					<!--width="100">-->
			<!--</el-table-column>-->
			<!--<el-table-column-->
					<!--label="会议地点"-->
					<!--prop="detail">-->
			<!--</el-table-column>-->
			<!--<el-table-column-->
					<!--label="参与部门"-->
					<!--prop="brand">-->
			<!--</el-table-column>-->
			<!--<el-table-column-->
					<!--label="会议状态"-->
					<!--prop="status"-->
					<!--width="100">-->
				<!--<template scope="scope">-->
					<!--<div>-->
						<!--{{ scope.row.status | devicestatus }}-->
					<!--</div>-->
				<!--</template>-->
			<!--</el-table-column>-->
			<!--<el-table-column-->
					<!--label="操作"-->
					<!--width="270">-->
				<!--<template scope="scope">-->
					<!--<div>-->

						<!--<span>-->
								<!--<el-button-->
										<!--size="small"-->
										<!--type="danger"-->
										<!--@click="confirmDelete(scope.row)">-->
								<!--删除-->
								<!--</el-button>-->
							<!--</span>-->
					<!--</div>-->
				<!--</template>-->
			<!--</el-table-column>-->
		<!--</el-table>-->
		<!--<div class="pos-rel p-t-20">-->
			<!--<btnGroup :selectedData="multipleSelection" :type="'eqptype'"></btnGroup>-->
		<!--</div>-->
	<!--</div>-->
<!--</template>-->

<!--<script>-->
    <!--import btnGroup from '../../Common/btn-group-device.vue'-->
    <!--import http from '../../../assets/js/http'-->

    <!--export default {-->
        <!--data() {-->
            <!--return {-->
                <!--tableData: [],-->
                <!--multipleSelection: [],-->
                <!--item: []-->
            <!--}-->
        <!--},-->
        <!--methods: {-->

            <!--selectItem(val) {-->
                <!--this.multipleSelection = val-->
            <!--},-->
            <!--confirmDelete(item) {-->
                <!--this.$confirm('确认删除该会议记录?', '提示', {-->
                    <!--confirmButtonText: '确定',-->
                    <!--cancelButtonText: '取消',-->
                    <!--type: 'warning'-->
                <!--}).then(() => {-->
                    <!--_g.openGlobalLoading()-->
                    <!--this.apiDelete('admin/eqptype/', item.id).then((res) => {-->
                        <!--_g.closeGlobalLoading()-->
                        <!--this.handelResponse(res, (data) => {-->
                            <!--_g.toastMsg('success', '删除成功')-->
                            <!--setTimeout(() => {-->
                                <!--_g.shallowRefresh(this.$route.name)-->
                            <!--}, 1500)-->
                        <!--})-->
                    <!--})-->
                <!--}).catch(() => {-->
                <!--})-->
            <!--},-->
            <!--getPositions() {-->
                <!--let data = {}-->
                <!--if (this.item) {-->
                    <!--data.menuid = '70'-->
					<!--console.log(data.menuid)-->
                <!--} else {-->
                    <!--data.menuid = 0-->
                <!--}-->
                <!--this.apiGet('admin/eqptype', { params: data }).then((res) => {-->
                    <!--this.handelResponse(res, (data) => {-->
                        <!--this.tableData = data-->
                        <!--console.log(this.tableData)-->
                    <!--})-->
                <!--})-->
            <!--}-->
        <!--},-->
        <!--created() {-->
            <!--console.log('in device')-->
            <!--if (this.$route.params.item) {-->
                <!--this.item = this.$route.params.item-->
            <!--} else if (Lockr.get('deviceitem')) {-->
                <!--this.item = Lockr.get('deviceitem')-->
            <!--} else if (this.$route.query.menu) {-->
                <!--this.item = this.$route.query.menu.child[0].child[0]-->
                <!--Lockr.set('deviceitem', this.$route.query.menu.child[0].child[0])-->
            <!--}-->
            <!--this.getPositions()-->
        <!--},-->
        <!--computed: {-->
            <!--addShow() {-->
                <!--return _g.getHasRule('posts-save')-->
            <!--},-->
            <!--editShow() {-->
                <!--return _g.getHasRule('posts-update')-->
            <!--},-->
            <!--deleteShow() {-->
                <!--return _g.getHasRule('posts-delete')-->
            <!--}-->
        <!--},-->
        <!--components: {-->
            <!--btnGroup-->
        <!--},-->
        <!--mixins: [http]-->
    <!--}-->
<!--</script>-->


<template>
	<div>
		<!--<div class="w-100p h-50 p-l-40 left-menu pointer c-blue">-->
			<!--<el-form-item>-->
				<!--已发起会议-->
			<!--</el-form-item>-->
		<!--</div>-->
		<el-container>
			<el-header class="w-100p h-50 p-l-40 left-menu pointer c-gra">已发起会议</el-header>

		</el-container>
		<el-table
		:data="tableData"
		style="width: 100%"
		@selection-change="selectItem">
			<el-table-column
			type="selection"
			width="50">
			</el-table-column>
			<el-table-column
			label="会议名称"
			prop="name"
			width="150">
			</el-table-column>
			<el-table-column
			label="会议日期"
			prop="price"
			width="150">
			</el-table-column>
			<el-table-column
			label="会议时间"
			prop="model"
			width="150">
			</el-table-column>
			<el-table-column
			label="会议地点"
			prop="detail"
			width="200">
			</el-table-column>
			<el-table-column
			label="参与部门"
			prop="brand"
			width="200">
			</el-table-column>
			<el-table-column
			label="会议状态"
			prop="status"
			width="100">
				<template scope="scope">
				  <div>
					{{ scope.row.status | devicestatus }}
				  </div>
				</template>
			</el-table-column>
			<el-table-column
			label="操作">
				<template scope="scope">
						<div>
							<span>
								<el-button
								size="small"
								type="danger"
								@click="confirmDelete(scope.row)">
								删除
								</el-button>
							</span>
						</div>
				</template>
			</el-table-column>
		</el-table>
		<div class="pos-rel p-t-20">
			<btnGroup1 :selectedData="multipleSelection" :type="'eqptype'"></btnGroup1>
		</div>
	</div>
</template>

<script>
  import btnGroup1 from '../../Common/btn-group-table.vue'
  import http from '../../../assets/js/http'

  export default {
    data() {
      return {
        tableData: [],
        multipleSelection: [],
        item: []
      }
    },
    methods: {
      selectItem(val) {
        this.multipleSelection = val
      },
      get_thisdevice(item) {
        let data = {}
        data.id = item.id
        data.userId = Lockr.get('userInfo').id
        this.$confirm('确认开始会议?', '提示', {
          confirmButtonText: '确定',
          cancelButtonText: '取消',
          type: 'warning'
        }).then(() => {
          _g.openGlobalLoading()
          this.apiPost('admin/eqptype/rent', data).then((res) => {
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
      put_thisdevice(item) {
        let data = {}
        data.id = item.id
        data.userId = Lockr.get('userInfo').id
        this.$confirm('确认结束会议?', '提示', {
          confirmButtonText: '确定',
          cancelButtonText: '取消',
          type: 'warning'
        }).then(() => {
          _g.openGlobalLoading()
          this.apiPost('admin/eqptype/giveback', data).then((res) => {
            _g.closeGlobalLoading()
            this.handelResponse(res, (data) => {
              _g.toastMsg('success', '会议结束')
              setTimeout(() => {
                _g.shallowRefresh(this.$route.name)
              }, 1500)
            })
          })
        }).catch(() => {
        })
      },
      confirmDelete(item) {
        this.$confirm('确认删除该会议记录?', '提示', {
          confirmButtonText: '确定',
          cancelButtonText: '取消',
          type: 'warning'
        }).then(() => {
          _g.openGlobalLoading()
          this.apiDelete('admin/eqptype/', item.id).then((res) => {
            _g.closeGlobalLoading()
            this.handelResponse(res, (data) => {
              _g.toastMsg('success', '删除成功')
              setTimeout(() => {
                _g.shallowRefresh(this.$route.name)
              }, 1500)
            })
          })
        }).catch(() => {
        })
      },
      getPositions() {
        let data = {}
        if (this.item) {
          data.menuid = '70'
        } else {
          data.menuid = 0
        }
        this.apiGet('admin/eqptype', { params: data }).then((res) => {
          this.handelResponse(res, (data) => {
            this.tableData = data
          })
        })
      }
    },
    created() {
      console.log('in table')
      if (this.$route.params.item) {
        this.item = this.$route.params.item
      } else if (Lockr.get('tableitem')) {
        this.item = Lockr.get('tableitem')
      } else if (this.$route.query.menu) {
        this.item = this.$route.query.menu.child[0].child[0]
        Lockr.set('tableitem', this.$route.query.menu.child[0].child[0])
      }
      this.getPositions()
    },
    computed: {
      addShow() {
        return _g.getHasRule('posts-save')
      },
      editShow() {
        return _g.getHasRule('posts-update')
      },
      deleteShow() {
        return _g.getHasRule('posts-delete')
      }
    },
    components: {
      btnGroup1
    },
    mixins: [http]
  }
</script>
