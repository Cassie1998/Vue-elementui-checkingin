<template>
    <div class="m-l-50 m-t-30 w-900">

        <el-form-item label="权限分配">
            <div class="bor-gray h-400 ovf-y-auto bor-ra-5 bg-wh">
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

    </div>
</template>
<script>
    import http from '../../assets/js/http'
    import fomrMixin from '../../assets/js/form_com'

    export default {
        data() {
            return {
                nodes: [],
                selectedNodes: [],
            }
        },
        methods: {
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
        created() {
            this.getRules()
            this.getGroups()
        },
        mixins: [http, fomrMixin]
    }
</script>
