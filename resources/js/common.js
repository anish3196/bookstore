import axios from "axios"

export default {

    data(){
           return{

           }
    },

    methods:{
       async callApi(method,url,dataObj){
                try {
                   return await axios({
                      method:method,
                      url: url,
                      data:dataObj
                    });
                } catch (error) {
                   return error.res
                }
        },





      i(desc,title="Hey") {
         this.$Notice.info({
             title: title,
             desc: desc
         });
     },
     s(desc,title="Great") {
         this.$Notice.success({
             title:title,
             desc: desc
         });
     },
     w(desc,title="Oops!") {
         this.$Notice.warning({
             title: title,
             desc: desc
         });
     },
     error(desc,title="Oops!") {
         this.$Notice.error({
            title: title,
            desc: desc
        });
     },

     swr(desc="Something Went Wrong! Please try again.",title="Oops!") {
      this.$Notice.error({
         title: title,
         desc: desc
     });
  }
    }
}



