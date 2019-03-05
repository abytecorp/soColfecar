<template>
<div id="tabla">

<table  border="1" style="border-color:#000000;">
    <tbody>
        <tr>
            <img />
            <!-- <barcode :width="1"  v-bind:value="barcodeValue" id="barcode1" >
            error.
            </barcode> -->
            <svg class="barcode1">
            </svg>
            <vue-qr :text="recordS" :size="180" id="qr1"></vue-qr>
        </tr>
    </tbody>
</table>


<div id="nombre"><center>{{ asSel.names }}  {{ asSel.last_names }}</center></div>
<div id="empresa"><center>{{ asSel.bs_name }}</center></div>


</div>




</template>
<script>

import VueBarcode from 'vue-barcode'
Vue.component('barcode', VueBarcode );

import VueQr from 'vue-qr'
Vue.component('vue-qr', VueQr );



export default{
    props: ['id_record'],
    data () {
        return {
            barcodeValue:    '',
            recordS:         '',
            ass:                [],
            asSel:              {},
        }
    },
    created: function() {
        this.getAssData()
        
    },
    methods: {
        genQr : function() {
            this.ass.forEach(asi => {  
            this.recordS = 'BEGIN:VCARD\nN:'+ asi.last_names +';'+ asi.names +'\nTEL;WORK:'+ asi.tel +'\nTEL;CELL:'+asi.cel+'\nADR;HOME:;;'+asi.address+'\nORG:'+ asi.bs_name +'\nTITLE:'+ asi.position +'\nEMAIL:'+ asi.email +'\nURL:'+ asi.web +'\n['+asi.id_ass+']END:VCARD'
                 this.asSel = asi
                 this.barcodeValue = asi.id_ass
                 });
        },
        getAssData : function() {
            var urlGetData = '/get-data-ass/'+ this.id_record;
            axios.get(urlGetData).then(response =>{
                this.ass = response.data
                console.log(this.ass.id_ass)
                
                this.genQr()
                //if(this.asSel.names)
                JsBarcode(".barcode1", this.asSel.id_ass, {
                    format: "CODE128",
                    lineColor: "#000000",
                    displayValue: false
                    });
                var ctr = this.asSel.names.length;
                var ctrln = this.asSel.last_names.length;
                var ctrbsn = this.asSel.bs_name.length;
                if(ctr > 14 || ctrln > 14){ $('#nombre').css({'font-size':'13'}) }
                if(ctrbsn > 16 ){ $('#empresa').css({'font-size':'15'}) }
                if(ctrbsn > 22 ){ $('#empresa').css({'font-size':'12'}) }
                if(ctrbsn < 7 ){ $('#empresa').css({'font-size':'22'}) }
            });
        },
        print : function() {
             window.print();
        },
        sizeName : function(names) {
            var ctr = this.asSel.names.length;
            console.log(names)
        }
        

    }
   
}


</script>

<style>

@page {
	size: portrait;
	margin: 0;
	border-color:white;
}

BODY { margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; border-color:white; font-family: Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif}
td {
    border-collapse:collapse;
	border-color:white;
    /* border: 1px black solid; */
}
tr:nth-of-type(5) td:nth-of-type(1) {
    visibility: hidden;
}

#nombre {

position:absolute;
	height: 50px;
	width: 110px;
	font-size:20px;
	text-align: center;
	font-weight: bold;
    /* border: 1px black solid; */

	top: 70px;
	left: 130px;
	  -moz-transform: rotate(-90.0deg);  /* FF3.5+ */
       -o-transform: rotate(-90.0deg);  /* Opera 10.5 */
  -webkit-transform: rotate(-90.0deg);  /* Saf3.1+, Chrome */
             filter:  progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083);  /* IE6,IE7 */
         -ms-filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083); /* IE8*/

}
#empresa {
	word-wrap: break-word;
	position:absolute;
	height: 50px;
	width: 110px;
	font-size:16px;
	border-color:white;
	text-align:justify;
	/* border: 1px black solid; */
	top: 227px;
	left: 120px;
	  -moz-transform: rotate(-90.0deg);  /* FF3.5+ */
       -o-transform: rotate(-90.0deg);  /* Opera 10.5 */
  -webkit-transform: rotate(-90.0deg);  /* Saf3.1+, Chrome */
             filter:  progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083);  /* IE6,IE7 */
         -ms-filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083); /* IE8*/
}


#contenedor{
position:relative;
text-align: center;
height: 145px;
width: 99px;
padding: 1px;
border-color:white;
}


.barcode1{
float:left;
/*height: 40px;*/
/* width: 200px;
height: 80px; */

position:fixed;
top: 190px;
left: 5px;
border-color:white;
-moz-transform: rotate(-90.0deg);  /* FF3.5+ */
       -o-transform: rotate(-90.0deg);  /* Opera 10.5 */
  -webkit-transform: rotate(-90.0deg);  /* Saf3.1+, Chrome */
             filter:  progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083);  /* IE6,IE7 */
         -ms-filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083); /* IE8*/
}

#qr1{
float:left;
/*height: 40px;*/
width: 170px;
height: 80px;

position:fixed;
top: 60px;
left: -50px;
border-color:white;
-moz-transform: rotate(-90.0deg);  /* FF3.5+ */
       -o-transform: rotate(-90.0deg);  /* Opera 10.5 */
  -webkit-transform: rotate(-90.0deg);  /* Saf3.1+, Chrome */
             filter:  progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083);  /* IE6,IE7 */
         -ms-filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083); /* IE8*/
}

</style>