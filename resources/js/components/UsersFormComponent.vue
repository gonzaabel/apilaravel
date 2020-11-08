<template>
    <div class="modal fade" id="userFormModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" method="POST" v-on:submit.prevent="saveUser">
                        <input type="hidden" name="id" v-if="User.id > 0" v-model="User.id">
                        <label for="name">Username:</label>
                        <input id="UserName" type="textbox" name="name" class="form-control" required="required" v-model="User.name">
                        <label for="email">Email:</label>
                        <input id="UserEmail" type="email" name="email" class="form-control" required="required" v-model="User.email">
                        <br>
                        <button id="btnSubmit" type="submit" class="btn btn-success btn-lg btn-block">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        data(){
            return {}
        },
        props: ['User', 'users'],
        methods: {
            saveUser() {
                $("#btnSubmit").attr('disabled', true);
                var self = this;

                if(this.User.id > 0) {
                    axios.put('api/users/update', this.User)
                    .then(response => {
                        for (var u in self.users) {
                            if(self.users[u].id === self.User.id) {
                                self.users[u].id = self.User.id;
                                self.users[u].name = self.User.name;
                                self.users[u].email = self.User.email;
                                break;
                            } 
                        }
                        self.closeModal();
                    })
                    .catch(error => {
                        console.log(error);
                        alert("User could not be updated, please, try again.");
                    });
                } else {                
                    axios.post('api/users/create', this.User)
                    .then(response => {
                        self.users.push(response.data);
                        self.closeModal();
                    })
                    .catch(error => {
                        console.log(error);
                        alert("User could not be created, please, try again.");
                    });
                }
            },
            closeModal() {
                $("#userFormModal").modal("hide");
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            },
        }
    }
	
</script>