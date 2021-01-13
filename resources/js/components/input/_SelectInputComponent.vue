<template>
    <div class="px-0">
        <input :placeholder="placeholder" type="text" :class="classes" autocomplete="off" ref="input" :name="name" @focus="fl(true)" @blur="fl(false)" v-model="inputtext" :readonly="disable">
        <div ref="popover" v-show="shown" class="rounded position-absolute y h5" :style="[{overflowY: 'auto'},{maxHeight: dheight}, {width: boxwidth}]">
            <div v-for="(item, index) in gainsort(dhaydata, inputtext)" :key="index" class="form-controll" @click="updateText(item[dkey])">
                <div class="x px-2">{{item[dkey]}}</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            shown: false,
            inputtext: "",
            boxwidth: "0px",
        }
    },
    watch: {
        inputtext: 'resetNumber'
    },
    props: {
        "input": {default: "", type: String},
        "classes": {}, 
        "name": {}, 
        "dhaydata": {}, 
        "dkey": {}, 
        "placeholder": {}, 
        "dlength": {default: 20, type: Number}, 
        "dheight": {default: "100px", type: String}, 
        "dupdateref": {default: "", type: String}, 
        "dupdatekey":{default: "", type: String},
        "disable": {}
    },
    mounted(){
        let vm = this;
        vm.$nextTick(function () {   
            this.boxwidth = this.$refs["input"].clientWidth + "px";
            this.inputtext = vm.input;
        });
    },
    methods:{
        fl: function(x){
            if (this.disable) return;
            setTimeout(function () {this.shown = x}.bind(this), 100)
        },
        gainsort(ldata, text){
            var list = ldata.filter((item) => {
                if(item[this.dkey].toLowerCase().includes(text.toLowerCase())) return item;
            }).slice(0, this.dlength);

            if (list.length == 1 && list[0][this.dkey] === text){
                list = [];
                if (typeof(dupdateref) !== null){
                    console.log(text);
                    this.$emit("inputdropdown", {data: this.old_key_to_new(text, this.dupdatekey, this.dkey), key: this.dupdateref});
                }
            }
            return list;
        },
        updateText(data){
            this.inputtext = data;
            if (typeof(dupdateref) !== null){ 
                this.$emit("inputdropdown", {data: this.old_key_to_new(data, this.dupdatekey, this.dkey), key: this.dupdateref});
            }
            this.showdupdates = true;
        },
        old_key_to_new(data, key, og_key){
            let x = this.dhaydata;
            for (const item of x) {;
                if (item[og_key].toLowerCase() === data.toLowerCase())
                    return item[key];
            }
            return null;
        },
        resetNumber(){
            if (this.disable) return;
            if (this.dupdateref !== null){
                this.$emit("inputdropdown", {data: "", key: this.dupdateref});
            }
        }
    }
}
</script>

<style scoped>
    .x:hover{
        background-color: lightgray;
        cursor: pointer;
        width: inherit;
    }
    .y{
        z-index: 1;
        background-color:rgb(235, 235, 235);
    }
</style>