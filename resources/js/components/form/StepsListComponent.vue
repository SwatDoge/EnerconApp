<template>
    <div>
        <div class="card" >
            <div class="card-body">
                <div class="row text-center align-middle">
                    <div class="col">Stap</div>
                    <div class="col">Turbine</div>
                    <div class="col">Plaats</div>
                    <div class="col">Veld</div>
                    <div class="col">Omschrijving</div>
                    <div class="col">Voltooid</div>
                    <div class="col">Datum/Tijd</div>
                    <div class="col">Acties</div>
                </div>
                <hr class="mb-3"/>
                <div v-for="(step, index) in steps" :key="parseInt(step.stap)">
                    <div class="row text-center align-items-center mt-1">
                        <div class="col">
                            <input type="text" class="form-control text-center" v-model="step.stap">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control text-center" v-model="step.turbine">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control text-center" v-model="step.plaats">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control text-center " v-model="step.veld">
                        </div>
                        <div class="col">
                            <a class="x" data-toggle="collapse" :data-target="'#description_' + index" aria-expanded="true" :aria-controls="'description_' + index">Zie omschrijving 👁</a>
                        </div>
                        <div class="col">
                            <input type="checkbox" readonly :id="'signature_' + index" v-model="step.voltooid" @click="updateDate(index)">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control text-center" readonly v-model="step.datum" v-if="step.voltooid">
                            <input type="text" class="form-control text-center" :placeholder="(step.created ? 'n.v.t.' : 'niet voltooid')" readonly v-else>
                        </div>
                        <div class="col">
                            <i class="fas fa-trash" v-on:click="steps.splice(index, 1)"></i>
                        </div>
                    </div>
                    <div class="row collapse mt-2" :id="'description_' + index">
                        <div class="col">
                            <textarea class="form-control" placeholder="Omschrijving" v-model="step.omschrijving"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a type="button" class="btn btn-secondary mt-2" v-on:click="create();">Nieuwe stap aanmaken</a>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                steps: [],
            }
        },
        methods:{
            create: function (){
                let step = {
                    stap: (this.steps.length < 1 ? 1 : Math.max.apply(Math, this.steps.map(function(stappen) { return stappen.stap; })) + 1),
                    turbine: null,
                    plaats: null,
                    veld: null,
                    datum: null,
                    omschrijving: null,
                    voltooid: false,
                    created: true,
                }
                this.steps.push(step);
            },
            updateDate: function (i){
                let d = new Date();
                let s =  d.getDate() + "/" + (d.getMonth() + 1) + "/" + d.getFullYear() + " " + this.addzero(d.getHours()) + ":" + this.addzero(d.getMinutes()) + ":" + this.addzero(d.getSeconds());
                this.steps[i].datum = s;
            },
            addzero: function (time){
                return (parseInt(time) < 10 ? "0" + time : time);
            }
        },
        mounted(){
            this.create();
        }
    }
</script>
