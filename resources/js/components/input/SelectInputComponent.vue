<template>
    <input 
        ref="inp"
        type="text"
        autocomplete="off"
        tabindex="0"
        data-toggle="popover"
        data-trigger="focus"
        :title="dtitle"
        data-placement="bottom"
        v-model="text"
        :change="updatePopover()"
    >
</template>

<script>
export default {
    mounted(){},
    props:["dtitle", "dhaydata", "dkey", "dlength", "dheight"],
    data() {
        return {
            text: "",
        }
    },
    methods:{
        updatePopover: function(){
            let width = (typeof(this.$refs["inp"]) !== "undefined" ? this.$refs["inp"].clientWidth : "unset");
            $('[data-toggle="popover"]').popover('dispose');
            if (this.text.length > 0){
                $('[data-toggle="popover"]').popover({
                    trigger: "toggle",
                    placement: "bottom",
                    html: true,
                    content: this.updateList(width),
                    delay: {"show": 0, "hide": 0},
                    popperConfig:{
                        placement: "bottom-start"
                    },
                }).popover("show");
            }
        },
        updateList: function(width){
            let list = document.createElement('div');
            list.style.maxHeight = this.dheight + "px";
            list.style.width  = width - this.RemToPx(2) + "px";
            list.style.overflowY = "auto"
        
            let filtered = this.dhaydata.filter((item) => {
                if(item[this.dkey].toLowerCase().includes(this.text.toLowerCase())) return item;
            }).slice(0, this.dlength);

            if (filtered.length > 0){
                for (let item of filtered){
                    let p = document.createElement('div');
                    p.innerText = item[this.dkey];
                    p.classList.add("dropdownselection");
                    list.appendChild(p);
                }
                return list;
            } else {
                let p = document.createElement("div");
                p.innerText = "Geen resultaten.";
                p.style.width  = (width - 32) + "px";
                return p;
            }
        },
        RemToPx: function(rem){
            return rem * parseFloat(getComputedStyle(document.documentElement).fontSize);
        },
        setText: function(text){
            this.text = text;
        }
    }
}
</script>

<style scoped>
    
</style>