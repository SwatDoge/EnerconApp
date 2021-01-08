<template>
    <div class="form-group row">
        <div class="col no-gutters">
            <label for="remarks">Opmerking GO-NL: </label>
            <textarea style="width: 100; height: 150px;" name="remarks" value="" id="remarks" class="form-control" :readonly="!hasRole(['WV'])"></textarea>
            <br/>
        </div>
        <div class="col no-gutters">
            <label for="reason">Opmerkingen tijdens werkzaamheden: </label>
            <textarea style="width: 100%; height: 150px;" name="plremarks" value="" id="plremarks" class="form-control" :readonly="!hasRole(['PL'])"></textarea>
            <br/>
        </div>
    </div>
</template>

<script>
export default {
    props:["rollen"],
    methods:{
        hasRole: function(roles){
            let res = false;
            for (let role of roles)
                if (!res && this.rollen.includes(role))
                    res = true;

            return res;
        }
    },
}
</script>

<style>

</style>