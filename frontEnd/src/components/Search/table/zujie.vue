<template>
	<el-dialog ref="dialog" custom-class="w-900 h-480 ovf-auto" title="节点列表" :visible.sync="zujieVisible">
		<div class="pos-rel h-60">
			<el-input placeholder="请输入内容" v-model="keyword" class="search-btn w-300">
				<el-button slot="append" icon="search" @click="searchMsg()"></el-button>
			</el-input>
		</div>
		<div>
			<el-table
			:data="tableData"
			stripe
			style="width: 100%">
				<el-table-column
				prop="eqp_id"
				label="设备ID"
				width="100">
				</el-table-column>
				<el-table-column
				prop="user_id"
				label="客户ID"
				width="100">
				</el-table-column>
				<el-table-column
				prop="create_time"
				label="租借时间"
				width="180">
				</el-table-column>
				<el-table-column
				prop="update_time"
				label="归还时间"
				width="180">
				</el-table-column>
				<el-table-column
				prop="remack"
				label="备注">
				</el-table-column>
			</el-table>
		</div>
	</el-dialog>
</template>
<style>
.search-btn {
	position: absolute;
	top: 0px;
	right: 0px;
}
</style>
<script>
  import http from '../../../assets/js/http'

  export default {
    props: ['eqp_id'],
    data() {
      return {
        keyword: '',
        tableData: [],
        zujieVisible: false
      }
    },
    methods: {
      open() {
        this.zujieVisible = true
      },
      closeDialog() {
        this.zujieVisible = false
      },
      selectRule(item) {
        setTimeout(() => {
          this.$parent.form.rule_name = item.title
          this.$parent.form.rule_id = item.id
        }, 0)
        this.closeDialog()
      },
      getZujie() {
        let data = {}
        data.id = this.eqp_id
        console.log('设备租借信息')
        this.apiPost('admin/eqptype/selectRB', data).then((res) => {
          this.handelResponse(res, (data) => {
            this.tableDataShow = _(data).forEach((ret) => {
              var time1 = new Date(ret.create_time * 1000)
              var time2 = new Date(ret.update_time * 1000)
              ret.create_time = this.formatDate(time1)
              ret.update_time = this.formatDate(time2)
              ret.showInput = false
            })
            this.tableData = this.tableDataShow
          })
        })
      },
      formatDate(date) {
        var y = date.getFullYear()
        var m = date.getMonth() + 1
        m = m < 10 ? ('0' + m) : m
        var d = date.getDate()
        d = d < 10 ? ('0' + d) : d
        var h = date.getHours()
        var minute = date.getMinutes()
        minute = minute < 10 ? ('0' + minute) : minute
        var second = date.getSeconds()
        second = minute < 10 ? ('0' + second) : second
        return y + '-' + m + '-' + d + ' ' + h + ':' + minute + ':' + second
      }
    },
    created() {
      this.getZujie()
    },
    mixins: [http]
  }
</script>