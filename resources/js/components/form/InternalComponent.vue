<template>
    <div class="form-group row" v-if="loaded">
        <!-- IV gegevens -->
        <div class="col">
            <div class="mb-4">
                <label for="ivname">Instalatie verantwoordlijke:</label>
                    <input-dropdownv2 
                        placeholder="Naam" type="text" classes="form-control" id="ivname" name="ivname" :disable="!hasRole(['IV'])"
                        :dhaydata="users" dkey="name" dheight="180px" :dlength="40" dupdateref="phonenumber_iv" dupdatekey="phonenumber"
                        @inputdropdown="catchEvent" :input="ivname"
                    />
                    <input v-model="event_comebacks.phonenumber_iv" placeholder="Telefoon nummer" name="ivtel" type="text" value="" id="ivtel" class="form-control mt-1" readonly>
                <br/>
            </div>
        </div>

        <!-- MV gegevens -->
        <div class="col">
            <div class="mx-4 mb-4">
                <label for="mvname">Werk verantwoordelijke:</label>
                <input-dropdownv2 
                    placeholder="Naam" type="text" classes="form-control" id="mvname" name="mvname" :disable="!hasRole(['IV'])"
                    :dhaydata="users" dkey="name" dheight="180px" :dlength="40" dupdateref="phonenumber_mv" dupdatekey="phonenumber"
                    @inputdropdown="catchEvent" :input="mvname"
                />
                <input v-model="event_comebacks.phonenumber_mv" placeholder="Telefoon nummer" name="mvtel" type="text" value="" id="mvtel" class="form-control mt-1" readonly>
                <br/>
            </div>
        </div>

        <!-- PL gegevens -->
        <div class="col">
            <div class="mx-4 mb-4">
                <label for="plname">Ploeglijder: </label>
                <input-dropdownv2 
                    placeholder="Naam" type="text" classes="form-control" id="plname" name="plname" :disable="!hasRole(['IV'])"
                    :dhaydata="users" dkey="name" dheight="180px" :dlength="40" dupdateref="phonenumber_pl" dupdatekey="phonenumber"
                    @inputdropdown="catchEvent" :input="plname"
                />
                <input v-model="event_comebacks.phonenumber_pl" placeholder="Telefoon nummer" name="pltel" type="text" value="" id="pltel" class="form-control mt-1" readonly>
                <br/>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:["rollen", "users", "init"],
    methods:{
        hasRole: function(roles){
            let res = false;
            for (let role of roles)
                if (!res && this.rollen.includes(role))
                    res = true;

            return res;
        },
        catchEvent: function(value){
            this.event_comebacks[value.key] = value.data
        },    
        check: function(x){
        return (typeof(x) !== undefined ? x : "");
        }
    },
    data(){
        return{
            event_comebacks:{
                phonenumber_iv: "",
                phonenumber_mv: "",
                phonenumber_pl: "",
            },
            ivname: "",
            mvname: "",
            plname: "",
            loaded: false,
        }
    },
    mounted(){
        let vm = this;
        vm.$nextTick(function () {
            if (typeof(vm.init) != "undefined"){
                vm.ivname = vm.check(vm.init.ivname);
                vm.mvname = vm.check(vm.init.mvname);
                vm.plname = vm.check(vm.init.plname);
            }
            vm.loaded = true;
        });
    }
}
</script>

<style>

</style>