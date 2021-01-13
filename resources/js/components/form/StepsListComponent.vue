<template>
    <div>
        <div class="card" >
            <div class="card-body">
                <div class="row text-center align-middle">
                    <div class="col">Stap</div>
                    <div class="col">Plaats</div>
                    <div class="col">Veld</div>
                    <div class="col">Turbine</div>
                    <div class="col">Omschrijving</div>
                    <div class="col">Voltooid</div>
                    <div class="col">Datum/Tijd</div>   
                    <div class="col" v-if="hasRole(['IV'])">Acties</div>
                </div>
                <hr class="mb-3"/>
                <div v-for="(step, index) in steps" :key="parseInt(step.stap)">
                    <div class="row text-center align-items-center mt-1">
                        <div class="col">
                            <input type="text" class="form-control text-center" v-model="step.stap" readonly>
                        </div>
                        <div class="col">
                            <!-- <input type="text" class="form-control text-center" v-model="step.plaats"   :readonly="!hasRole(['IV'])"> -->
                            <input-dropdownv2
                                placeholder="plaatsnaam" name="windpark" classes="form-control mb-1" :disable="!hasRole(['IV'])"
                                :dhaydata="plaatsen" dkey="plaats" dheight="180px" :dlength="40">
                            </input-dropdownv2>
                        </div>
                        <div class="col">
                            <!-- <input type="text" class="form-control text-center" v-model="step.veld"    :readonly="!hasRole(['IV'])"> -->
                            <input-dropdownv2
                                placeholder="veldnaam" name="windpark" classes="form-control mb-1" :disable="!hasRole(['IV'])"
                                :dhaydata="velden" dkey="veld" dheight="180px" :dlength="40">
                            </input-dropdownv2>
                        </div>
                        <div class="col">
                            <!-- <input type="text" class="form-control text-center" v-model="step.turbine"  :readonly="!hasRole(['IV'])"> -->
                            <input-dropdownv2
                                placeholder="serial number" name="windpark" classes="form-control mb-1" :disable="!hasRole(['IV'])"
                                :dhaydata="turbine" dkey="serial_nr" dheight="180px" :dlength="40">
                            </input-dropdownv2>
                        </div>
                        <div class="col">
                            <select name="description" class="form-select">
                                <option :value="option['id']" v-for="(option, kindex) in omschrijvingen" :key="kindex" >{{option['omschrijving']}}</option>
                            </select>
                        </div>
                        <div class="col">
                            <input type="checkbox" :id="'signature_' + index" v-model="step.voltooid" @click="updateDate(index, step.voltooid)" :disabled="!hasRole(['PL'])">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control text-center" readonly v-model="step.datum" v-if="step.voltooid">
                            <input type="text" class="form-control text-center" :placeholder="(step.created ? 'n.v.t.' : 'niet voltooid')" v-model="step.datum" readonly v-else>
                        </div>
                        <div class="col" v-if="hasRole(['IV'])">
                            <i class="fas fa-trash" v-on:click="steps.splice(index, 1)"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a type="button" class="btn btn-secondary mt-2" v-on:click="create()" v-if="hasRole(['IV'])">Nieuwe stap aanmaken</a>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                steps: [],
            }
        },
        props:["rollen", "omschrijvingen", "plaatsen", "turbine", "velden"],
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
            updateDate: function (i, t){
                if (!t) this.steps[i].datum = new Date().toISOString().replace(/T/, ' ').replace(/\..+/, '');
            },
            hasRole: function(roles){
                let res = false;
                for (let role of roles)
                    if (!res && this.rollen.includes(role))
                        res = true;

                return res;
            },
        },
        mounted(){
            this.create();
        }
    }
</script>
