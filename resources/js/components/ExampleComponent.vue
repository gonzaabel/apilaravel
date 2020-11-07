<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-offset-1 col-10">
                <div class="card">
                    <div class="card-header">
                        <h1 class="float-left">Users List</h1>
                        <a href="#" class="float-right btn btn-lg btn-primary">Create New User</a>
                    </div>

                    <div class="card-body">
                        <table class="table">
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
            <div class="col-offset-1">
                
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        data() {
            return {users: {}}
        },
        mounted() {
            var self = this;
            axios.get('users').then(response => {
                self.users = response.data;
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
                                <a href="#" class="btn btn-danger">Delete</a>
                            </div>
                        </td>
                    </tr>`
    });
</script>
