<template>
    <div class="form-group row mb-0">
    <div class="col ml-3">
        <div class="row">
            <input placeholder="Windpark naam" name="windpark" type="text" value="" class="form-control mb-1" id="windpark">
        </div>
        <div class="row">
            <input placeholder="Datum" name="date" type="text" value="(Datum van vandaag als default)" class="form-control mb-1" id="date">
        </div>
        <div class="row">
            <textarea placeholder="Rederene voor schakeling" style="height: 110px;" name="reason" value="" id="reason" class="form-control"></textarea>
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
                        <input placeholder="Bedrijfsnaam" name="switchcompany" type="text" value="" id="switchcompany" class="form-control">
                        <br/>
                        <input placeholder="Telefoon nummer" name="switchtel" type="text" value="" id="switchtel" class="form-control">
                        <br/>
                    </div>
                </div>
            </div>
            <!-- contactpersoon gegevens -->
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <label for="contactname">Contactpersoon:</label>
                        <input placeholder="Naam Contactpersoon" name="contactname" type="text" value="" id="contactname" class="form-control">
                        <br/>
                        <input placeholder="Telefoon nummer" name="contacttel" type="text" value="" id="contacttel" class="form-control">
                        <br/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
export default {

}
</script>

<style>

</style>