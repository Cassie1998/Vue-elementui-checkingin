<template>
  <div class="m-l-50 m-t-30 w-900">
	<el-form ref="form" :model="form" :rules="rules" label-width="130px">
	  <!--<el-form-item label="设备图片">
		<!--el-upload
		:action="uploadUrl"
		type="drag"
		:thumbnail-mode="true"
		:on-preview="viewPic"
		:on-remove="handleRemove"
		:on-success="uploadSuccess"
		:on-error="uploadFail"
		:default-file-list="fileList">
			<i class="el-icon-upload"></i>
			<div class="el-dragger__text">将文件拖到此处，或<em>点击上传</em></div>
			<div class="el-upload__tip" slot="tip">只能上传jpg/png文件</div>
		</el-upload>
	    <el-input v-model.trim="form.pictrue" class="h-40 w-200"></el-input>
	  </el-form-item>-->
	  <el-form-item label="会议名称：" prop="name">
		<el-input v-model.trim="form.name" class="h-40 w-200"></el-input>
	  </el-form-item>
	  <el-form-item label="会议时间：" prop="model">
		<el-input v-model.trim.number="form.price" class="h-40 w-200"></el-input>
	  </el-form-item>
	  <el-form-item label="会议地点：" prop="detail">
		<el-input v-model.trim="form.model" class="h-40 w-200"></el-input>
	  </el-form-item>
	  <el-form-item label="参与部门：" prop="brand">
          <div class="bor-gray h-200 ovf-y-auto bor-ra-5 bg-wh">
              <div v-for="item in nodes">
                  <div class="bor-b-ccc bg-gra p-l-10 p-r-10">
                      <el-checkbox v-model="item.check" @change="selectProjectRule(item)">{{item.else}}</el-checkbox>
                  </div>
                  <div v-for="childItem in item.child">
                      <div class="p-l-20 bor-b-ccc">
                          <el-checkbox v-model="childItem.check" @change="selectModuleRule(childItem, item, childItem.child)">{{childItem.else}}</el-checkbox>
                      </div>
                      <div class="p-l-40 bor-b-ccc bg-gra">
                          <el-checkbox v-for="grandChildItem in childItem.child" v-model="grandChildItem.check" @change="selectActionRule(grandChildItem, childItem, item)">{{grandChildItem.else}}</el-checkbox>
                      </div>
                  </div>
              </div>
          </div>
	  </el-form-item>
	  <el-form-item label="参与职位：" prop="manufacture">
          <div class="bor-gray h-200 ovf-y-auto bor-ra-5 bg-wh">
              <div v-for="item in nodes">
                  <div class="bor-b-ccc bg-gra p-l-10 p-r-10">
                      <el-checkbox v-model="item.check" @change="selectProjectRule(item)">{{item.else}}</el-checkbox>
                  </div>
                  <div v-for="childItem in item.child">
                      <div class="p-l-20 bor-b-ccc">
                          <el-checkbox v-model="childItem.check" @change="selectModuleRule(childItem, item, childItem.child)">{{childItem.else}}</el-checkbox>
                      </div>
                      <div class="p-l-40 bor-b-ccc bg-gra">
                          <el-checkbox v-for="grandChildItem in childItem.child" v-model="grandChildItem.check" @change="selectActionRule(grandChildItem, childItem, item)">{{grandChildItem.else}}</el-checkbox>
                      </div>
                  </div>
              </div>
          </div>
	  </el-form-item>
	  <el-form-item>
		<el-button type="primary" @click="add('form')" :loading="isLoading">提交</el-button>
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
        form: {
          title: '',
          pid: '',
          remark: '',
          rules: ''
        },
        options: [{ pid: 0, title: '无' }],
        nodes: [],
        selectedNodes: [],
        rules: {
          title: [
            { required: true, message: '请输入用户组名称', trigger: 'blur' }
          ]
        }
      }
    },
    /* data() {
      return {
        isLoading: false,
        form: {
          menuid: null,
          name: '',
          status: 0,
          time: null,
          place: '',
          brand: '',
          manufacture: '',
          retailer: '',
          target: '',
          detail: '',
          pictrue: '',
          nodes: [],
          selectedNodes: []
        },
        rules: {
          name: [
            { required: true, message: '请输入设备名称', trigger: 'blur' }
          ]
        }
      }
    },*/
    methods: {
      add(form) {
        this.form.rules = this.selectedNodes.toString()
        this.$refs[form].validate((valid) => {
          if (valid) {
            this.isLoading = !this.isLoading
            this.apiPost('admin/groups', this.form).then((res) => {
              this.handelResponse(res, (data) => {
                _g.toastMsg('success', '添加成功')
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
      getRules() {
        this.apiGet('admin/rules?type=tree').then((res) => {
          this.handelResponse(res, (data) => {
            this.nodes = this.nodes.concat(data)
          })
        })
      },
      getGroups() {
        this.apiGet('admin/groups').then((res) => {
          this.handelResponse(res, (data) => {
            this.options = this.options.concat(data)
          })
        })
      },
      selectProjectRule(item) {
        if (!item.check) {
          _(item.child).forEach((res) => {
            res.check = false
            let index = _(this.selectedNodes).indexOf(res.id)
            this.selectedNodes.splice(index, 1)
            _(res.child).forEach((res1) => {
              res1.check = false
              let index = _(this.selectedNodes).indexOf(res1.id)
              this.selectedNodes.splice(index, 1)
            })
          })
        }
        this.selectRule(item)
      },
      selectModuleRule(item, faItem, children) {
        if (!faItem.check) {
          faItem.check = true
          this.selectedNodes.push(faItem.id)
        }
        if (item.check) {
          this.selectedNodes.push(item.id)
          _(children).forEach((res) => {
            res.check = true
            this.selectedNodes.push(res.id)
          })
        } else {
          let index = _(this.selectedNodes).indexOf(item.id)
          this.selectedNodes.splice(index, 1)
          _(children).forEach((res1) => {
            let temp = _(this.selectedNodes).indexOf(res1.id)
            if (temp >= 0) {
              res1.check = false
              this.selectedNodes.splice(temp, 1)
            }
          })
        }
      },
      selectActionRule(item, faItem, grandFaItem) {
        if (!faItem.check) {
          faItem.check = true
          this.selectedNodes.push(faItem.id)
        }
        if (!grandFaItem.check) {
          grandFaItem.check = true
          this.selectedNodes.push(grandFaItem.id)
        }
        this.selectRule(item)
      },
      selectRule(item) {
        if (item.check) {
          this.selectedNodes.push(item.id)
        } else {
          const index = _(this.selectedNodes).indexOf(item.id)
          this.selectedNodes.splice(index, 1)
        }
      }
    },
    /* methods: {

      add(form) {
        this.form.rules = this.selectedNodes.toString()
        console.log('222')
        console.log(form)
        this.$refs[form].validate((valid) => {
          if (valid) {
            this.isLoading = !this.isLoading
            this.apiPost('admin/groups', this.form).then((res) => {
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
          }
        })
      },
      getRules() {
        this.apiGet('admin/rules?type=tree').then((res) => {
          this.handelResponse(res, (data) => {
            this.nodes = this.nodes.concat(data)
          })
        })
      }
    },*/
    created() {
      _g.closeGlobalLoading()
      this.form.menuid = this.$route.params.menuid
    },
    mixins: [http, fomrMixin]
  }
</script>
