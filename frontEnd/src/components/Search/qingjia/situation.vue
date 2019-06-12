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
                    label="会议名称"
                    prop="name"
                    width="150">
            </el-table-column>
            <el-table-column
                    label="会议日期"
                    prop="price"
                    width="110">
            </el-table-column>
            <el-table-column
                    label="会议时间"
                    prop="model"
                    width="100">
            </el-table-column>
            <el-table-column
                    label="会议地点"
                    prop="detail"
                    width="150">
            </el-table-column>
            <el-table-column
                    label="请假情况"
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
    export default {
        name: "qingjiasituation"
    }
</script>

<style scoped>

</style>
