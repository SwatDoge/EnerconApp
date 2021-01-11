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
                        <div class="col-md-offset-4 mr-3 order-2">
                            <img src="/img/logo_transparent.png" height=92>
                            <hr/>
                        </div>
                        <div class="col order-1 pr-0">
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
                        <form-internal :rollen="rollen"></form-internal>
                    </div>

                    <div v-if="hasRole(['IV', 'WV', 'PL'])">
                        <br/>
                        <h4>Stappen</h4>
                        <form-steps :rollen="rollen"></form-steps>
                    </div>

                    <div v-if="hasRole(['IV', 'WV'])">
                        <br/><br/><br/>
                        <h4>Opmerkingen</h4>
                        <hr/>
                        <form-remarks :rollen="rollen"></form-remarks>
                    </div>

                    <!-- iv knoppen -->
                    <input class="btn btn-primary mt-4" type="submit" value="Creeër" v-if="hasRole(['IV'])">
                    <input class="btn btn-danger mt-4" type="submit" value="Annuleer" v-if="hasRole(['IV'])">
                    <!-- wv knoppen -->
                    <input class="btn btn-success mt-4" type="submit" value="Accepteren" v-if="hasRole(['WV'])">
                    <input class="btn btn-danger mt-4" type="submit" value="Afwijzen" v-if="hasRole(['WV'])">
                    
                </div>
            </div>
        </form>
    </div>
    <div v-else class="row">
        <div class="col text-center align-self-center">
            <h4>Windmolen data laden..</h4>
            <div class="spinner-border" role="status"></div>
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
            }
        },
        props:["rollen"],
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
                return (date.getDate() < 10 ? "0" + date.getDate() : date.getDate) + "-" + (date.getMonth() + 1 < 10 ? "0" + date.getDate() : date.getDate) + "-" + date.getFullYear()
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

            for (let collection of apis) {
                await fetch(collection.url)
                .then(res => {return res.json()})
                .then(data => this.enerconapi[collection.name] = data.data);
            }
           this.fetched = !this.fetched;
        }
    }
</script>
