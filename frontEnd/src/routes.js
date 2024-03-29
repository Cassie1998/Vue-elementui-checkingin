import Login from './components/Account/Login.vue'
import Sign from './components/Sign.vue'
import refresh from './components/refresh.vue'
import Home from './components/Home.vue'
import Qiansuccess from './components/Qiansuccess.vue'
import Main from './components/Main.vue'// 大洋设备根目录
import searchDevice from './components/Search/device/list.vue'// 大洋设备二级目录
import searchAdd from './components/Search/device/add.vue'// 大洋设备增加路由
import searchEdit from './components/Search/device/edit.vue'// 大洋设备个体列表
import searchSit from './components/Search/device/situation.vue'// 大洋设备个体列表
import searchQing from './components/Search/qingjia/list.vue'
import searchQingsit from './components/Search/qingjia/situation.vue'
import searchTable from './components/Search/table/list.vue'
import searchAdd1 from './components/Search/table/add.vue'
import searchEdit1 from './components/Search/table/edit.vue'
import menuList from './components/Administrative/system/menu/list.vue'
import menuAdd from './components/Administrative/system/menu/add.vue'
import menuEdit from './components/Administrative/system/menu/edit.vue'
import demoDemo from './components/Administrative/system/demo/demo.vue'// 测试用路由
import systemConfig from './components/Administrative/system/config/add.vue'
import ruleList from './components/Administrative/system/rule/list.vue'
import ruleAdd from './components/Administrative/system/rule/add.vue'
import ruleEdit from './components/Administrative/system/rule/edit.vue'
import positionList from './components/Administrative/structures/position/list.vue'
import positionAdd from './components/Administrative/structures/position/add.vue'
import positionEdit from './components/Administrative/structures/position/edit.vue'
import structuresList from './components/Administrative/structures/structures/list.vue'
import structuresAdd from './components/Administrative/structures/structures/add.vue'
import structuresEdit from './components/Administrative/structures/structures/edit.vue'
import groupsList from './components/Administrative/structures/groups/list.vue'
import groupsAdd from './components/Administrative/structures/groups/add.vue'
import groupsEdit from './components/Administrative/structures/groups/edit.vue'
import usersList from './components/Administrative/personnel/users/list.vue'
import usersAdd from './components/Administrative/personnel/users/add.vue'
import usersEdit from './components/Administrative/personnel/users/edit.vue'

/**
 * meta参数解析
 * hideLeft: 是否隐藏左侧菜单，单页菜单为true
 * module: 菜单所属模块
 * menu: 所属菜单，用于判断三级菜单是否显示高亮，如菜单列表、添加菜单、编辑菜单都是'menu'，用户列表、添加用户、编辑用户都是'user'，如此类推
 */

const routes = [
  { path: '/', component: Login, name: 'Login' },
  // { path: '/', component: Sign, name: 'Sign' },
  {
    path: '/home',
    component: Home,
    children: [
      { path: '/refresh', component: refresh, name: 'refresh' }
    ]
  },
  {
    path: '/sign',
    component: Sign,
    children: [
      { path: '/refresh', component: refresh, name: 'refresh' }
    ]
  },
  {
     path: '/Qiansuccess',
     component: Qiansuccess,
     children: [
      { path: '/refresh', component: refresh, name: 'refresh' }
     ]
  },
  {
    path: '/home',
    component: Home,
    children: [
      { path: 'search/device', component: searchDevice, name: 'searchDevice', meta: { hideLeft: false, module: 'Search', menu: 'search',url:'device' }},
      { path: 'search/device/:name', component: searchDevice, name: 'searchDevice', meta: { hideLeft: false, module: 'Search', menu: 'search' ,url:'device'}},
      //{ path: 'search/device/:brand', component: searchDevice, name: 'searchDevice', meta: { hideLeft: false, module: 'Search', menu: 'search' ,url:'device'}},
      { path: 'search/add', component: searchAdd, name: 'searchAdd', meta: { hideLeft: false, module: 'Search', menu: 'search' ,url:'device'}},
      { path: 'search/edit/:id', component: searchEdit, name: 'searchEdit', meta: { hideLeft: false, module: 'Search', menu: 'search' ,url:'device'}},
      { path: 'search/situation', component: searchSit, name: 'searchSit', meta: { hideLeft: false, module: 'Search', menu: 'search' ,url:'device'}}
      // { path: 'search/qingjia', component: searchQing, name: 'searchQing', meta: { hideLeft: false, module: 'Search', menu: 'search' ,url:'device'}},
      // { path: 'search/qingjiasituation', component: searchQingsit, name: 'searchQingsit', meta: { hideLeft: false, module: 'Search', menu: 'search' ,url:'device'}}
    ]
  },
  {
    path: '/home',
    component: Home,
    children: [
      { path: 'search/qingjia', component: searchQing, name: 'searchQing', meta: { hideLeft: false, module: 'Search', menu: 'search' ,url:'qing'}},
      { path: 'search/qingjia/situation', component: searchQingsit, name: 'searchQingsit', meta: { hideLeft: false, module: 'Search', menu: 'search' ,url:'qing'}}
    ]
  },
  {
    path: '/home',
    component: Home,
    children: [
      { path: 'search/table', component: searchTable, name: 'searchTable', meta: { hideLeft: false, module: 'Search', menu: 'search' ,url:'table'}},
      { path: 'search/table/:name', component: searchTable, name: 'searchTable', meta: { hideLeft: false, module: 'Search', menu: 'search',url:'table' }},
      { path: 'search/add', component: searchAdd1, name: 'searchAdd1', meta: { hideLeft: false, module: 'Search', menu: 'search' ,url:'table'}},
      { path: 'search/edit/:id', component: searchEdit1, name: 'searchEdit1', meta: { hideLeft: false, module: 'Search', menu: 'search' ,url:'table'}}
    ]
  },
  {
    path: '/home',
    component: Home,
    children: [
      { path: 'menu/list', component: menuList, name: 'menuList', meta: { hideLeft: false, module: 'Administrative', menu: 'menu' }},
      { path: 'menu/add', component: menuAdd, name: 'menuAdd', meta: { hideLeft: false, module: 'Administrative', menu: 'menu' }},
      { path: 'menu/edit/:id', component: menuEdit, name: 'menuEdit', meta: { hideLeft: false, module: 'Administrative', menu: 'menu' }}
    ]
  },
  {
    path: '/home',
    component: Home,
    children: [
      { path: 'demo/demo/', component: demoDemo, name: 'demoDemo', meta: { hideLeft: false, module: 'Administrative', menu: 'demo' }}
    ]
  },
  {
    path: '/home',
    component: Home,
    children: [
      { path: 'config/add', component: systemConfig, name: 'systemConfig', meta: { hideLeft: false, module: 'Administrative', menu: 'systemConfig' }}
    ]
  },

  {
    path: '/home',
    component: Home,
    children: [
      { path: 'rule/list', component: ruleList, name: 'ruleList', meta: { hideLeft: false, module: 'Administrative', menu: 'rule' }},
      { path: 'rule/add', component: ruleAdd, name: 'ruleAdd', meta: { hideLeft: false, module: 'Administrative', menu: 'rule' }},
      { path: 'rule/edit/:id', component: ruleEdit, name: 'ruleEdit', meta: { hideLeft: false, module: 'Administrative', menu: 'rule' }}
    ]
  },
  {
    path: '/home',
    component: Home,
    children: [
      { path: 'position/list', component: positionList, name: 'positionList', meta: { hideLeft: false, module: 'Administrative', menu: 'position' }},
      { path: 'position/add', component: positionAdd, name: 'positionAdd', meta: { hideLeft: false, module: 'Administrative', menu: 'position' }},
      { path: 'position/edit/:id', component: positionEdit, name: 'positionEdit', meta: { hideLeft: false, module: 'Administrative', menu: 'position' }}
    ]
  },
  {
    path: '/home',
    component: Home,
    children: [
      { path: 'structures/list', component: structuresList, name: 'structuresList', meta: { hideLeft: false, module: 'Administrative', menu: 'structures' }},
      { path: 'structures/add', component: structuresAdd, name: 'structuresAdd', meta: { hideLeft: false, module: 'Administrative', menu: 'structures' }},
      { path: 'structures/edit/:id', component: structuresEdit, name: 'structuresEdit', meta: { hideLeft: false, module: 'Administrative', menu: 'structures' }}
    ]
  },
  {
    path: '/home',
    component: Home,
    children: [
      { path: 'groups/list', component: groupsList, name: 'groupsList', meta: { hideLeft: false, module: 'Administrative', menu: 'groups' }},
      { path: 'groups/add', component: groupsAdd, name: 'groupsAdd', meta: { hideLeft: false, module: 'Administrative', menu: 'groups' }},
      { path: 'groups/edit/:id', component: groupsEdit, name: 'groupsEdit', meta: { hideLeft: false, module: 'Administrative', menu: 'groups' }}
    ]
  },
  {
    path: '/home',
    component: Home,
    children: [
      { path: 'users/list', component: usersList, name: 'usersList', meta: { hideLeft: false, module: 'Administrative', menu: 'users' }},
      { path: 'users/add', component: usersAdd, name: 'usersAdd', meta: { hideLeft: false, module: 'Administrative', menu: 'users' }},
      { path: 'users/edit/:id', component: usersEdit, name: 'usersEdit', meta: { hideLeft: false, module: 'Administrative', menu: 'users' }}
    ]
  }
]
export default routes
