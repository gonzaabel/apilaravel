<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-offset-1 col-10">
                <div class="card">
                    <div class="card-header font-weight-bold">Users List</div>

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
        template: '<tr><td>{{user.id}}</td><td>{{user.name}}</td><td>{{user.email}}</td><td><div class="btn-group"><a href="#" class="btn btn-secondary">Editar</a><a href="#" class="btn btn-danger">Borrar</a></div></td></tr>'
    });
</script>
