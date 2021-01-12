<template>
    <div class="form-group row mb-0">
        <div class="col ml-3">
            <div class="row">
                <input-dropdownv2
                    placeholder="Windpark naam" name="windpark" classes="form-control mb-1" :readonly="!hasRole(['IV'])" 
                    :dhaydata="windParken" dkey="windpark" dheight="180px" :dlength="40">
                </input-dropdownv2>
            </div>
            <div class="row">
                <input placeholder="Datum" type="date" v-model="date" class="form-control mb-1" name="date" id="date" :readonly="!hasRole(['IV'])" required="required">
            </div>
            <div class="row">
                <textarea placeholder="Rederene voor schakeling" style="height: 110px;" name="reason" value="" id="reason" class="form-control" :readonly="!hasRole(['IV'])"></textarea>
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
                            <input placeholder="Bedrijfsnaam" name="switchcompany" type="text" value="" id="switchcompany" class="form-control mb-1" :readonly="!hasRole(['IV'])">
                            <input placeholder="Telefoon nummer" name="switchtel" type="text" value="" id="switchtel" class="form-control" :readonly="!hasRole(['IV'])">
                        </div>
                    </div>
                </div>
                <!-- contactpersoon gegevens -->
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <label for="contactname">Contactpersoon:</label>
                            <input placeholder="Naam Contactpersoon" name="contactname" type="text" value="" id="contactname" class="form-control mb-1" :readonly="!hasRole(['IV'])">
                            <input placeholder="Telefoon nummer" name="contacttel" type="text" value="" id="contacttel" class="form-control" :readonly="!hasRole(['IV'])">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:["windParken", "date", "rollen"],
    methods:{
        hasRole: function(roles){
            let res = false;
            for (let role of roles)
                if (!res && this.rollen.includes(role))
                    res = true;

            return res;
        },
    }
}
</script>

<style>

</style>