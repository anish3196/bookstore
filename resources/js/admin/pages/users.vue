<template>
	<div>
		<div class="content">
			<div class="container">
				<!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
				<div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
					<p class="_title0">Uers<Button @click="addModal=true"><Icon type="ios-add-circle" />Add User</Button></p>

					<div class="_overflow _table_div">
						<table class="_table">
								<!-- TABLE TITLE -->
							<tr>
								<th>id</th>
								<th>User Name</th>
								<th>Email</th>
								<th>Usertype</th>
								<th>Action</th>
							</tr>
								<!-- TABLE TITLE -->


								<!-- ITEMS -->
							<tr v-for="(user,i) in users" :key="i" v-if="users.length">
								<td>{{ i+1 }}</td>
								<td>{{ user.fullName }}</td>
								<td>{{ user.email }}</td>
								<td>{{ user.userType }}</td>
								<td>
									<button class="_btn _action_btn edit_btn1" type="primary" @click="showEditModal(user,i)">Edit</button>
									<button class="_btn _action_btn make_btn1" type="primary" @click="showDeletingModal(user,i)" :loading="user.isDeleting">Delete</button>
								</td>
							</tr>

							<!-- adding Book Modal -->
							<Modal
								v-model="addModal"
								title="Add User"
								:mask-closable = "false"
								:closable = "false"
								>
								<Input v-model="data.fullName"  style="margin:5px;" placeholder="Full Name"  />
								<Input v-model="data.email" style="margin:5px;"  placeholder="Emial"  />
                                <Input v-model="data.password" type="password" style="margin:5px;"  placeholder="passsword"  />
                                <Select v-model="data.userType" placeholder="Select User">
                                    <Option value="Admin" >Admin</Option>
                                    <Option value="Editor">Editor</Option>
                                    <Option value="User">User</Option>
                                </Select>
								 <template #footer>
                                  <Button type="default"  @click="addModal=false">Close</Button>

								  <Button type="primary"  @click="addUser()" :loading="isAdding">{{isAdding ? 'Adding...' : 'Add User' }}</Button>
                                </template>
							</Modal>

							<!-- Edit Book Modal -->
							<Modal
								v-model="editModal"
								title="Edit user"
								:mask-closable = "false"
								:closable = "false"
								>
                                <Input v-model="editData.fullName"  style="margin:5px;" placeholder="Full Name"  />
								<Input v-model="editData.email" style="margin:5px;"  placeholder="Emial"  />
                                <Input v-model="editData.password" type="password" style="margin:5px;"  placeholder="passsword"  />
                                <Select v-model="editData.userType" placeholder="Select User">
                                    <Option value="Admin" >Admin</Option>
                                    <Option value="Editor">Editor</Option>
                                    <Option value="User">User</Option>
                                </Select>

								 <template #footer>
                                  <Button type="default" @click="editModal=false">Close</Button>
								  <Button type="primary" @click="editUser()" >Edit User</Button>
                                </template>
							</Modal>
                                    <!-- Delete Alert model -->
							<Modal v-model="showDeleteModal" width="360">
								<template #header>
									<p style="color:#f60;text-align:center">
										<Icon type="ios-information-circle"></Icon>
										<span>Delete confirmation</span>
									</p>
								</template>
								<div style="text-align:center">
									<p>Are you sure You want to delete user?</p>
								</div>
								<template #footer>
									<Button type="error" size="large" long :loading="isDeleting" :disabled="isDeleting" @click="deleteUser()">Delete</Button>
								</template>
							</Modal>

						</table>
					</div>
				</div>

			</div>
		</div>
	</div>
</template>

<script>

export default {

	data(){
		return{
           data:{
            fullName:'',
            email:'',
            password:'',
            userType:''
		   },
		   users : [],
		   editModal:false,
		   addModal: false,
           isAdding: false,
		   editData:{
            fullName:'',
            email:'',
            password:'',
            userType:''
		   },

		   index: -1,
		   showDeleteModal: false,
		   isDeleting:false,
           deleItem: {},
		   deleteindex: -1,
           csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
           visible:false,

		}
	 },

	 mounted(){
		this.getUsers();
	 },
	methods : {
		async addUser(){
			if(this.data.fullName.trim() == '') return this.error("User name is Required")
			if(this.data.email.trim() == '') return this.error("User Email is Required")
			if(this.data.password.trim() == '') return this.error("User Password is Required")
            if(this.data.userType.trim() == '') return this.error("User type is Required")
			const res = await this.callApi('post','users/create', this.data);
            console.log(res);
			if(res.status === 201){
				this.users.unshift(res.data)
				this.s("User has been added successfully!")
				this.addModal = false
                this.data.fullName = ""
                this.data.email = ""
                this.data.password = ""
                this.data.userType = ""

			}else{
                this.swr()
			}
		},

		async editUser(){
			if(this.editData.fullName.trim() == '') return this.error("User name is Required")
			if(this.editData.email.trim() == '') return this.error("User Email is Required")
            if(this.editData.userType.trim() == '') return this.error("User type is Required")
			const res = await this.callApi('post','users/edit', this.editData)

			if(res.status === 200){
				this.users[this.index] = this.editData
				this.s("User has been edited successfully!")
				this.editModal = false
			}else{
                this.swr()
			}


		},

		showEditModal(user,index){
				Object.assign(this.editData,user)
				this.editModal=true
				this.index =index
		    },

		async deleteUser(){
			this.isDeleting = true
		   const res = await this.callApi('post','users/delete',this.deleItem)
		   if(res.status === 200){
			this.users.splice(this.deleteindex,1)
			this.s(`book has been deleted successfully!`)
		   }else{
			this.swr();
		   }
		   this.isDeleting = false
		   this.showDeleteModal = false
		},

		showDeletingModal(user,i){
            Object.assign(this.deleItem,user)
			this.deleteindex = i
			this.showDeleteModal = true
		},
	   	async getUsers() {
			const res = await this.callApi('get','/users/get_users')
			if(res.status === 200){
                   this.users = res.data;
			}else {
				this.swr()

			}
		},
	}

}
</script>




