<template>

    <div>
        <b-nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <h2 style="color: white;">Address Book</h2>

<!--
            <b-nav-item class="collapse navbar-collapse" id="navbarsExampleDefault">
                    <router-link to="contacts"><Icon type="ios-speedometer" />Contacts</router-link>
            </b-nav-item>
            <b-nav-item class="collapse navbar-collapse" id="navbarsExampleDefault">
                    <router-link to="search"><Icon type="ios-speedometer" />Search</router-link>
            </b-nav-item> -->
        </b-nav>
    </div>

</template>


<script>
export default {
    props: ['user', 'permission'],
    data(){
       return {
          isLoggedIn : false,
       }
    },
    created(){
       this.$store.commit('setUpdateUser', this.user)
       this.$store.commit('setUserPermission', this.permission)
    }
}
</script>





