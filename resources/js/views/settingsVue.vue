<template>
    <div class="main">
        <div style="text-align:center;" class="disp">
            <div class="informationchange">
                <h4>change Information</h4>
            <form @submit.prevent="update" method="post">
                <div class="form-group">
                    <label for="fname">FirstName</label>
                    <input type="text" id="fname" class="form-control" v-model="dataUpdate.fname">
                </div>

                <div class="form-group">
                    <label for="lname">LastName</label>
                    <input type="text" id="lname" class="form-control" v-model="dataUpdate.lname">
                </div>

                <div class="form-group">
                    <label for="phone">phone</label>
                    <input type="text" id="phone" class="form-control" v-model="dataUpdate.phone">
                </div>
                <input type="submit" value="update" class="form-control btn btn-success">
                <a style="margin-top:56px;" href="/password/reset" target="_blank" class="form-control btn btn-success"><i class="fa fa-lock"></i> Change password</a>
            </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    data : ()=>{
        return{
            dataUpdate : {
                fname : null,
                lname : null,
                phone : null,
            },
            auth : null,
        }
    },
    methods : {
        update()
        {
            let run = axios.put('/api/updateUser',this.dataUpdate,this.cors())
            run.then(e=>{
                if(e.status == 204)
                {
                    this.statu('updated','success')
                    setTimeout(() => {
                        location.reload()
                    }, 1000);
                }
            })
            run.catch(e=>{
                console.log(e.data)
            })
        },
    },
    created()
    {
        this.auth = this.$store.state.auth
        this.dataUpdate.fname = this.auth.fname
        this.dataUpdate.lname = this.auth.lname
        this.dataUpdate.phone = this.auth.phone
    }
}
</script>