<template>
    <div class="card">
        <div class="card-body">
            <div class="row text-center align-middle">
                <div class="col">Stap</div>
                <div class="col">Turbine</div>
                <div class="col">Plaats</div>
                <div class="col">Veld</div>
                <div class="col">Datum/Tijd</div>
                <div class="col">Omschrijving</div>
                <div class="col">Voltooid</div>
                <div class="col">Acties</div>
            </div>
            <hr/>
            <div class="row text-center align-items-center">
                <div class="col">
                    <input type="text" class="form-control text-center" placeholder="Stap" value="1">
                </div>
                <div class="col">
                    <input type="text" class="form-control text-center" placeholder="Turbine" value="3">
                </div>
                <div class="col">
                    <input type="text" class="form-control text-center" placeholder="Plaats" value="Drenthe">
                </div>
                <div class="col">
                    <input type="text" class="form-control text-center" placeholder="Vled" value="2">
                </div>
                <div class="col">
                    <input type="text" class="form-control text-center" placeholder="Datum" value="1/2/1020">
                </div>
                <div class="col">
                    <a data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Zie omschrijving 👁</a>
                </div>
                <div class="col">
                    <input type="checkbox">
                </div>
                <div class="col">
                    <i class="fas fa-trash"></i>
                </div>
            </div>
            <div class="row collapse mt-2" id="collapseExample">
                <div class="col">
                    <textarea class="form-control"> pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</textarea>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
