<template>
<!-- <div>
<el-menu mode="vertical" default-active="/table" class="el-menu-vertical-demo" @select="handleselect" theme="dark" router>
<el-menu-item-group v-for="menu in menuData" :title="menu.title">
<el-menu-item v-for="item in menu.items" :index="item.path">&nbsp;&nbsp;&nbsp;&nbsp;{{item.name}}</el-menu-item>
</el-menu-item-group>
</el-menu>
</div> -->

	<div>
		<div v-for="secMenu in menuData">
			<div class="c-light-gray p-l-10 m-t-15">{{secMenu.title}}</div>
			<div class="h-50" v-for="item in secMenu.child">
				<template v-if="item.menu == menu">
					<div class="w-100p h-50 p-l-40 left-menu pointer c-blue" @click="routerChange(item)">{{item.title}}</div>
				</template>
				<template v-else-if="item.menu == tableMenu">
					<div class="w-100p h-50 p-l-40 left-menu pointer c-blue" @click="routerChange(item)">{{item.title}}</div>
</template>
				<template v-else>
					<div class="w-100p h-50 p-l-40 left-menu pointer c-gra" @click="routerChange(item)">
						{{item.title}}
					</div>
				</template>
			</div>
		</div>
	</div>
</template>

<script>
export default {
  props: ['menuData', 'menu'],
  data() {
    return {
      tableMenu: Lockr.get('flag')
    }
  },
  methods: {
    routerChange(item) 	{
      // 与当前页面路由相等则刷新页面
      console.log('get ' + item.menu)
      console.log('get ' + item.url)
      console.log(item.module)
      if (this.$route.meta.menu == 'search') {
        console.log('123')
        console.log(this.$route.meta.url)
        console.log(this.$route.path)
		if(item.module == 'Search'){
            console.log('123')
        	router.replace({ path: '/refresh', query: { name: 'searchDevice', item: item }})
            this.tableMenu = item.menu
            Lockr.set('deviceitem', item)}
        else if(item.module == 'Table'){
            router.replace({ path: '/refresh', query: { name: 'searchTable', item: item }})
            this.tableMenu = item.menu
            Lockr.set('tableitem', item)}
        else if(item.module == 'Qing'){
            router.replace({ path: '/refresh', query: { name: 'searchQing', item: item }})
            this.tableMenu = item.menu
            Lockr.set('qingjiaitem', item)}
        else if(item.module == 'Qingsit'){
            router.replace({ path: '/refresh', query: { name: 'searchQingsit', item: item }})
            this.tableMenu = item.menu
            Lockr.set('qingjiaitem', item)}
	  }

      else {
        if (item.url != this.$route.path) {
          router.push(item.url)
        } else {
          _g.shallowRefresh(this.$route.name)
        }
      }
    }
  },
  beforecreated() {
    console.log('in leftMenu')
    console.log(this.$route)
  }
}
</script>
