<template>
    <div v-if="fetched">
        <form method="POST" :action="post()" accept-charset="UTF-8" enctype="multipart/form-data" id="SLcreateform">           
            <!-- csrf -->
            <slot></slot>
            <!-- id -->
            <input type="hidden" name="briefnr" v-model="schakelbrief_ID">
            <!-- Schakelbrief gegevens -->
            <div class="card mx-4">
                <div class="card-body">
                    <!-- header -->
                    <div class="row m-1">
                        <div class="col order-2 px-0">
                            <img class="mr-offset-0" src="/img/logo_transparent.png" height=100 align="right">
                        </div>
                        <div class="col order-1 px-0">
                            <h2>Nieuwe schakelbrief (#{{schakelbrief_ID}})</h2>
                            <br>
                            <label v-if="hasRole(['IV', 'WV', 'PL'])" class="form-check-label" for="general">
                                <h4 v-if="hasRole(['IV', 'WV'])">Algemeen
                                    <i v-if="display.show_general" class="fas fa-eye"></i>
                                    <i v-else class="fas fa-eye-slash"></i>
                                </h4>
                            </label>
                            <h4 v-else>Je hebt onvoldoende rechten voor bezichtigen/bewerken van schakelbrieven.</h4>
                            <input type="checkbox" id="general" v-model="display.show_general" hidden>
                            
                        </div>
                    </div>
                    <hr v-if="display.show_general">
                    <form-general class="m-1" v-if="hasRole(['IV', 'WV', 'PL'])" v-show="display.show_general" :wind-parken="enerconapi.windpark" :date="datum" :rollen="rollen" :init="editinit"></form-general>
                    <!-- header -->
                    
                    <br>
                    <br v-if="display.show_intern">
                    <label v-if="hasRole(['IV', 'WV', 'PL'])" class="form-check-label" for="intern">
                        <h4 v-if="hasRole(['IV', 'WV'])">Intern
                            <i v-if="display.show_intern" class="fas fa-eye"></i>
                            <i v-else class="fas fa-eye-slash"></i>
                        </h4>
                    </label>
                    <input type="checkbox" id="intern" v-model="display.show_intern" hidden>
                    <div v-if="hasRole(['IV', 'WV'])" v-show="display.show_intern">
                        <hr/>
                        <form-internal :rollen="rollen" :users="users" :init="editinit"></form-internal>
                    </div>

                    <br>
                    <br>
                    <label v-if="hasRole(['IV', 'WV', 'PL'])" class="form-check-label" for="stappen">
                        <h4 v-if="hasRole(['IV', 'WV'])">Stappen
                            <i v-if="display.show_stappen" class="fas fa-eye"></i>
                            <i v-else class="fas fa-eye-slash"></i>
                        </h4>
                    </label>
                    <input type="checkbox" id="stappen" v-model="display.show_stappen" hidden>
                    <div v-if="hasRole(['IV', 'WV', 'PL'])" v-show="display.show_stappen">
                        <form-steps :stappen="stappen" :route="route" :rollen="rollen" :omschrijvingen="enerconapi.omschrijvingen" :plaatsen="enerconapi.plaatsen" :velden="enerconapi.velden" :turbine="enerconapi.turbines"></form-steps>
                    </div>

                    <br>
                    <br>
                    <label v-if="hasRole(['IV', 'WV', 'PL'])" class="form-check-label" for="opmerkingen">
                        <h4 v-if="hasRole(['IV', 'WV'])">Opmerkingen
                            <i v-if="display.show_opmerkingen" class="fas fa-eye"></i>
                            <i v-else class="fas fa-eye-slash"></i>
                        </h4>
                    </label>
                    <input type="checkbox" id="opmerkingen" v-model="display.show_opmerkingen" hidden>
                    <div v-if="hasRole(['IV', 'WV'])" v-show="display.show_opmerkingen">
                        <hr>
                        <form-remarks :rollen="rollen" :init="editinit"></form-remarks>
                    </div>

                    <br>
                    <br>
<!--                     
                    <input class="btn btn-primary mt-4 text-light" type="submit" value="Creeër" v-if="route == 'slCreate'">
                    <input class="btn btn-danger mt-4 text-light" type="submit" value="Annuleer" v-if="route == 'slCreate'">
                    <input class="btn btn-success mt-4 text-light" type="submit" value="Accepteren" v-if="route == 'slEdit'">
                    <input class="btn btn-danger mt-4 text-light" type="submit" value="Afwijzen" v-if="route == 'slEdit'"> -->

                    
                    <input class="btn btn-danger mt-4 text-light" type="button" value="Annuleer" v-if="route == 'slCreate'">
                    
                    <div v-if="route == 'slEdit' && (editinit.ivakkoord == 1 ? true : false) && (editinit.mvakkoord == 0 ? true : false)">
                        <input type="radio" name="verified" value="1">
                        <label>Accepteer</label>
                        <input type="radio" name="verified" value="0">
                        <label>Afwijzen</label>
                        <br>
                        <input class="btn btn-success mt-4 text-light" type="submit" value="Bevestigen">
                    </div>
                    
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
                schakelbrief_ID: 0,
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
                display:{
                    show_general: true,
                    show_intern: true,
                    show_stappen: true,
                    show_opmerkingen: true,
                }
            }
        },
        props:["rollen", "route", "users", "editinit", "stappen", "sl_count"],
        methods:{
            post(){
                switch(this.route){
                    case "slCreate": return "http://127.0.0.1:8000/sl/";
                    case "slEdit": return 'http://127.0.0.1:8000/sl/update/' + this.editinit.id;
                }
                return "http://127.0.0.1:8000/sl/";
            },
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
            let vm = this;
            vm.$nextTick(function () {
                vm.rollen = JSON.parse(vm.rollen);
                if (vm.rollen.includes("Admin")){
                    vm.rollen = [];
                    vm.rollen.push("PL", "IV", "WV", "Admin");
                    
                }
                vm.users = JSON.parse(vm.users);
                if (typeof(vm.stappen) != "undefined") vm.stappen = JSON.parse(vm.stappen);
                if (typeof(vm.editinit) != "undefined") vm.editinit = JSON.parse(vm.editinit);
                (vm.route != "slEdit" ? vm.schakelbrief_ID = parseInt(vm.sl_count) + 1 : vm.schakelbrief_ID = vm.editinit.id);
            });

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
                .then(data => {
                    let ret = "";
                    if (data.data.length > 0) ret = this.enerconapi[collection.name] = data.data;
                    else{
                        ret = this.load.failed = true; 
                        this.load.error = "De teruggestuurde gegevens waren leeg, de API is waarschijnlijk neer.";
                    }
                    return ret;
                })
                .catch(error => {this.load.failed = true; this.load.error = error});
                if (this.load.failed) break;
                this.load.gained++;
                
            }
           if (!this.load.failed) this.fetched = !this.fetched;
        }
    }
</script>
