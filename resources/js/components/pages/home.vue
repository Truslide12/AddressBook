<template>
<div class="content">
    <div class="container-fluid">
        <div style="margin:10px">
        </div>
        <div class="row">
            <div style="margin-top:10px;">
                <h3>Contacts</h3>
            </div>
            <div class="row">
                <div style="margin-top:10px; margin-bottom:10px;">
                    <p class="_title0">Contact List
                        <Button @click="addModal=true"><Icon type="md-add" />Create New Contact</Button>
                    </p>
                </div>
            </div>
        <div class="row mb-5">
            <div class="col-sm-10">
                <ais-instant-search
                    :search-client="searchClient"
                    index-name="contacts"
                >
                </ais-instant-search>
            </div>
        </div>

            <div class="_overflow _table_div">
                <table id='dataTable' class="table table-hover col-sm-12 w-auto table-responsive">
                    <thead class="thead-dark">
                        <tr>
                            <th>First Name
                               <!-- <h5 sortable:true></h5>    -->
                            </th>
                            <th>Last Name
                                <!-- <h5 sortable:true></h5> -->
                            <th>Email
                                <!-- <h5 sortable:true></h5> -->
                            <th>Phone
                                <!-- <h5 sortable:true></h5> -->
                            <th>Birthday
                                <!-- <h5 sortable:true></h5> -->
                            <th>Action
                                <!-- <h5 style='text-align:center;'></h5> -->
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(contact, i) in contacts.data" :key="i">
                            <td>{{contact.firstName}}</td>
                            <td>{{contact.lastName}}</td>
                            <td>{{contact.email}}</td>
                            <td>{{contact.phone}}</td>
                            <td>{{contact.birthday}}</td>
                            <td>
                                    <b-btn id='show-edit-btn' variant="info" size="small" @click="$bvModalShow('editModal', contact.id)">Edit</b-btn>
                                    <b-btn id='show-delete-btn' variant="danger" size="small" @click="$bvModalShow('deleteModal', contact.id)" :loading="contact.isDeleting" >Delete</b-btn>
                                    <router-link to="contacts.createAddress">Add Address</router-link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div>
            Sorting By: <b>{{ sortBy }}</b>, Sort Direction:
            <b>{{ sortDesc ? 'Descending' : 'Ascending' }}</b>
            </div>
        </div>

    <!-- ############################################ Modals ############################################# -->
        				<!-- Contact Add Modal -->
				<Modal
					v-model="addModal"
					title="Add Contact"
					:mask-closable = "false"
					:closable = "false">
					<Input v-model="data.contactName" placeholder="Add Contact Name" />
                    <div class="space"></div>

                    <Upload
                        ref="uploads"
                        type="drag"
                        :headers = "{'x-csrf-token' : token, 'X-Requested-With' : 'XMLHttpRequest'}"
                        :on-success="handleSuccess"
                        :on-error="handleError"
                        :format="['jpg','jpeg','png','bmp',]"
                        :max-size="2048"
                        :on-format-error="handleFormatError"
                        :on-exceeded-size="handleMaxSize"
                        action="/app/upload">
                        <div style="padding: 20px 0">
                            <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                            <p>Click or drag files here to upload</p>
                        </div>
                    </Upload>

                    <div class="demo-upload-list" v-if="data.iconImage">

                        <img :src="`/uploads/${data.iconImage}`">
                        <div class="demo-upload-list-cover">
                            <Icon type="ios-trash-outline" @click='deleteImage'></Icon>
                        </div>

                    </div>

                    <div slot="footer">
						<button type="default" @click="addModal=false">Close</button>
						<button type="primary" @click="addContact" :disabled="isAdding" :loading="isAdding">{{isAdding ? 'Adding..' : 'Add Contact'}}</button>
					</div>
				</Modal>
				<!-- End Add Modal -->

<!-- category Edit Modal -->
				<Modal
					v-model="editModal"
					title="Edit Category"
					:mask-closable = "false"
					:closable = "false">
					<Input v-model="editData.categoryName" placeholder="Edit Category Name" />
                    <div class="space"></div>

                    <Upload v-show="isIconImageNew"
                        ref="editDataUploads"
                        type="drag"
                        :headers = "{'x-csrf-token' : token, 'X-Requested-With' : 'XMLHttpRequest'}"
                        :on-success="handleSuccess"
                        :on-error="handleError"
                        :format="['jpg','jpeg','png','bmp',]"
                        :max-size="2048"
                        :on-format-error="handleFormatError"
                        :on-exceeded-size="handleMaxSize"
                        action="/app/upload">
                        <div style="padding: 20px 0">
                            <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                            <p>Click or drag files here to upload</p>
                        </div>
                    </Upload>

                    <div class="demo-upload-list" v-if="editData.iconImage">

                        <img :src="`${editData.iconImage}`">
                        <div class="demo-upload-list-cover">
                            <Icon type="ios-trash-outline" @click='deleteImage(false)'></Icon>
                        </div>

                    </div>

                    <div slot="footer">
						<button type="default" @click="closeEditModal">Close</button>
						<button type="primary" @click="editCategory" :disabled="isEditing" :loading="isEditing">{{isEditing ? 'Editing..' : 'Edit Category'}}</button>
					</div>
				</Modal>
				<!-- End Edit Modal -->

				<!-- Delete Modal -->
				<Modal v-model="showDeleteModal" width="360">
					<p slot="header" style="color:#f60;text-align:center">
						<Icon type="ios-information-circle"></Icon>
						<span>Delete confirmation</span>
					</p>
					<div style="text-align:center">
						<p>Are you sure you want to delete this category?</p>
					</div>
					<div slot="footer">
						<Button type="error" size="large" long :loading="isDeleting" :disabled="isDeleting"
						@click="deleteCategory">Delete</Button>
					</div>
				</Modal>


            <!-- Delete Warning Modal -->
        <!-- <div class="modal modal-danger fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteContact  ModalLabel">Delete Contact</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form method="POST" action="/deleteContact">
                </div>
            </div>
        </div> -->

            <!-- End Delete Modal -->

<!-- ########################################## End Modals ########################################### -->

    </div>
</div>
</template>

<script>
export default {
	data() {
        $algoliaID = config('algolia.id');
        $algoliaKey = config('algolia.key')
        return {
			data : {
                firstName: '',
                lastName: '',
                email: '',
                phone: '',
                birthday: '',
			},
			addModal : false,
			editModal: false,
            isAdding : false,
            isEditing: false,
			contactLists : [],
			editData : {
                firstName: '',
                lastName: '',
                email: '',
                phone: '',
                birthday: '',
			},
			index : -1,
			isDeleting : false,
			showDeleteModal: false,
			deleteItem: {},
            deletingIndex: -1,
            token: '',
            isIconImageNew: false,
            isEditingItem: false,
                    sortBy: 'age',
            sortDesc: false,
            fields: [
                { key: 'firstName', sortable: true },
                { key: 'lastName', sortable: true },
                { key: 'email', sortable: true },
                { key: 'phone', sortable: true },
                { key: 'birthday', sortable:true}
            ],
            searchClient: algoliasearch(
          // need to get these once I setup algolia
                $algoliaID,
                $algoliaKey,
            ),
		}
	},

	methods : {
		async addContact() {
            if(this.data.firstName.trim()=='') return this.e('First name is required')
            if(this.data.lastName.trim()=='') return this.e('Last name is required')
            if(this.data.email.trim()=='') return this.e('Email is required')
            if(this.data.phone.trim()=='') return this.e('Phone number is required')
            if(this.data.birthday.trim()=='') return this.e('Birthday is required')
			const res = await this.callApi('post', 'app/createContact', this.data)
			if(res.status===201){
				this.contactLists.unshift(res.data)
				this.s('Contact has been added successfully!')
				this.addModal = false
                this.data.firstName = ''
                this.data.lastName = ''
                this.data.email = ''
                this.data.phone = ''
                this.data.birthday = ''
			} else {
				if(res.status==422) {
					if (this.res.errors.firstName){
						this.i(res.data.errors.firstName[0])
                    }
                    if (this.res.errors.lastName){
						this.i(res.data.errors.lastName[0])
                    }
                    if (this.res.errors.email){
                        this.i(res.data.errors.contactName[0])
                    }
                    if (this.res.errors.phone){
						this.i(res.data.errors.phone[0])
                    }
                    if (this.res.data.errors.birthday){
						this.i(res.data.errors.birthday[0])
                    }
				}else {
					this.swr()
				}
			}
		},
		async editContact() {
            if(this.data.firstName.trim()=='') return this.e('First name is required')
            if(this.data.lastName.trim()=='') return this.e('Last name is required')
            if(this.data.email.trim()=='') return this.e('Email is required')
            if(this.data.phone.trim()=='') return this.e('Phone number is required')
            if(this.data.birthday.trim()=='') return this.e('Birthday is required')
			const res = await this.callApi(
				'put',
				'app/editContact',
				this.editData
			);
			if(res.status===200){
                this.contactLists[this.index].firstName = this.editData.firstName
                this.contactLists[this.index].lastName = this.editData.lastName
                this.contactLists[this.index].email = this.editData.email
                this.contactLists[this.index].phone = this.editData.phone
                this.contactLists[this.index].birthday = this.editData.birthday
				this.s('Contact has been added successfully!')
				this.editModal = false
			} else {
				if(res.status==422) {
					if (this.res.errors.firstName){
						this.i(res.data.errors.firstName[0])
                    }
                    if (this.res.errors.lastName){
						this.i(res.data.errors.lastName[0])
                    }
                    if (this.res.errors.email){
                        this.i(res.data.errors.contactName[0])
                    }
                    if (this.res.errors.phone){
						this.i(res.data.errors.phone[0])
                    }
                    if (this.res.data.errors.birthday){
						this.i(res.data.errors.birthday[0])
                    }
				}
				else {
					this.swr()
				}
			}
        },

		showEditModal (contact, index) {
			console.log(contact)
			this.editData = contact
			this.editModal = true
            this.index = index
            this.isEditingItem = true
		},

		async deleteContact() {
			// How to set a new attribute that was not loaded initially
			// this.$set(contact, 'isDeleting', true)
			this.isDeleting = true
			const res = await this.callApi('delete', 'app/deleteContact', this.deleteItem)
			if(res.status===200){
				this.contactLists.splice(this.deletingIndex, 1) // this will splice the list at i and remove it from the list on the front end
				this.s('contact has been deleted successfully')
			} else {
				this.swr()
			}
			this.showDeleteModal = false
			this.isDeleting = false
		},

		showDeletingModal (contact, i) {
			this.deleteItem = contact
			this.deletingIndex = i
			this.showDeleteModal = true
        },

        handleSuccess (res , file) {
            if(this.idEditingItem) {
                return (this.editData = res);
            }
        },

        handleError (res, file) {
            // console.log('res', res)
            // console.log('file', file)
            this.$Notice.warning({
                title: 'The file format is incorrect',
                desc: "${file.errors.file.length ? file.errors.file[0] : 'Something went wrong'}"
            })
        },

        handleFormatError (file) {
            this.$Notice.warning({
                title: 'The file format is incorrect',
                desc: 'File format of ' + file.name + ' is incorrect, please select jpg or png'
            })
        },

		closeEditModal () {
			this.isEditingItem = false;
			this.editModal = false;
		}
	},

	async created() {
        this.token = window.Laravel.csrfToken
		const res = await this.callApi('get', 'app/getContact')
		if(res.status===200){
			this.contactLists = res.data
		} else {
			this.swr(error)
		}
	},
}

</script>
