<template>
    <div class="form-group row">
        <!-- IV gegevens -->
        <div class="col">
            <div class="mb-4">
                <label for="ivname">Instalatie verantwoordlijke:</label>
                    <input placeholder="Naam" type="text" value="Geert Jan" class="form-control" id="ivname" name="ivname">
                    <input placeholder="Telefoon nummer" name="ivtel" type="text" value="" id="ivtel" class="form-control mt-1" readonly>
                <br/>
            </div>
        </div>

        <!-- MV gegevens -->
        <div class="col">
            <div class="mx-4 mb-4">
                <label for="mvname">Werk verantwoordelijke:</label>
                <input placeholder="Naam" type="text" value="Kees Verhaas" class="form-control" id="mvname" name="mvname">
                <input placeholder="Telefoon nummer" name="mvtel" type="text" value="" id="mvtel" class="form-control mt-1" readonly>
                <br/>
            </div>
        </div>

        <!-- PL gegevens -->
        <div class="col">
            <div class="mx-4 mb-4">
                <label for="plname">Ploeglijder: </label>
                <input placeholder="Naam" type="text" value="Piet hendriks" class="form-control" id="plname" name="plname">
                <input placeholder="Telefoon nummer" name="pltel" type="text" value="" id="pltel" class="form-control mt-1" readonly>
                <br/>
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