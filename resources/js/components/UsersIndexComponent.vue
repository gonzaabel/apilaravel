<template>
    <div class="container">
        <UsersFormComponent v-bind:users="users" v-bind:User="User"></UsersFormComponent>

        <div class="row justify-content-center">
            <div class="col-offset-1 col-10">
                <div class="card">
                    <div class="card-header">
                        <h1 class="float-left">Users List</h1>
                        <a href="#" class="float-right btn btn-lg btn-primary" data-toggle="modal" data-target="#userFormModal" @click="openModal">Create New User</a>
                    </div>

                    <div class="card-body" v-if="users.length == 0">
                        <b>Hey! I couldn't find any user... What are you waiting to create someone?</b>
                    </div>

                    <div class="card-body">
                        <table class="table" v-if="users.length > 0">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>E-mail</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <users-list
                                    v-for="user in users"
                                    v-bind:user="user"
                                    v-bind:key="user.id"
                                ></users-list>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-offset-1"></div>
        </div>
    </div>
</template>


<script>

    import UsersFormComponent from './UsersFormComponent.vue';

    var indexPageData = { 
        users: [], 
        User: {
            id: null,
            name: "",
            email: "",
            password: "password"
        }
    };

    export default {
        data() {
            return indexPageData;
        },
        components: {
            UsersFormComponent
        },
        mounted() {
            var self = this;
            axios.get('api/users').then(response => {
                for (var user in response.data) {
                    self.users.push(response.data[user]);
                }
            });
        },
        methods: {
            openModal() {
                $("#btnSubmit").attr('disabled', false);
                this.cleanUserData();
            },
            cleanUserData() {
                this.User.id = null;
                this.User.name = '';
                this.User.email = '';
            }
        }
    }

    Vue.component('users-list', {
        props: ['user'],
        template: `<tr>
                        <td>#{{user.id}}</td>
                        <td>{{user.name}}</td>
                        <td>{{user.email}}</td>
                        <td>
                            <div class="btn-group">
                                <a href="#" class="btn btn-secondary" data-toggle="modal" @click="setUserData(user)" data-target="#userFormModal">Update</a>
                                <a href="#" class="btn btn-danger" @click='deleteUser(user.id)'>Delete</a>
                            </div>
                        </td>
                    </tr>`,
        methods: {
            deleteUser(id) {

                var user = this.findUserById(id);

                if(!user) {
                    alert("There is not an user with the ID #"+id);
                    return false;
                }

                if(!confirm("Do you really want to delete that poor User, ID #"+id+", Name "+user.name+"?")) {
                    return false;
                }

                var data = {
                    data: {
                        'id': id
                    }
                };

                axios.delete('api/users/delete/', data)
                .then(response => {
                    let index = indexPageData.users.findIndex(user => user.id == id);
                    indexPageData.users.splice(index, 1);
                })
                .catch(error => {
                    console.log(error);
                    alert("User could not be deleted, please, try again.");
                });
            },
            findUserById(id) {
                let user = false;
                for (var u in indexPageData.users) {
                    if(indexPageData.users[u].id === id) {
                        user = indexPageData.users[u];
                        break;
                    }
                }
                return user;
            },
            setUserData(user) {
                $("#btnSubmit").attr('disabled', false);
                indexPageData.User.id = user.id;
                indexPageData.User.name = user.name;
                indexPageData.User.email = user.email;
            }
        }
    });

</script>