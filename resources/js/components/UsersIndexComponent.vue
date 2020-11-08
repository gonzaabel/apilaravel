<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-offset-1 col-10">
                <div class="card">
                    <div class="card-header">
                        <h1 class="float-left">Users List</h1>
                        <a href="#user-create" class="float-right btn btn-lg btn-primary">Create New User</a>
                    </div>

                    <div class="card-body" v-if="users.length == 0">
                        <b>Hey! I can't find any user... What are you waiting for create someone?</b>
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

    var userList = { users: [] };

    export default {
        data() {
            return userList;
        },
        mounted() {
            var self = this;
            axios.get('api/users').then(response => {
                for (var user in response.data) {
                    self.users.push(response.data[user]);
                }
            });
        }
    }

    Vue.component('users-list', {
        props: ['user'],
        template: `<tr>
                        <td>{{user.id}}</td>
                        <td>{{user.name}}</td>
                        <td>{{user.email}}</td>
                        <td>
                            <div class="btn-group">
                                <a href="#" class="btn btn-secondary">Update</a>
                                <a href="#" class="btn btn-danger" @click='deleteUser(user.id)'>Delete</a>
                            </div>
                        </td>
                    </tr>`,
        methods: {
            deleteUser(id) {

                var data = {
                    data: {
                        'id': id
                    }
                };

                axios.delete('api/users/delete/', data)
                .then(response => {
                    let index = userList.users.findIndex(user => user.id == id);
                    userList.users.splice(index, 1);
                })
                .catch(error => {
                    console.log(error);
                    alert("User could not be deleted, please, try again.");
                });
            }
        }
    });

</script>
