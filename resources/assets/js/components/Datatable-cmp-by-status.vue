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


<!-- modal update chapter -->
        <div id="modalUpdateCompany" class="modal fade bs-example-modal-lg"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Actualizar datos de la Empresa</h4>
                    <button type="button" class="close" v-on:click="claenVariablesUpdate">×</button>
                </div>
                <div class="modal-body">
                  <form v-on:submit.prevent="updateCompanySet(companyUpdate.company_id)">
                    <div v-if="companyUpdate.logo != '' && imageData == null">
                      <button type="button" class="btn btn-danger" v-on:click="deleteLogo"><i class="fa fa-trash-o"></i> Eliminar</button>
                      <img class="card-img-top img-fluid" :src="'storage/logos/'+companyUpdate.logo" alt="Card image cap">
                    </div>
                    <div v-else-if="companyUpdate.logo != '' && imageData != null">
                      <button type="button" class="btn btn-danger" v-on:click="deleteLogo"><i class="fa fa-trash-o"></i> Eliminar</button>
                      <img class="card-img-top img-fluid" :src="imageData" alt="Card image cap">
                    </div>
                    <div v-else>
                      <div class="form-group m-form__group">
                        <label for="exampleInputEmail1">Logo de la Empresa</label>
                        <div></div>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" @change="previewImage" id="customFileUpdate">
                          <label class="custom-file-label" for="customFile">Seleccione archivo</label>
                          <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.logo }}</span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group m-form__group">
                      <label for="bsNameInput">Razon Social:</label>
                      <input type="text" class="form-control m-input m-input--air" id="bsNameInput" placeholder="Escriba el nombre o razon social de la empresa" v-model="companyUpdate.bs_name">
                      <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.bs_name }}</span>
                    </div>
                    <div class="form-group m-form__group">
                      <label for="bsNameInput">Siglas:</label>
                      <input type="text" class="form-control m-input m-input--air" id="acronymInput" aria-describedby="acronymInputHelp" placeholder="Escriba el nombre corto o SIGLAS de la empresa" v-model="companyUpdate.acronym">
                      <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.acronym }}</span>
                    </div>

                    <div class="form-group m-form__group">
                        <label for="bsNameInput">NIT:</label>
                      <div class="input-group mb-3">
                          <input type="number" class="form-control m-input m-input--air" id="nitInput" aria-describedby="nitInputHelp"  v-model="companyUpdate.nit">
                          <p>     Digito de verificacion (-) </p>
                          <input type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1"  v-model="companyUpdate.verification_digit">
                      </div>
                      <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.nit }}</span>
                    </div>
                    <div class="form-group m-form__group">
                      <label for="bsNameInput">Pagina Web:</label>
                      <input type="text" class="form-control m-input m-input--air" id="bsNameInput" aria-describedby="bsNameHelp" placeholder="www.empresaejemplo.com" v-model="companyUpdate.web">
                      <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.web }}</span>
                    </div>
                    <div class="form-group m-form__group">
                      <label for="bsNameInput">Em@il:</label>
                      <input type="text" class="form-control m-input m-input--air" id="emailInput" aria-describedby="emailInputHelp" placeholder="Ejemplo@empresaEjemplo.com" v-model="companyUpdate.email">
                      <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.web }}</span>
                    </div>
                    <div class="form-group m-form__group">
                    <div class="jumbotron">
                      <label for="bsNameInput">Direccion:</label>
                      <address-gen :data="companyUpdate.address" @upAddress="setUpAddress" @upAddressDig="setUpAddressDig" @toReset="setReset" ></address-gen>
                      <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.address }}</span>
                    </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                          <h5 class="m-t-30 m-b-10">Telefono Oficina</h5>
                          <input type="text" class="form-control m-input m-input--air" id="phone1Input" aria-describedby="phone1Help" placeholder="Telefono Oficina" v-model="companyUpdate.phone1">
                          <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.phone1 }}</span>
                      </div>
                      <div class="col-md-4">
                          <h5 class="m-t-30 m-b-10">Telefono Personal</h5>
                          <input type="text" class="form-control m-input m-input--air" id="phone2Input" aria-describedby="phone2Help" placeholder="Telefono Personal" v-model="companyUpdate.phone2">
                          <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.phone1 }}</span>

                      </div>
                      <div class="col-md-4">
                          <h5 class="m-t-30">Telefono Contacto</h5>
                          <input type="text" class="form-control m-input m-input--air" id="phone3Input" aria-describedby="phone3Help" placeholder="Telefono Oficina" v-model="companyUpdate.phone3">
                          <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.phone3 }}</span>

                      </div>
                    </div>
                    <div class="form-group m-form__group">
                      <label for="bsNameInput">Ciudad:</label>
                      <v-select :options="cities"  v-model="companyUpdate.city" @change="delVar" label="city">
                          <template slot="option" slot-scope="option">
                              {{ option.city }}
                          </template>
                      </v-select>
                      <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.id_city }}</span>
                    </div>
                    <hr>
                   
                    <button type="submit" class="btn btn-primary">Actualizar</button>
					        </form>
                </div>
                <div class="modal-footer">                
                </div>
            </div>
            <!-- /.modal-content -->
            </div>
        <!-- /.modal-dialog -->
    </div>


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
import payOrNot from '../filters/pay-or-not'
import addressGen from './Address-gen'

import JsonExcel from 'vue-json-excel'
import jsPDF from 'jsPDF'
 
Vue.component('downloadExcel', JsonExcel)
Vue.use(payOrNot)

export default {
  components: {
    addressGen
  },
    props: ['data','fileName'],
  data() {
    return {
      companyUpdate: {
        acronym:              '',
        address:              '',
        afiliation_state_id:  '',
        bs_name:              '',
        created_at:           '',
        email:                '',
        id_city:              null,
        id_cmp_state:         null,
        id_status:            null,
        logo:                 '',
        nit:                  '',
        phone1:               '',
        phone2:               '',
        phone3:               '',
        web:                  '',
      },
      imageData:          null,//preview form image
      logoChanged:      false,
      cities:  [],
      errors: [],
      titles: [{prop:'bs_name',label:'Razon Social',key:'bs_name'},{prop:'email',label:'Em@il',key:'email'},{prop:'nit',label:'NIT',key:'nit'}],
      filters: [{
        prop: ['bs_name'],
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
              this.updateCompany(row.id)
          },
          label: 'Editar'
        },{
          props: {
            type: 'danger'
          },
          handler: row => {
              //this.$emit('updateAlimentsModal', row.record_id)  
          },
          label: 'Finalizar'
        }]
      },
      selectedRow: []
    }
  },
  created: function() {
    this.getCities()
  },
  methods: {
    getLogo : function (e) {
      var fileReader = new FileReader()
      fileReader.readAsDataURL(e.target.files[0])
      fileReader.onload = (e) => {
      this.companyUpdate.logo = e.target.result
      }
    },
    handleSelectionChange : function () {

    },
    getLogoUpdate : function (e) {
      var fileReader = new FileReader()
      fileReader.readAsDataURL(e.target.files[0])
      fileReader.onload = (e) => {
      this.companyUpdate.logo = e.target.result
      }
      this.logoChanged = true
    },
    getCities() {
      let url = '/api/get-cities';
      axios.get(url).then(response =>{
          this.cities = response.data;
          this.errors = [];
      }).catch(error => {
          this.cities = [];
          this.errors = error.response.data;
      });
    },
    since : function(d) {
       return moment(d).fromNow();
    },
    updateCompany : function(id) {
        $('#modalUpdateCompany').modal('show')
        let url = '/api/company/'+ id +'/get-company';
        axios.get(url).then(response =>{
            this.companyUpdate = response.data
            //this.companyUpdate.id_city = this.companyUpdate.city_id

        }).catch(error => {
            this.errors = error.response.data
        });
    },
    deleteLogo : function() {
      this.companyUpdate.logo = ''
      this.imageData = null
      this.logoChanged = false
    },
    previewImage: function(event) {
            // Reference to the DOM input element
            var input = event.target;
            // Ensure that you have a file before attempting to read it
            if (input.files && input.files[0]) {
                // create a new FileReader to read this image and convert to base64 format
                var reader = new FileReader();
                // Define a callback function to run, when FileReader finishes its job
                reader.onload = (e) => {
                    // Note: arrow function used here, so that "this.imageData" refers to the imageData of Vue component
                    // Read image as base64 and set to imageData
                    this.imageData = e.target.result;
                }
                // Start the reader job - read file as a data url (base64 format)
                reader.readAsDataURL(input.files[0]);
            }
        this.getLogoUpdate(event)
    },
    updateCompanySet : function(id) {
      //this.companyUpdate.is_billing = this.companyUpdate.is_billing == true ? 1 : 0
      this.companyUpdate.logoChanged = this.logoChanged
      this.companyUpdate.id_city = typeof(this.companyUpdate.city) == "object" ? this.companyUpdate.city.id : this.companyUpdate.city_id 
      //console.log(typeof this.companyUpdate.city)
      let url = 'affiliations/'+id
      axios.put(url, this.companyUpdate).then(response =>{
        this.$emit('updateDataTable',this.companyUpdate.id_cmp_state)
        this.$bus.$emit('comp-cant-up')
        this.$bus.$emit('changes-up')
        this.companyUpdate.acronym=              '',
        this.companyUpdate.address=              '',
        this.companyUpdate.afiliation_state_id=  '',
        this.companyUpdate.bs_name=              '',
        this.companyUpdate.verification_digit=   '',
        this.companyUpdate.city=                 '',
        this.companyUpdate.city_id=              '',
        this.companyUpdate.company_id=           '',
        this.companyUpdate.created_at=           '',
        this.companyUpdate.email=                '',
        this.companyUpdate.id_city=              null,
        this.companyUpdate.id_cmp_state=         null,
        this.companyUpdate.id_status=            null,
        this.companyUpdate.logo=                 '',
        this.companyUpdate.nit=                  '',
        this.companyUpdate.phone1=               '',
        this.companyUpdate.phone2=               '',
        this.companyUpdate.phone3=               '',
        this.companyUpdate.web=                  '',
        this.imageData=                          null
        this.logoChanged =                       false,
          //this.companyUpdate.bannerChanged =   false,
          //this.bannerChanged =                 false,
        this.errors =                             [],
          
          $('#modalUpdateCompany').modal('hide')
      }).catch(error => {
        this.errors = error.response.data;
      });
    },
    modalUpdateCompany : function() {
      this.companyUpdate.id_status =       '',
      this.companyUpdate.user_id =         '',
      this.companyUpdate.chapter_id =      '',
      this.companyUpdate.chapter =         ''
      this.companyUpdate.description=      ''
      this.companyUpdate.id_chapter_type=  ''
      this.companyUpdate.chapter_type=     ''
      this.companyUpdate.created_at=       ''
      this.companyUpdate.is_billing=       false
      this.companyUpdate.date_init=        ''
      this.companyUpdate.date_end=         ''
      this.companyUpdate.banner=           null
      this.imageData=                      null
      this.companyUpdate.bannerChanged =   false
      this.logoChanged =                    false

      $('#modalUpdateChapter').modal('hide')
    },
    claenVariablesUpdate : function() {
        this.companyUpdate.acronym=              '',
        this.companyUpdate.address=              '',
        this.companyUpdate.afiliation_state_id=  '',
        this.companyUpdate.bs_name=              '',
        this.companyUpdate.verification_digit=   '',
        this.companyUpdate.city=                 '',
        this.companyUpdate.city_id=              '',
        this.companyUpdate.company_id=           '',
        this.companyUpdate.created_at=           '',
        this.companyUpdate.email=                '',
        this.companyUpdate.id_city=              null,
        this.companyUpdate.id_cmp_state=         null,
        this.companyUpdate.id_status=            null,
        this.companyUpdate.logo=                 null,
        this.companyUpdate.nit=                  '',
        this.companyUpdate.phone1=               '',
        this.companyUpdate.phone2=               '',
        this.companyUpdate.phone3=               '',
        this.companyUpdate.web=                  '',
        this.imageData=                          null,
        this.logoChanged =                       false,
        $('#modalUpdateCompany').modal('hide')
    },
    showConf : function() {
      $('#modalShowConf').modal('show')
    },
    closeConf : function() {
      $('#modalShowConf').modal('hide')
    },
    setUpAddress : function(val) {
      //(Addres-gen)this function used to add the nomenclature an the letters, whit spaces to build the string
      this.companyUpdate.address = this.companyUpdate.address + ' ' + val + ' '
    },
    setUpAddressDig : function(val) {
      //(Addless-gen)this function add the string whitout a initial space, this used in the numbers.
      this.companyUpdate.address = this.companyUpdate.address + val
    },
    setReset : function() {
      //(Address-gen) this function reset or erase the charset or adress that gives the object
      this.companyUpdate.address = ''
    },
    delVar : function() {
      if(this.companyUpdate.city == ''){
        this.companyUpdate.id_city = ''
        this.companyUpdate.city_id = ''
        this.companyUpdate.bs_name=              ''
        çthis.companyUpdate.verification_digit=   '',
        this.companyUpdate.city=                 ''
        this.companyUpdate.city_id=              ''
        this.companyUpdate.company_id=           ''
      }
    },
    pdfGen : function () {
      let pdfName = this.data.fileName; 
      var doc = new jsPDF();
      doc.text(pdfName, 10, 10);
      doc.save(pdfName + '.pdf');
    }
  }
}
</script>