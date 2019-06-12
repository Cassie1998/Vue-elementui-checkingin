<template>
  <div class="m-l-50 m-t-30 w-900">
    <el-form ref="form" :model="form" :rules="rules" label-width="130px">
	  <el-form-item label="签到二维码：" prop="pictrue">
        <el-row v-if="xiugaiflag">
		  <el-input v-model.trim="form.pictrue" class="h-40 w-200"></el-input>
	    </el-row>
		<el-row v-else>
          {{form.pictrue}}
		</el-row>
	  </el-form-item>
      <el-form-item label="参与部门：" prop="name">
        <el-row v-if="xiugaiflag">
		  <el-input v-model.trim="form.name" class="h-40 w-200"></el-input>
	    </el-row>
		<el-row v-else>
          {{form.name}}
		</el-row>
	  </el-form-item>
      <el-form-item label="会议时间：" prop="model">
        <el-row v-if="xiugaiflag">
          <el-input v-model.trim="form.model" class="h-40 w-200"></el-input>
	    </el-row>
		<el-row v-else>
	      {{form.model}}
	    </el-row>
      </el-form-item>
      <el-form-item label="品牌：" prop="brand">
        <el-row v-if="xiugaiflag">
          <el-input v-model.trim="form.brand" class="h-40 w-200"></el-input>
	    </el-row>
		<el-row v-else>
	      {{form.brand}}
	    </el-row>
      </el-form-item>
      <el-form-item label="生产厂家：" prop="manufacture">
        <el-row v-if="xiugaiflag">
          <el-input v-model.trim="form.manufacture" class="h-40 w-200"></el-input>
	    </el-row>
		<el-row v-else>
	      {{form.manufacture}}
	    </el-row>
      </el-form-item>
      <el-form-item label="销售商：" prop="retailer">
        <el-row v-if="xiugaiflag">
          <el-input v-model.trim="form.retailer" class="h-40 w-200"></el-input>
	    </el-row>
		<el-row v-else>
	      {{form.retailer}}
	    </el-row>
      </el-form-item>
      <el-form-item label="主要指标：" prop="target">
        <el-row v-if="xiugaiflag">
          <el-input v-model.trim="form.target" class="h-40 w-600"></el-input>
	    </el-row>
		<el-row v-else>
	      {{form.target}}
	    </el-row>
      </el-form-item>
      <el-form-item label="会议地点：" prop="detail">
        <el-row v-if="xiugaiflag">
          <el-input
            type="textarea"
            class="w-200"
            :autosize="{ minRows: 2, maxRows: 4}"
            placeholder="请输入内容"
            v-model="form.detail">
          </el-input>
	    </el-row>
		<el-row v-else>
	      {{form.detail}}
	    </el-row>
      </el-form-item>

      <el-form-item>
        <el-button v-if="xiugaiflag" type="primary" @click="edit('form')" :loading="isLoading">提交</el-button>
        <el-button v-else @click="xiugai">编辑</el-button>
        <el-button @click="goback">返回</el-button>
      </el-form-item>
    </el-form>
	<zujieList ref="zujieList" :eqp_id="id"></zujieList>
  </div>
</template>
<script>
  import zujieList from './zujie.vue'
  import http from '../../../assets/js/http'
  import fomrMixin from '../../../assets/js/form_com'

  export default {
    data() {
      return {
        isLoading: false,
        id: null,
        form: {},
        xiugaiflag: false,
        zujieVisible: false,
        rules: {
          name: [
            { required: true, message: '请输入设备名称', trigger: 'blur' }
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
    created() {
      this.getPosInfo()
    },
    components: {
      zujieList
    },
    mixins: [http, fomrMixin]
  }
</script>
