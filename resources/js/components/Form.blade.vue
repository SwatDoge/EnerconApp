<template>
    <div v-if="fetched">
        <form method="POST" action="http://127.0.0.1:8000/sl" accept-charset="UTF-8" enctype="multipart/form-data" id="SLcreateform">
            <!-- csrf -->
            <slot></slot>
            <!-- id -->
            <input type="hidden" name="briefnr" v-model="schakelbrief_ID">
            <!-- Schakelbrief gegevens -->
            <div class="card mx-4">
                <div class="card-body">
                    <!-- header -->
                    <div class="row">
                        <div class="col order-2 px-0">
                            <img class="mr-offset-0" src="/img/logo_transparent.png" height=92>
                            <hr>
                        </div>
                        <div class="col order-1 px-0">
                            <h2>Nieuwe schakelbrief (#{{schakelbrief_ID}})</h2>
                            <br/>
                            <h4 v-if="hasRole(['IV', 'WV', 'PL'])">Algemeen</h4>
                            <h4 v-else>Je hebt onvoldoende rechten voor bezichtigen/bewerken van schakelbrieven.</h4>
                            <hr/>
                        </div>
                    </div>
                    <form-general v-if="hasRole(['IV', 'WV', 'PL'])" :wind-parken="enerconapi.windpark" :date="datum" :rollen="rollen"></form-general>
                    <!-- header -->
                    
                    <div v-if="hasRole(['IV', 'WV'])">
                        <br/><br/><br/>
                        <h4>Intern</h4>
                        <hr/>
                        <form-internal :rollen="rollen" :users="users"></form-internal>
                    </div>

                    <div v-if="hasRole(['IV', 'WV', 'PL'])">
                        <br/>
                        <h4>Stappen</h4>
                        <form-steps :rollen="rollen" :omschrijvingen="enerconapi.omschrijvingen"></form-steps>
                    </div>

                    <div v-if="hasRole(['IV', 'WV'])">
                        <br/><br/><br/>
                        <h4>Opmerkingen</h4>
                        <hr/>
                        <form-remarks :rollen="rollen"></form-remarks>
                    </div>

                    <!-- iv knoppen -->
                    <input class="btn btn-primary mt-4 text-light" type="submit" value="Creeër" v-if="hasRole(['IV']) && route == 'slCreate'">
                    <input class="btn btn-danger mt-4 text-light" type="submit" value="Annuleer" v-if="hasRole(['IV']) && route == 'slCreate'">
                    <!-- wv knoppen -->
                    <input class="btn btn-success mt-4 text-light" type="submit" value="Accepteren" v-if="hasRole(['WV']) && route == 'slAccept'">
                    <input class="btn btn-danger mt-4 text-light" type="submit" value="Afwijzen" v-if="hasRole(['WV']) && route == 'slAccept'">
                    
                </div>
            </div>
        </form>
    </div>
    <div v-else-if="!this.load.failed && !fetched">
        <h4 class="text-center">({{this.load.gained}}/{{this.load.total}}) {{this.load.currentbuffer}} laden..</h4>
        <div class="row progress align-self-center mx-4">
            <div class="progress-bar-animated bg-info progress-bar-striped" role="progressbar" :style="'width: ' + (load.gained / load.total) * 100 + '%'"></div>
        </div>
    </div>
    <div v-else>
        <div class="text-center alert alert-danger mx-4">
            <h4><b>Kon "{{this.load.currentbuffer}}" niet laden, neem contact op met een beheerder.</b></h4>
            <br/>
            <h4>Error bericht:</h4>
            <h4>{{this.load.error}}</h4>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                schakelbrief_ID: this.genID(),
                datum: this.getDateForm(new Date()),
                fetched: false,
                enerconapi: {},
                load: {
                    total: 0,
                    gained: 0,
                    currentbuffer: "",
                    failed: false,
                    error: "",
                },
            }
        },
        props:["rollen", "route", "users"],
        methods:{
            hasRole: function(roles){
                let res = false;
                for (let role of roles)
                    if (!res && this.rollen.includes(role))
                        res = true;

                return res;
            },
            genID: function(){
                return Math.floor(Math.random() * 9999999) + 1000000;
            },
            getDateForm: function(date){
                return new Date().toISOString().slice(0,10);
            },
        },
        async mounted(){
            let apis = [
                {url:"https://std.stegion.nl/api_enercon/getWindparks",             name: "windpark"},
                {url:"https://std.stegion.nl/api_enercon/getTurbines",              name: "turbines"},
                {url:"https://std.stegion.nl/api_enercon/getStap_plaatsen",         name: "plaatsen"},
                {url:"https://std.stegion.nl/api_enercon/getStap_velden",           name: "velden"},
                {url:"https://std.stegion.nl/api_enercon/getStap_omschrijvingen",   name: "omschrijvingen"},
            ];
            this.load.total = apis.length;

            for (let collection of apis) {
                this.load.currentbuffer = collection.name;
                await fetch(collection.url)
                .then(res => {
                    if (!res.ok){this.load.failed = true;} 
                    return res.json()
                })
                .then(data => (data.data.length > 0 ? this.enerconapi[collection.name] = data.data : this.load.failed = true))
                .catch(error => {this.load.failed = true; this.load.error = error});
                if (this.load.failed) break;
                this.load.gained++;
                
            }
           if (!this.load.failed) this.fetched = !this.fetched;
        }
    }
</script>
