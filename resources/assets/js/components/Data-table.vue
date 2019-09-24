<template>
  <div>
    <div style="margin-bottom: 10px">
      <el-row>
        <el-col :span="18">
          <el-button @click="onCreate">create 1 row</el-button>
          <el-button @click="onCreate100">create 100 row</el-button>
          <el-button @click="bulkDelete">bulk delete</el-button>
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
  </div>
</template>

 <script>
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

import Swal from 'sweetalert2'

export default {
    props: ['data'],
  data() {
    return {
      errors2: [],
      titles: [{prop:'bs_name',label:'Empresa',key:'bs_name'},{prop:'full_name',label:'Asistente',key:'full_name'},{prop:'email',label:'Correo',key:'email'}],
      filters: [{
        prop: ['bs_name','full_name'],
        value: ''
      }],
      actionCol: {
        props: {
          label: 'Acciones',
        },
        buttons: [{
          props: {
            type: 'success'
          },
          handler: row => {
              this.$bus.$emit('set-enable-alim', row.record_id)
          },
          label: 'Alimentacion'
        },{
          props: {
            type: 'primary'
          },
          handler: row => {
              this.$emit('updateAssistantModal', row.id_assistant)
            
          },
          label: 'Editar'
        },{
          props: {
            type: 'danger'
          },
          handler: row => {
            // this.data.splice(this.data.indexOf(row), 1)
            Swal({
              title: 'Esta seguro que desea eliminar el registro de '+row.full_name+'?',
              text: "Se eliminara este registro, pero los datos del asistente y de la empresa se conservaran!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, Eliminarlo!',
              cancelButtonText: 'Cancelar',
            }).then((result) => {
              if (result.value) {
                //console.log(row)
                var url = '/del-reg/'+row.record_id;
                axios.delete(url).then(response => {
                  //console.log(response)
                  //this.getAssistantsByEvent();
                  this.$emit('updateDataTable',row.id)
                  Swal(
                  'Eliminado!',
                  'El registro se ha eliminado satisfactoriamente.',
                  'success'
                )
                }).catch(error =>{
                this.errors2 = error.response.data;
              });
                
              }
            })
            //this.$message.success(`the id selected ${row.full_name}`)
          },
          label: 'Eliminar Registro'
        },{
          props: {
            icon: 'el-icon-edit',
            color: 'danger'
          },
          handler: row => {
              this.$emit('billModal', row.record_id)
            
          },
          label: 'Facturar'
        }]
      },
      selectedRow: []
    }
  },
  methods: {
    onCreate() {
      this.data.push({
        content: "new created",
        flow_no: "FW201601010003" + Math.floor(Math.random() * 100),
        flow_type: "Help",
        flow_type_code: "help"
      })
    },
    onCreate100() {
      [...new Array(100)].map(_ => {
        this.onCreate()
      })
    },
    handleSelectionChange(val) {
      this.selectedRow = val
    },
    bulkDelete() {
      this.selectedRow.map(row => {
        this.data.splice(this.data.indexOf(row), 1)
      })
      this.$message('Linea eliminada con exito!')
    },
    updateAssistant() {
        console.log(`its event handler ${row.id}`)
        //this.$emit('updateAssistantModal',row.id)
    }
  }
}
 </script>