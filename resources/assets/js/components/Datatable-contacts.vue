<template>
  <div>
    <div style="margin-bottom: 10px">
      <el-row>
        <el-col :span="18">
          <!-- <el-button @click="createChapter">Crear Capitulo</el-button> -->
        
            
            <download-excel
              :data="data" class="btn btn-success" :name="data.fileName+'.xls'">
              <i class="fa fa-file-excel-o"></i>
              Generar archivo Excel
              <!-- <img src="download_icon.png"> -->
            </download-excel>
       
          
       
          <button type="submit" class="btn btn-primary" @click="pdfGen">
            <i class="fa fa-file-pdf-o"></i>
            Generar Archivo PDF
          </button>
        
        </el-col>

        <el-col :span="6">
          <el-input placeholder="Buscar" v-model="filters[0].value"></el-input>
        </el-col>
      </el-row>
    </div>

    <data-tables :data="data" :action-col="actionCol" :filters="filters" @selection-change="handleSelectionChange">
      <el-table-column type="selection" width="55">
      </el-table-column>

      <el-table-column v-for="title in titles" :prop="title.prop" :label="title.label" :key="title.prop" sortable="custom">
      </el-table-column>
    </data-tables>
<hr>




  </div>
</template>

 <script>
//import toastr from 'toastr'
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
Vue.use(ElementUI)
// set language to EN
import lang from 'element-ui/lib/locale/lang/es'
import locale from 'element-ui/lib/locale'

locale.use(lang)
import { DataTables, DataTablesServer } from 'vue-data-tables'
Vue.use(DataTables)
Vue.use(DataTablesServer)

import moment from 'moment'
import Swal from 'sweetalert2'

//import modules


import JsonExcel from 'vue-json-excel'
import jsPDF from 'jsPDF'
 
Vue.component('downloadExcel', JsonExcel)

export default {
  components: {
      //components
  },
    props: ['data'],
  data() {
    return {
      

      titles: [{prop:'full_name',label:'Nombres',key:'full_name'},{prop:'position',label:'Cargo',key:'position'},{prop:'status',label:'Estado',key:'status'}],
      filters: [{
        prop: ['full_name','position','status'],
        value: ''
      }],
      actionCol: {
        props: {
          label: 'Acciones',
        },
        buttons: [{
          props: {
            type: 'primary'
          },
          handler: row => {
              //this.updateCompany(row.id)
              this.$bus.$emit('set-id-assistant-in-contacts-manage',row.id)
          },
          //label: 'Editar'
          icon: 'fa fa-edit'
        },{
          props: {
            type: 'warning'
          },
          handler: row => {
              this.$bus.$emit('set-active-inactive-contact-in-contacts-manage', row.id, row.id_status,row.id_company)
          },
          //label: 'Contactos'
          icon: 'fa fa-check-square-o'
        }]
      },
      selectedRow: []
    }
  },
  created: function() {
      //created functions
  },
  methods: {
    pdfGen : function () {
      let pdfName = this.data.fileName; 
      var doc = new jsPDF();
      doc.text(pdfName, 10, 10);
      doc.save(pdfName + '.pdf');
    },
    handleSelectionChange : function () {

    },
  },
}
</script>