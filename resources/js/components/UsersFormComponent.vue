<template>
    <div class="row justify-content-center" v-if="isOnIndex === false">
        <div class="col-offset-1 col-10">
            <div class="card">
                <div class="card-header">
                    <h1 class="float-left">Create User</h1>
                    <a href="#user-index" class="float-right btn btn-lg btn-primary" @click="goToIndex">User List</a>
                </div>

                <div class="card-body">
                    <form>
                        <label for="name">Username:</label>
                        <input id="UserName" type="textbox" name="name" required="required" @keyUp="storeUserName" value="">
                        <label for="email">Email:</label>
                        <input id="UserEmail" type="email" name="email" required="required" @keyUp="storeUserEmail" value="">
                        <button type="submit" class="btn btn-success">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-offset-1"></div>
    </div>
</template>

<script>

    export default {
        data(){
            return { 
                User: {
                    id: "",
                    name: "",
                    email: "",
                },
                isOnIndex: false,
                isOnForm: true,
            }
        },
        render(){

        },
        methods: {
            storeUserName() {
                this.User.name = Document.getElementById("#UserName").value;
            },
            storeUserEmail() {
                this.User.email = Document.getElementById("#UserEmail").value;
            },
            goToIndex() {
                this.isOnIndex = true;
                this.isOnForm = false;
            }
        }
    }
	
</script>