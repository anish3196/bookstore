<template>
    <div>
        <div class="container">
            <div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20 col-md-4">
                  <div class="login_header">
                      <h1>Login to the dashboard</h1>
                  </div>
                  <div class="space" style="margin: 5px;">
                        <Input type="email" v-model="data.email"  placeholder="Email"  />
                    </div>
                    <div class="space" style="margin: 5px;">
                        <Input type="password" v-model="data.password"  placeholder="******"  />
                    </div>
                    <div class="login_footer">
                        <Button type="primary" @click="login" :disabled="isLogging" :loading="isLogging">{{isLogging ? 'Loging...' : 'Login'}}</Button>
                    </div>
                    <p style="margin-left:120px; margin-top: 5px;" class="_1adminOverveiw_card_left_title"><a href="/book" target="_blank">Goto Book Site</a></p>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    data(){
        return {
            data : {
                email : '',
                password: ''
            },
            isLogging: false,
        }
    },

    methods : {
        async login(){
            if(this.data.email.trim()=='') return this.error('Email is required')
            if(this.data.password.trim()=='') return this.error('Password is required')
            if(this.data.password.length < 6) return this.error('Incorrect login details')
            this.isLogging = true
            const res = await this.callApi('post', 'users/admin_login', this.data)
            if(res != undefined){
            if(res.status===200){
                this.s(res.data.msg)
                window.location = '/'
            }
        }else {

                    this.i("Please Enter valid Creantials")

        }
            this.isLogging = false
        }
    }
}
</script>






<style scoped>
    ._1adminOverveiw_table_recent {
        margin: 0 auto;
        margin-top: 220px;
    }
    .login_footer{
        text-align: center;
    }
    .login_header{
        text-align: center;
        margin-bottom: 25px;
    }
</style>