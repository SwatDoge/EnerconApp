<template>
    <div class="form-group row mb-0" v-if="loaded">
        <div class="col ml-3">
            <div class="row">
                <input-dropdownv2
                    placeholder="Windpark naam" name="windpark" classes="form-control mb-1" :disable="!hasRole(['IV'])"
                    :input="windpark" :dhaydata="windParken" dkey="windpark" dheight="180px" :dlength="40">
                </input-dropdownv2>
            </div>
            <div class="row">
                <input placeholder="Datum" type="date" v-model="date" class="form-control mb-1" name="date" id="date" :readonly="!hasRole(['IV'])" required="required">
            </div>
            <div class="row">
                <textarea v-model="reason" placeholder="Rederene voor schakeling" style="height: 110px;" name="reason" value="" id="reason" class="form-control" :readonly="!hasRole(['IV'])"></textarea>
                <br/>
            </div>
        </div>
        <div class="col">
            <!-- schakelbedrijf gegevens -->
            <div class="form-group row mb-0">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <label for="switchcompany">Schakelbedrijf:</label>
                            <input v-model="bedrijf" placeholder="Bedrijfsnaam" name="switchcompany" type="text" value="" id="switchcompany" class="form-control mb-1" :readonly="!hasRole(['IV'])">
                            <input v-model="bedrijftel" placeholder="Telefoon nummer" name="switchtel" type="text" value="" id="switchtel" class="form-control" :readonly="!hasRole(['IV'])">
                        </div>
                    </div>
                </div>
                <!-- contactpersoon gegevens -->
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <label for="contactname">Contactpersoon:</label>
                            <input v-model="contact" placeholder="Naam Contactpersoon" name="contactname" type="text" value="" id="contactname" class="form-control mb-1" :readonly="!hasRole(['IV'])">
                            <input v-model="contacttel" placeholder="Telefoon nummer" name="contacttel" type="text" value="" id="contacttel" class="form-control" :readonly="!hasRole(['IV'])">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:["windParken", "date", "rollen", "init"],
    methods:{
        hasRole: function(roles){
            let res = false;
            for (let role of roles)
                if (!res && this.rollen.includes(role))
                    res = true;

            return res;
        },
        check: function(x){
            return (typeof(x) != "undefined" ? x : "");
        }
    },
    data(){
        return{
            windpark: "",
            reason: "",
            bedrijf: "",
            bedrijftel: "",
            contact: "",
            contacttel: "",
            loaded: false,
        }
    },
    mounted(){
        let vm = this;
        vm.$nextTick(function () {
            if (typeof(vm.init) != "undefined"){
                vm.windpark = vm.check(vm.init.windpark);
                vm.reason = vm.check(vm.init.reason);
                vm.bedrijf = vm.check(vm.init.bedrijf);
                vm.bedrijftel = vm.check(vm.init.bedrijftel);
                vm.contact = vm.check(vm.init.contact);
                vm.contacttel = vm.check(vm.init.contacttel);
            }
            vm.loaded = true;
        });
    }
}
</script>

<style>

</style>