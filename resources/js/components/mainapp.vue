<template lang="pug">
     <div id="app">
<div v-if="$store.state.user">
  <!--========== ADMIN SIDE MENU one ========-->
  <div class="_1side_menu" >
    <div class="_1side_menu_logo">
      <h3 style="text-align:center;">Logo Image</h3>
      <!--<img src="/img/logo.jpg" style="width: 108px;margin-left: 68px;"/>-->
    </div>

    <!--~~~~~~~~ MENU CONTENT ~~~~~~~~-->
    <div class="_1side_menu_content">
      <div class="_1side_menu_img_name">
        <!-- <img class="_1side_menu_img" src="/pic.png" alt="" title=""> -->
        <p class="_1side_menu_name">Admin</p>
      </div>

      <!--~~~ MENU LIST ~~~~~~-->
      <div class="_1side_menu_list">
        <ul class="_1side_menu_list_ul">
          <li> <router-link to="/"><Icon type="ios-laptop" /> dashboard</router-link> </li>

          <li><router-link to="/bookcollection"><Icon type="ios-book" /> Books</router-link></li>

          <li><router-link to="/users"><Icon type="ios-book" /> Users</router-link></li>

          <li><a href="/logout"><Icon type="ios-book" />Logout</a></li>
        </ul>
      </div>
    </div>
  </div>
  <!--========== ADMIN SIDE MENU ========-->

  <!--========= HEADER ==========-->
  <div class="header">
    <div class="_2menu _box_shadow">
      <div class="_2menu_logo">
        <ul class="open_button">
          <li>
            <Icon type="ios-options-outline" />
          </li>
          <!--<li><Icon type="ios-albums" /></li>-->
        </ul>
      </div>
    </div>
  </div>
  <!--========= HEADER ==========-->
</div>
  <router-view/>
</div>
</template>
<script>
export default {
  data() {
        return {
             isLoggedIn:false,
             user:window.User
        }
  },
  mounted(){
    this.$store.commit('setUpdateUser',this.user)
  },
}

</script>

