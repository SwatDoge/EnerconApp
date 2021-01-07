<template>
    <div>
        <form method="POST" action="http://127.0.0.1:8000/sl" accept-charset="UTF-8" enctype="multipart/form-data" id="SLcreateform" v-if="Fetched">
            <!-- Schakelbrief gegevens -->
            <div class="card mx-4">
                <div class="card-body">
                    <!-- header -->
                    <div class="row">
                        <div class="col-md-offset-4 mr-3 order-2">
                            <img src="/img/logo_transparent.png" height=92>
                            <hr/>
                        </div>
                        <div class="col order-1 pr-0">
                            <h2>Nieuwe schakelbrief ({{Schakelbrief_ID}})</h2>
                    
                            <br/>
                            <h4>Algemeen</h4>
                            <hr/>
                        </div>
                    </div>
                    <form-general></form-general>
                    <!-- header -->

                    <br/><br/><br/>
                    <h4>Intern</h4>
                    <hr/>
                    <form-internal></form-internal>

                    <br/>
                    <h4>Stappen</h4>
                    <form-steps></form-steps>

                    <br/><br/><br/>
                    <h4>Opmerkingen</h4>
                    <hr/>
                    <form-remarks></form-remarks>

                    <input class="btn btn-primary" type="submit" value="Creeër">
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                Schakelbrief_ID: Date.now(),
            }
        },
        methods:{},
        mounted(){
            
        }
    }
</script>
