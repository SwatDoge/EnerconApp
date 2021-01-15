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
                    <div class="col" v-show="hasRole(['PL'])">Voltooid</div>
                    <div class="col" v-show="hasRole(['PL'])">Datum/Tijd</div>   
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
                                placeholder="plaatsnaam" name="plaats[]" classes="form-control mb-1" :disable="!hasRole(['IV'])"
                                :dhaydata="plaatsen" dkey="plaats" dheight="180px" :dlength="40" :input="step.plaats">
                            </input-dropdownv2>
                        </div>
                        <div class="col">
                            <!-- <input type="text" class="form-control text-center" v-model="step.veld"    :readonly="!hasRole(['IV'])"> -->
                            <input-dropdownv2
                                placeholder="veldnaam" name="veld[]" classes="form-control mb-1" :disable="!hasRole(['IV'])"
                                :dhaydata="velden" dkey="veld" dheight="180px" :dlength="40" :input="step.veld">
                            </input-dropdownv2>
                        </div>
                        <div class="col">
                            <!-- <input type="text" class="form-control text-center" v-model="step.turbine"  :readonly="!hasRole(['IV'])"> -->
                            <input-dropdownv2
                                placeholder="serial number" name="turbine[]" classes="form-control mb-1" :disable="!hasRole(['IV'])"
                                :dhaydata="turbine" dkey="serial_nr" dheight="180px" :dlength="40" :input="step.turbine">
                            </input-dropdownv2>
                        </div>
                        <div class="col">
                            <select name="omschrijving[]" class="form-select" v-if="route === 'slCreate'" :disabled="!hasRole(['IV'])">
                                <option :value="option['id'] - 1" v-for="(option, kindex) in omschrijvingen" :key="kindex">{{option['omschrijving']}}</option>
                            </select>
                            <div v-else>
                                <!-- <input  readonly :value="omschrijvingen[step.omschrijving]['omschrijving']"> -->
                                <textarea class="form-control" readonly :value="omschrijvingen[step.omschrijving]['omschrijving']" rows="1"></textarea>
                            </div>
                        </div>
                        <div class="col" v-show="hasRole(['PL'])">
                            <input name="voltooid[]" type="checkbox" :value="step.voltooid" :id="'signature_' + index" v-model="step.voltooid" @click="updateDate(index, step.voltooid)">
                            <input name="voltooid[]" type="checkbox" :value="step.voltooid" :id="'signature_' + index" :checked="!step.voltooid" hidden>
                        </div>
                        <div class="col" v-show="hasRole(['PL'])">
                            <input type="text" name="datum[]" class="form-control text-center" v-model="step.datum" v-if="step.voltooid" readonly>
                            <input type="text" name="datum[]" class="form-control text-center" :placeholder="(step.created ? 'n.v.t.' : 'niet voltooid')" v-model="step.datum" readonly v-else>
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
        props:["rollen", "omschrijvingen", "plaatsen", "turbine", "velden", "route", "stappen"],
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
            if (typeof(this.stappen) !== "undefined"){
                for (let stap of this.stappen) {
                    let step = {
                        stap: stap.id,
                        turbine: stap.turbine,
                        plaats: stap.plaats,
                        veld: stap.veld,
                        datum: stap.datum,
                        omschrijving: stap.omschrijving,
                        voltooid: (stap.voltooid === "true" ? true : false),
                        created: false,
                    }
                    this.steps.push(step);
                }
            } else {
                this.create();
            }
        }
    }
</script>
