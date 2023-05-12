<template>
	<div>
		<div class="content">
			<div class="container">
				<!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
				<div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
					<p class="_title0">Books<Button @click="addModal=true"><Icon type="ios-add-circle" />Add Book</Button></p>

					<div class="_overflow _table_div">
						<table class="_table">
								<!-- TABLE TITLE -->
							<tr>
								<th>id</th>
								<th>Book Image</th>
								<th>Title</th>
								<th>Author</th>
								<th>Created At</th>
								<th>Action</th>
							</tr>
								<!-- TABLE TITLE -->


								<!-- ITEMS -->
							<tr v-for="(book,i) in books" :key="i" v-if="books.length">
								<td>{{ i+1 }}</td>
								<td >
									<img v-if="book.image" style="width:100px;" :src="`uploads/${book.image}`" />
									<p v-if="!book.image">No Image</p>
								</td>
								<td>{{ book.title }}</td>
								<td>{{ book.author }}</td>
								<td>{{ book.created_at }}</td>
								<td>
									<button class="_btn _action_btn edit_btn1" type="primary" @click="showEditModal(book,i)">Edit</button>
									<button class="_btn _action_btn make_btn1" type="primary" @click="showDeletingModal(book,i)" :loading="book.isDeleting">Delete</button>
								</td>
							</tr>

							<!-- adding Book Modal -->
							<Modal
								v-model="addModal"
								title="Add Book"
								:mask-closable = "false"
								:closable = "false"
								>
								<Input v-model="data.title" style="margin:5px;" placeholder="Book Title" maxlength="60" />
                                <Input v-model="data.author" style="margin:5px;"  placeholder="Book Author" maxlength="60" />
								<Input v-model="data.genre" style="margin:5px;"  placeholder="Book Genre" maxlength="60"  />
								<Input v-model="data.slug" style="margin:5px;"   placeholder="Book Slug" maxlength="60" />
								<Input v-model="data.description" style="margin:5px;"   type="textarea" :rows="4" placeholder="Book Description" maxlength="3000" />
								<Input v-model="data.isbn" style="margin:5px;"  placeholder="Book Isbn" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onpaste="return false;" maxlength="13" />
                                <Upload
								    v-show="data.image === ''"
                                    type="drag"
									ref="upload"
                                    :headers="{'x-csrf-token':csrf,'X-Requested-With':'XMLHttpRequest'}"
                                    :on-success="handleSuccess"
                                    :format="['jpg','jpeg','png']"
                                    :max-size="2048"
                                    :on-format-error="handleFormatError"
                                    :on-exceeded-size="handleMaxSize"
                                    action="books/upload">
                                    <div style="padding: 20px 0">
                                        <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                                        <p>Click or drag files here to upload Book Image</p>
                                    </div>
                                </Upload>
								<div class="demo-upload-list" v-if="data.image">
										<Image :src="`/uploads/${data.image}`" />
										<div class="demo-upload-list-cover">
											<Icon size="24" type="ios-trash-outline" color="black" @click="deleteImage()"></Icon>
										</div>
								</div>
								<Input v-model="data.published"  style="margin:5px;"  type="date" placeholder="Book Published"  />
								<Input v-model="data.publisher" style="margin:5px;"  placeholder="Book Publisher"  />

								 <template #footer>
                                  <Button type="default" style="margin:5px;" @click="addModal=false">Close</Button>

								  <Button type="primary" style="margin:5px;" @click="addBook()" :loading="isAdding">{{isAdding ? 'Adding...' : 'Add Book' }}</Button>
                                </template>
							</Modal>

							<!-- Edit Book Modal -->
							<Modal
								v-model="editModal"
								title="Edit Book"
								:mask-closable = "false"
								:closable = "false"
								>
								<Input style="margin:5px;" v-model="editData.title" placeholder="Book Title" maxlength="60" />
                                <Input style="margin:5px;" v-model="editData.author" placeholder="Book Author" maxlength="60" />
								<Input style="margin:5px;" v-model="editData.genre" placeholder="Book Genre" maxlength="60"  />
								<Input style="margin:5px;" v-model="editData.slug" placeholder="Book Slug" maxlength="60" />
								<Input style="margin:5px;" v-model="editData.description" type="textarea" :rows="4" placeholder="Book Description" maxlength="3000" />
								<Input style="margin:5px;" v-model="editData.isbn"  placeholder="Book Isbn" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onpaste="return false;" maxlength="13" />
                                <Upload v-show="editData.image === ''"
                                    type="drag"
									ref="editUpload"
                                    :headers="{'x-csrf-token':csrf,'X-Requested-With':'XMLHttpRequest'}"
                                    :on-success="editHandleSuccess"
                                    :format="['jpg','jpeg','png']"
                                    :max-size="2048"
                                    :on-format-error="handleFormatError"
                                    :on-exceeded-size="handleMaxSize"
                                    action="books/upload">
                                    <div style="padding: 20px 0">
                                        <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                                        <p>Click or drag files here to upload Book Image</p>
                                    </div>
                                </Upload>
								<div class="demo-upload-list" v-if="editData.image">
										<Image :src="`/uploads/${editData.image}`" />
										<div class="demo-upload-list-cover">
											<Icon size="24" type="ios-trash-outline" color="black" @click="deleteEditImage()"></Icon>
										</div>
								</div>
								<Input style="margin:5px;" v-model="editData.published" type="date" placeholder="Book Published"  />
								<Input  style="margin:5px;" v-model="editData.publisher" placeholder="Book Publisher" maxlength="60"  />

								 <template #footer>
                                  <Button type="default" @click="editModal=false">Close</Button>
								  <Button type="primary" @click="editBook()" >Edit Book</Button>
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
									<p>Are you sure You want to delete book?</p>
								</div>
								<template #footer>
									<Button type="error" size="large" long :loading="isDeleting" :disabled="isDeleting" @click="deleteBook()">Delete</Button>
								</template>
							</Modal>

						</table>
					</div>
				</div>
				 <Page :total="100" />

			</div>
		</div>
	</div>
</template>

<script>
import { exportDefaultSpecifier } from '@babel/types';
import * as _ from 'lodash';

export default {

	data(){
		return{
           data:{
               title:'',
			   author:'',
			   genre:'',
               slug:'',
               description:'',
			   isbn:'',
			   image:'',
               published:'',
			   publisher:''
		   },
		   books : [],
		   editModal:false,
		   addModal: false,
           isAdding: false,
		   editData:{
			   title:'',
			   author:'',
			   genre:'',
               slug:'',
               description:'',
			   isbn:'',
			   image:'',
               published:'',
			   publisher:''
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
		this.getBooks();
	 },
	methods : {
		async addBook(){
			if(this.data.title.trim() == '') return this.error("Book name is Required")
			if(this.data.author.trim() == '') return this.error("Book Author is Required")
			if(this.data.genre.trim() == '') return this.error("Book Genre is Required")
			if(this.data.slug.trim() == '') return this.error("Book Slug is Required")
			if(this.data.description.trim() == '') return this.error("Book Description is Required")
			if(this.data.image.trim() == '') return this.error("Book Image is Required")
            if(this.data.isbn.trim() == '') return this.error("Book Isbn is Required")
			if(this.data.published.trim() == '') return this.error("Book Published is Required")
			if(this.data.publisher.trim() == '') return this.error("Book Publisher is Required")
			const res = await this.callApi('post','books/create', this.data);

			if(res.status === 201){
				this.books.unshift(res.data)
				this.s("Book has been added successfully!")
				this.addModal = false
				this.title ='',
				this.tuthor ='',
				this.genre='',
				this.slug='',
				this.description='',
				this.isbn='',
                this.published='',
			    this.publisher=''
			}else{
                this.swr()
			}
		},

		async editBook(){
			if(this.editData.title.trim() == '') return this.error("Book name is Required")
			if(this.editData.author.trim() == '') return this.error("Book Author is Required")
			if(this.editData.genre.trim() == '') return this.error("Book Genre is Required")
			if(this.editData.slug.trim() == '') return this.error("Book Slug is Required")
			if(this.editData.image.trim() == '') return this.error("Book Image is Required")
			if(this.editData.description.trim() == '') return this.error("Book Description is Required")
			if(this.editData.published.trim() == '') return this.error("Book Published is Required")
			if(this.editData.publisher.trim() == '') return this.error("Book Publisher is Required")
			const res = await this.callApi('post','books/edit', this.editData)

			if(res.status === 200){
				this.books[this.index] = this.editData
				this.s("Book has been edited successfully!")
				this.editModal = false
			}else{
                this.swr()
			}


		},

		showEditModal(book,index){
				Object.assign(this.editData,book)
				this.editModal=true
				this.index =index
		    },

		async deleteBook(){
			this.isDeleting = true
		   const res = await this.callApi('post','books/delete',this.deleItem)
		   if(res.status === 200){
			this.books.splice(this.deleteindex,1)
			this.s(`book has been deleted successfully!`)
		   }else{
			this.swr();
		   }
		   this.isDeleting = false
		   this.showDeleteModal = false
		},

		showDeletingModal(book,i){
            Object.assign(this.deleItem,book)
			this.deleteindex = i
			this.showDeleteModal = true
		},
        handleSuccess (res, file) {
                this.data.image = res
                this.visible = true
            },
        editHandleSuccess (res, file) {
            this.editData.image = res
            this.visible = true

        },
        handleFormatError (file) {
            this.$Notice.warning({
                title: 'The file format is incorrect',
                desc: 'File format of ' + file.name + ' is incorrect, please select jpg or png.'
            });
        },
        handleMaxSize (file) {
            this.$Notice.warning({
                title: 'Exceeding file size limit',
                desc: 'File  ' + file.name + ' is too large, no more than 2M.'
            });
        },

		async deleteImage(){
			let bookimage = this.data.image
			this.data.image = ''
			this.$refs.upload.clearFiles()
			const res = await this.callApi('post','books/imagedelete',{imageName:bookimage})
			if(res.status != 200){
                 this.data.image = bookimage
				 this.swr()
			}else if(res.status === 200){
				this.data.image = ''
			}
		},
		 async deleteEditImage(){
			let editbookimage = this.editData.image
			let editImageID =  this.editData.id
			this.editData.image = ''
			this.$refs.editUpload.clearFiles()
			const res = await this.callApi('post','books/imagedelete',{imageName:editbookimage,imagId:editImageID})
			if(res.status != 200){
                 this.editData.image = bookimage
				 this.swr()
			}else if(res.status === 200){
				this.editData.image = ''
				this.books[this.index]['image'] = '';
			}
		 },
	   	async getBooks() {
			const res = await this.callApi('get','/books/get_books')
			if(res.status === 200){
                   this.books = res.data;
			}else {
				this.swr()

			}
		},
	}

}
</script>




