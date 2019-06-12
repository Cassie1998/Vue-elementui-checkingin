<template>
  <div class="m-l-50 m-t-30 w-900">
    <el-form ref="form" :model="form" :rules="rules" label-width="130px">
      <el-form-item label="名称" prop="name">
        <el-input v-model.trim="form.name" class="h-40 w-200"></el-input>
      </el-form-item>
      <el-form-item label="类型" prop="model">
        <el-input v-model.trim="form.model" class="h-40 w-200"></el-input>
      </el-form-item>
      <el-form-item label="品牌" prop="brand">
        <el-input v-model.trim="form.brand" class="h-40 w-200"></el-input>
      </el-form-item>
      <el-form-item label="生产厂家" prop="manufacture">
        <el-input v-model.trim="form.manufacture" class="h-40 w-200"></el-input>
      </el-form-item>
      <el-form-item label="销售商" prop="retailer">
        <el-input v-model.trim="form.retailer" class="h-40 w-200"></el-input>
      </el-form-item>
      <el-form-item label="主要指标" prop="target">
        <el-input v-model.trim="form.target" class="h-40 w-600"></el-input>
      </el-form-item>
      <el-form-item label="设备简介" prop="detail">
        <el-input
          type="textarea"
          class="w-200"
          :autosize="{ minRows: 2, maxRows: 4}"
          placeholder="请输入内容"
          v-model="form.detail">
        </el-input>
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="edit('form')" :loading="isLoading">提交</el-button>
        <el-button @click="goback()">返回</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>
<script>
  import http from '../../../assets/js/http'
  import fomrMixin from '../../../assets/js/form_com'

  export default {
    data() {
      return {
        isLoading: false,
        id: null,
        form: {},
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
            this.apiPut('admin/posts/', this.form.id, this.form).then((res) => {
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
      getPosInfo() {
        let data = {}
        data.id = this.$route.params.id
        this.apiPost('admin/eqptype/findDetail', data).then((res) => {
          this.handelResponse(res, (data) => {
            this.form = data
            console.log(data)
          })
        })
      }
    },
    created() {
      this.getPosInfo()
    },
    mixins: [http, fomrMixin]
  }
</script>